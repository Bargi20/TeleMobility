<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\Resources\Disturbouse;
use App\Models\Resources\Diagnosi;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Disturbo;
use Illuminate\Database\Eloquent\Model;
use Brick\Math\BigInteger;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Resources\Faq;
use App\Models\Resources\Clinico;
use App\Models\Resources\Paziente;
use App\Models\Messaggi;
use App\Models\Catalog;
use App\Models\Resources\Evento_Disturbo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use App\Http\Requests\StoreUserRequest;
use Illuminate\Contracts\Encryption\DecryptException;
class ClinicoController extends Controller
{
    protected $_clinicoModel;
    public function __construct() {
        $this->_clinicoModel = new User;
        $this->middleware('can:isClinico');
    }
   

    public function modifyAccount() :View{
        return view('modificaAccountDoctor');
    }

    public function registraPaziente():View{
        return view('registraNuovoPaziente');
    }
    public function Modifica_Password(): View {

        return view('ModificaPassword'); 
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $request->validated();
        $user = new User;
        $user->Descrizione = null;
        $user->Specializzazione = null; 
        $user->Terapia = null;
        $user->NumeroTerapia = 0; 
        $user->ID_Clinico_Del_Paziente = Auth::id(); // ID dell'utente autenticato
        $user->password = Hash::make($request['password']);
        $user->role = "Paziente";
        

        
        if ($request->hasFile('Immagine')) {
            $image = $request->file('Immagine');
            $imageName = $image->getClientOriginalName();
        } else {
            if ($request->Genere == 'M') {
                $imageName = "not_found_M.jpeg";
            }
            if ($request->Genere == 'F') {
                $imageName = "not_found_F.jpeg";
            }
            
            
        }
        $user->fill($request->except('Descrizione','Specializzazione','Terapia',
        'NumeroTerapia','ID_Clinico_Del_Paziente','password','role','RuoloClinico'));
    
        $user->Immagine = $imageName;
        $user->save();
        
        $destinationPath = public_path() . '/images/';
        if (!file_exists($destinationPath . $imageName)) {
            if ($request->hasFile('Immagine') ) {
                $image->move($destinationPath, $imageName);
            };
        } 

        return redirect()->route('Clinico')->with('success', 'Paziente inserito con successo!');
    }

    public function ricerca(): View{

        $user = Auth::user();

 
        $pazienti = User::where('ID_Clinico_Del_Paziente', $user->id)->paginate(5); 


        return view('ricercaPaziente', compact('pazienti'));
    }

    public function paziente_selezionato(int $ID_Paziente): View
    {  
        $paziente = User::find($ID_Paziente); 
        
      
        $_p = new Catalog;
        $bigIntegerID = BigInteger::of($ID_Paziente);
      
        

        return view('PazienteSelezionato')
         ->with([
        'paziente' => $paziente,
        'Lista_Disturbi' => $_p->Avvia_Eventi_Per_Diagnosi($bigIntegerID)
    ]);
                  
    }


    public function eliminaEventoClinico(int $ID_Paziente): View{
        
        $paziente = User::find($ID_Paziente);
        $bigIntegerID = BigInteger::of($paziente -> id);

        $eventiDisturbo = Evento_Disturbo::where('ID_Paziente', $bigIntegerID)
        ->orderBy('Data_Evento','desc')
        ->orderBy('Orario','desc')
        ->paginate(5);
        $disturbi = Disturbo::whereHas('diagnosi', function($query) use ($paziente) {
            $query->where('ID_Paziente', $paziente->id)->where('Stato', '1');
        })->pluck('Nome_Disturbo', 'Id_Disturbo');

        return view ('EliminaEventoClinico', compact ('eventiDisturbo','disturbi'))
            ->with('Paziente', $ID_Paziente); 
    }
    


    public function gethome_messaggi(): View{

        return view('home_messaggi');
}
    
    public function nuovo_mex(): View{
        $user = Auth::user(); 
        $_p = new Catalog;
        $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
        
        if (!($pazienti_lista instanceof \Illuminate\Support\Collection)) {
            $pazienti_lista = collect($pazienti_lista);
        }
        $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
            return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
            });
        
           
    
            return view('nuovo_messaggio_view', compact('pazienti'));
        }
        
      


        public function visualizza_mex($tipo): View
        {
            $user = Auth::user();
            $_p = new Catalog;
            $messaggi_lista = $_p->get_messaggi_by_id_mittente($user->id);
            $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);

            $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                });

            if ($tipo == 1) {
                $tipo = 'inviati';
                return view('messaggi', compact('pazienti'))
                    ->with([
                        'tipo' => $tipo,
                        'Lista_messaggi' => $messaggi_lista,
                        'Utente' => $user,
                    ]);
            }
        }

        public function search(Request $request)
    {
        $query = $request->input('query');
        $clinico = Auth::user();
        $id = $clinico->id;
        $pazienti = User::where('ID_Clinico_Del_Paziente',$id )
                        ->where(function($subQuery) use ($query) {
                            $subQuery->where('name', 'LIKE', "%{$query}%")
                                     ->orWhere('surname', 'LIKE', "%{$query}%");
                        })
                        ->get();

        return response()->json($pazienti);
    }

    

    public function filtraEventi(Request $request, $ID_Paziente)
{

    $intensitaMin = $request->input('intensità');
    $intensitaMax = $request->input('intensità2');
    $ID_Disturbo = $request->input('ID_Disturbo');

    $query = Evento_Disturbo::where('ID_Paziente', $ID_Paziente);

    if (!empty($intensitaMin) && !empty($intensitaMax)) {
        $query->whereBetween('Intensità', [$intensitaMin, $intensitaMax]);
    } elseif (!empty($intensitaMin)) {
        $query->where('Intensità', '>=', $intensitaMin);
    } elseif (!empty($intensitaMax)) {
        $query->where('Intensità', '<=', $intensitaMax);
    }

    if (!empty($ID_Disturbo)) {
        $query->where('ID_Disturbo', $ID_Disturbo);
    }

    $eventiFiltrati = $query->get();

    foreach ($eventiFiltrati as $evento) {
        $disturbo = Disturbo::find($evento->ID_Disturbo);
        $evento->Nome_Disturbo = $disturbo ? $disturbo->Nome_Disturbo : null;
    }

    return response()->json($eventiFiltrati);
}



} 
