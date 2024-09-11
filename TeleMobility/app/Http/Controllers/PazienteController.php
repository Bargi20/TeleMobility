<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use App\Models\User;
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
use App\Models\Catalog;
use App\Models\Resources\Evento_Disturbo;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Resources\Notifiche;

class PazienteController extends Controller
{
    protected $_pazienteModel;
    public function __construct() {
        $this->_pazienteModel = new User;
        $this ->middleware('can:isPaziente');

        }

    public function getGestisciAccount(): View {

        return view('GestisciAccount');

    }




    public function Modifica_Password(): View {

        return view('ModificaPassword'); 
    
    }

    public function Start_Inserisci_Evento(): View {

        return view('InserisciEvento');
    }

    public function Modifica_Dati(): View {

        return view('ModificaDatiAnagrafici'); 
    }

    public function Salva_Dati(StoreUserRequest $request): RedirectResponse

    {   
        $validated = $request->validated();

        $elimina_la_foto = $request->has('elimina_foto') ? 1 : 0;

        $entra = 0;
        $imageName = $request->user()->Immagine;
        if ($elimina_la_foto == 0 and $request->hasFile('Immagine') )
                 {
                    $image = $request->file('Immagine');
                    $imageName = $image->getClientOriginalName();
                    $entra = 2;
                    } 
            elseif($request->user()->Immagine == "not_found_M.jpeg" or $request->user()->Immagine == "not_found_F.jpeg" or $elimina_la_foto == 1)
            {
                if ($request->Genere == 'M') {
                    $imageName = "not_found_M.jpeg";
                    $entra = 1;
                }
                if ($request->Genere == 'F') {
                    $imageName = "not_found_F.jpeg";
                    $entra = 1;
                }
            }
            
         

         
         
        
        $request->user()->update($validated);

        

        if($entra != 0)
        {
            $request->user()->Immagine = $imageName;
            $request->user()->save(); 
        }
        
        $destinationPath = public_path() . '/images/';
        
        if (!file_exists($destinationPath . $imageName) and $entra == 2) {
            if ($request->hasFile('Immagine') ) {
                $image->move($destinationPath, $imageName);
            };
        } 
        
        return redirect()->route('Gestisci_Account')->with('success', 'Dati aggiornati con successo!');


       


    }

    public function index() : View {
        return view('Paziente');
    }




    public function viewTerapy():View{
        return view ('terapiaPaziente');
    }


    public function viewCartella() : View{
        $_p = new Catalog;
        $bigIntegerID = BigInteger::of(Auth::user()->id);
        return view('cartellaClinica')->with('Lista_Disturbi', $_p->Avvia_Eventi_Per_Diagnosi( $bigIntegerID));
    }

    public function eliminaEvento(): View{
        
        $user = Auth::user();
        $bigIntegerID = BigInteger::of(Auth::user()->id);


       $eventiDisturbo = Evento_Disturbo::join('Disturbo', 'Evento_Disturbo.ID_Disturbo', '=', 'Disturbo.ID_Disturbo')
        ->where('Evento_Disturbo.ID_Paziente', $bigIntegerID)
        ->orderBy('Disturbo.Nome_Disturbo') 
        ->orderBy('Evento_Disturbo.Data_Evento', 'desc') 
        ->select('Evento_Disturbo.*') 
        ->paginate(5);

        return view ('EliminaEvento', compact ('eventiDisturbo'))->with('success', 'Evento con successo!');
    }

    public function delete(Request $request, $id) {
        
        $user = Auth::user();
 
        $element = Evento_Disturbo::where('ID', $id)->first();    
        
        if (!$element) {
            return redirect()->back()->with('error', 'Evento disturbo non trovato');
        }
    

        $element->delete();

        Notifiche::create([
            'ID_Ricevente' =>  $user->ID_Clinico_Del_Paziente,
            'Messaggio' => "Il tuo paziente {$user->name} {$user->surname} ({$user->email}) ha eliminato un evento.",
            'DataNotifica' => now(),
            'Aperta' => 0,
            'Orario' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Evento disturbo eliminato con successo');
    }


    


    

}




        
        
        
 