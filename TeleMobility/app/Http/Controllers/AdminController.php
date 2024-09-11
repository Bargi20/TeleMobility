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
use App\Models\Catalog;
use App\Models\Resources\Evento_Disturbo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use App\Http\Requests\StoreUserRequest;
use App\Models\Resources\Farmaci;
use App\Models\Resources\Attivita;


class AdminController extends Controller
{
    protected $_adminModel;

    public function __construct() {
        $this->_adminModel = new User;
        $this->middleware('can:isAdmin');
    }

    public function getGestioneClinico(): View {
        return view('gestioneClinico');
    }

    public function registraClinico():View{
        return view('registraNuovoClinico');
    }



    public function storeClinico(StoreUserRequest $request): RedirectResponse
    {
         // Validazione dei dati tramite il FormRequest
         // Creazione di un nuovo oggetto utente clinico
        $request->validated();

        $user = new User;
        $user->Descrizione = $request -> Descrizione;
        $user->Specializzazione = $request -> Specializzazione; 
        $user->Terapia = null;
        $user->NumeroTerapia = null; 
        $user->ID_Clinico_Del_Paziente = null; 
        $user->password = Hash::make($request['password']);
        $user->role = "Clinico";
        $user->Ruolo_Clinico = $request->Ruolo;

        
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
        $user->fill($request->except('Terapia',
        'NumeroTerapia','ID_Clinico_Del_Paziente','password','role'));
    
        $user->Immagine = $imageName;
        $user->save();
        
        $destinationPath = public_path() . '/images/';
        if (!file_exists($destinationPath . $imageName)) {
            if ($request->hasFile('Immagine') ) {
                $image->move($destinationPath, $imageName);
            };
        }
        return redirect()->route('GestioneClinico')->with('success', 'Clinico inserito con successo!');

        
    }

    
    public function getFaq(){
        $faq = new Faq;
        return view('faqAdmin')->with('faq', $faq->all());
    }

    public function destroyFaq($Faqid)
    {
        //cerca tra le FAQ quella selezionata e la cancella
        $faq = Faq::where('Id_Faq', $Faqid)->first();
        $faq->delete();

        return redirect()->route('FaqAdmin')->with('success', 'FAQ eliminata con successo.');
    }
    public function editFaq($Faqid)
    {
        //cerca la FAQ e la restituisce alla view
        $faq = FAQ::where('Id_Faq',$Faqid)->first();
        return view('ModificaFaq', compact('faq'));
    }

    public function updateFaq( $Faqid, Request $request):RedirectResponse{
        $validated = $request->validate([
            'Domanda' => 'required|string|max:255',
            'Risposta' => 'required|string',
        ]);

        $faq = Faq::where('Id_Faq', $Faqid)->first();
        //prende gli input Risposta e Domanda dalla form e salva la FAQ
        $faq->Risposta = $validated['Risposta'];
        $faq->Domanda = $validated['Domanda'];
        $faq->save();

        

        return redirect()->route('FaqAdmin')->with('success', 'FAQ aggiornata con successo.');
    }

    public function getStoreFaqPage(){
        return view('paginaStoreFaq');
    }

    public function storeFaq(Request $request ):RedirectResponse{
        $validated = $request->validate([
            'Domanda' => 'required|string|max:255',
            'Risposta' => 'required|string',
        ]);
        
        //Crea una nuova FAQ e prende gli input Risposta e Domanda dalla form. salva la FAQ

        $faq = new Faq();
        $faq -> Domanda = $validated['Domanda'];
        $faq -> Risposta = $validated['Risposta'];
        $faq->save();
        //lo reindirizzo alla pagina per aggiungere altri disturbi e gli serve anche
        //l'id del paziente sennò esce errore
        return redirect()->route('FaqAdmin')->with('success', 'FAQ inserita con successo.');
    }

    public function restituisciClinico5(Int $Numero): View {
        
        
        $clinico = User::where('id', $Numero)->first(); 
         

       
       

        return view('clinicoSel')
                        ->with(['lista' =>$clinico,
                                'Lista_pazienti' =>  $clinico
                        ]); 
    }

    public function restituisciClinico(Int $Numero): View {
        
    
        $clinico = User::where('id', $Numero)->first(); 
        $_p = new Catalog;
       
        

        return view('clinicoSel')
                        ->with(['lista' =>$clinico,
                                'pazienti' => $_p->  getPazienti_perClinico($Numero)
                        ]); 
    }
    
    public function Modifica_Password($id): View {

        return view('ModificaPassword')->with('id_clinico',$id); 
    }
    
    public function delete__paziente($id): RedirectResponse{
    
        $paziente = user::where('id',$id)->first();
        if (!$paziente) {
            return redirect()->back()->with('error', 'Paziente non trovato');
        } 
        $paziente->delete();
        return redirect()->back()->with('success', 'Paziente eliminato con successo'); 
    }

    public function delete__clinico($id): RedirectResponse{
    
        $clinico11 = user::where('id',$id)->first();
        if (!$clinico11) {
            return redirect()->back()->with('error', 'Clinico non trovato');
        } 
        $lista_pazienti = user::where('ID_Clinico_Del_Paziente',$id)->get();
        foreach($lista_pazienti as $paziente)
        {
            $paziente->delete();
        }
        $clinico11->delete();
        return redirect()->route('GestioneClinico')->with('success', 'Clinico eliminato con successo'); 
    }

    public function Modifica_Dati($id): View {
        
        $clinico = user::where('id',$id)->first();

        return view('modificaDatiClinico')->with(['clinico'=>$clinico]); 
    }

    public function Salva_Dati(Request $request, $id): RedirectResponse{

        $clinico = user::where('id',$id) -> first();
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255',
            'Telefono' => 'required|string|size:10',
            'Genere' => 'required|string|max:1|in:F,M',
            'Indirizzo' => 'nullable|string|max:255',
            'Immagine' => 'nullable|image|max:2048',
            'DataDiNascita' => 'required|date|date_format:Y-m-d',
            'Ruolo' => 'required|string|in:Medico,Fisioterapista',
            'Specializzazione' => 'required|string|max:255',
            'Descrizione' => 'required|string' 

        ]);

        $clinico->name = $validated['name'];
        $clinico->surname = $validated['surname'];
        $clinico->email = $validated['email'];
        $clinico->username = $validated['username'];
        $clinico->DataDiNascita = $validated['DataDiNascita'];
        $clinico->Genere = $validated['Genere'];
        $clinico->Descrizione = $validated['Descrizione'];
        $clinico->Specializzazione = $validated['Specializzazione'];
        $clinico->Telefono = $validated['Telefono'];
        $clinico->Indirizzo = $validated['Indirizzo'];
        $clinico->Ruolo_Clinico = $validated['Ruolo'];

        $elimina_la_foto = $request->has('elimina_foto') ? 1 : 0;

        $entra = 0;
        $imageName = $clinico->Immagine;
        if ($elimina_la_foto == 0 and $request->hasFile('Immagine') )
                 {
                    $image = $request->file('Immagine');
                    $imageName = $image->getClientOriginalName();
                    $entra = 2;
                    } 
            elseif($clinico->Immagine == "not_found_M.jpeg" or $clinico->Immagine == "not_found_F.jpeg" or $elimina_la_foto == 1)
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
            
        if($entra != 0)
        {
            $clinico->Immagine= $imageName;
            $clinico->save(); 
        }
        
        $destinationPath = public_path() . '/images/';
        
        if (!file_exists($destinationPath . $imageName) and $entra == 2) {
            if ($request->hasFile('Immagine') ) {
                $image->move($destinationPath, $imageName);
            };
        } 

        $clinico ->save();
        return redirect()->route('ClinicoSel',  ['numero' => $id])->with('success', 'Dati aggiornati con successo!');

    
    }





    

    //------------------------------------------DISTURBI--------------------------------------------



    public function getDisturbi():View{
        $disturbi = Disturbo::orderBy('Nome_Disturbo', 'asc')->paginate(5);
        return view('homePageDisturbiAdmin')->with('disturbi', $disturbi);
    }

    public function deleteDisturbo($IdDisturbo){
        $disturbo = Disturbo::where('Id_Disturbo', $IdDisturbo)->first();
        $disturbo->delete();

        return redirect()->route('DisturbiAdmin')->with('success', 'Il disturbo "'.$disturbo->Nome_Disturbo.'" è stato eliminato con successo!');
    }

    public function editDisturbo($IdDisturbo):View{
        $disturbo = Disturbo::where('Id_Disturbo',$IdDisturbo)->first();

        return view('modificaDisturboAdmin', compact('disturbo'));
    }

    public function updateDisturbo($IdDisturbo, Request $request ) : RedirectResponse{
        $validated = $request->validate([
            'Nome_Disturbo' => 'required|string|max:250',
            'Descrizione'=>  'required',
        ]);
        //disturbo vecchio per mostrare il messaggio più carino
        $old = Disturbo::where('Id_Disturbo', $IdDisturbo)->first();
        

        $disturbo = Disturbo::where('Id_Disturbo', $IdDisturbo)->first();

        if ($disturbo->Nome_Disturbo === $validated['Nome_Disturbo'] and $disturbo->Descrizione == $validated['Descrizione']) {
            return redirect()->back()->with('error', 'Il disturbo "'.$disturbo->Nome_Disturbo.'" non è stato modificato!');
        }
        $disturbo->Nome_Disturbo = $validated['Nome_Disturbo'];
        $disturbo->Descrizione = $validated['Descrizione'];
        $disturbo->save();        

        return redirect()->route('DisturbiAdmin')->with('success', 'Il disturbo "'.$old->Nome_Disturbo.
                                                        '" è stato aggiornato in "'.$disturbo->Nome_Disturbo.'" con successo!');
    }
    
    public function getStoreDisturboPage ():View{
        return view('aggiungiNuovoDisturboAdmin');
    }

    public function storeDisturbo (Request $request ):RedirectResponse{

        $validated = $request->validate([
            'Nome_Disturbo' => 'required|string|max:250',
            'Descrizione' => 'required',
        ]);

        

        $disturbo= new Disturbo();
        $disturbo->Nome_Disturbo = $validated['Nome_Disturbo'];
        $disturbo->Descrizione = $validated['Descrizione'];

        $exists = Disturbo::where('Nome_Disturbo', $validated['Nome_Disturbo'])
                            ->exists();

        if($exists){

            return redirect()->back()->with('error', 'Il disturbo "'.$disturbo->Nome_Disturbo.'" è già presente nel catalogo!');
        
        }else{
            $disturbo->save();
        }

        return redirect()->route('DisturbiAdmin')->with('success', 'Il disturbo "'.$disturbo->Nome_Disturbo.'" è stato aggiunto con successo!');
    }
    

  //-----------------------------------------ANALISI DATI-------------------------------------------------------------//





    public function showSatistiche(Request $request)
        {
            //prende solo i pazienti con il clinico assegnato, dato che serve per il punto 1 ma anche
            //per il punto 2, dato che solo i pazienti con un clinico che gli assegna il disturbo
            //possono effettivamente registrare gli eventi
            $Npaziente = User::where('role', 'Paziente')->whereNotNull('ID_Clinico_Del_Paziente')->count();
            $Nclinico = User::where('role', 'Clinico')->count();
            $Ndiagnosi = Diagnosi::where('Stato',1)->count();

            $NEventiRegistrati = Evento_Disturbo::all()->count();
            
            $media1punto =  $Nclinico/$Npaziente;
            $media2punto = $NEventiRegistrati / $Npaziente;

            $media1puntoArrotondata = round($media1punto, 2);
            $media2puntoArrotondata = round($media2punto, 2);

            
            $pazienti = User::where('role', 'Paziente')->get();

            
            $clinici = User::where('role', 'Clinico')->get();
            $disturbi = Disturbo::orderBy('Nome_Disturbo', 'asc')->get();

            $eventiPerDisturbo = [];
            foreach ($disturbi as $disturbo) {
                $eventiPerDisturbo[$disturbo->Id_Disturbo] = Evento_Disturbo::where('ID_Disturbo', $disturbo->Id_Disturbo)->count();
            }

            
            $labels=[];
            $data=[];
            $i = 0;
            foreach ($disturbi as $disturbo) {
                //si assicura che la chiave sia unica per ogni disturbo
                $labels [$i]= $disturbo->Nome_Disturbo;
                $data [$i]=Evento_Disturbo::where('ID_Disturbo', $disturbo->Id_Disturbo)->count();
                $i++;
            }
        
            return view('HomeStatistiche', compact('media1puntoArrotondata', 'media2puntoArrotondata', 
                                        'disturbi', 'eventiPerDisturbo','pazienti','clinici','data','labels'));


        }

    public function ricercaPaziente(Request $request)
        {   

            //estraggo dalla form la query, ovvero quello che scrivo
            $query = $request->input('query');

            // Dividiamo la query in termini separati per nome e cognome
            //altrimenti se ci metto lo spazio o se scrivo prima il cognome
            //non me lo trova
            $terms = explode(' ', $query);
            
            //controllo se il nome o il cognome ci sono
            $patients = User::where(function ($query) use ($terms) {
                //faccio una ricerca dove spero che almeno uno dei campi name
                //o surname abbia uno dei termini scritti nella form
                //iterando su terms
                foreach ($terms as $term) {
                    $query->orWhere('name', 'LIKE', "%$term%")
                        ->orWhere('surname', 'LIKE', "%$term%");
                }
            })->where('role', 'Paziente')->get();
            //chiaramente prendo solo i Pazienti

            //la risposta mi serve in formato Json
            return response()->json($patients);
        }





















        public function getTerapia($id)
        {
    
            //trova il paziente associato all'id passatp
            $paziente = User::find($id);
    
    
            //prendo quanti eventi ha registrato il paziente
            $EventiRegistrati = Evento_Disturbo::where('ID_Paziente', $id)->count();
    
            //prendo i disturbi assegnati al paziente
            $disturbiRegistrati = Diagnosi::where('ID_Paziente', $id)
                ->where('Stato', 1)
                ->count();
            //se non ne ha imposto direttamente la media a 0 poichè altrimenti
            //si ottiene una divisione per 0 e un errore
            if($disturbiRegistrati == 0){
                $media2Punto = 0;
            }else{
                $media2Punto = $EventiRegistrati / $disturbiRegistrati;
            }
    
    
            $media2Arrotondata= round($media2Punto, 2);
    
            //se non ha una terapia la imposto a 0
            if($paziente->NumeroTerapia == null){
                $paziente->NumeroTerapia = 0;
            }
            $terapia = $paziente->NumeroTerapia;
    
            //trovo il clinico associato al paziente
            $clinico = User::find($paziente->ID_Clinico_Del_Paziente);
    
            //se non ha il clinico gestisco la cosa per farlo capire in view
            if(!$clinico){
                $clinico = null;
                $dottoreDelPaziente = null;
    
                //ritorno i dati in tipo json
                return response()->json([
                    'terapia' => $terapia,
                    'dottoreDelPaziente' => $dottoreDelPaziente,
                    'media2Arrotondata' => $media2Arrotondata,
    
                ]);
    
            }
    
    
            //se ce l'ha mi salvo nome e cognome e lo invio in view
            $dottoreDelPaziente = $clinico->name.' '.$clinico->surname;
    
                    return response()->json([
                        'terapia' => $terapia,
                        'dottoreDelPaziente' => $dottoreDelPaziente,
                        'media2Arrotondata' => $media2Arrotondata,
    
                    ]);
        }
        
    //------------------------------------CRUD FARMACI---------------------------------//

    public function showFarmaci (){
        $farmaci = Farmaci::orderBy('Nome_Farmaco','asc')->paginate(5);
        return view ('homePageFarmaciAdmin', compact('farmaci'));
    }


    public function deleteFarmaco($IDFarmaco){
        $farmaco = Farmaci::where('ID_Farmaco', $IDFarmaco)->first();
        $farmaco->delete();

        return redirect()->route('FarmaciAdmin')->with('success', 'Il farmaco "'.$farmaco->Nome_Farmaco.'" è stato eliminato con successo!');
    }


    public function updateFarmaco($IDFarmaco, Request $request ): RedirectResponse{

        $validated = $request->validate([
            'Nome_Farmaco' => 'required|string|max:250',
            'Descrizione' => 'required|string'
        ]);

        $farmaco = Farmaci::where('ID_Farmaco', $IDFarmaco)->first();
            
            //farmaco vecchio per mostrare il messaggio più carino
        $old = Farmaci::where('ID_Farmaco', $IDFarmaco)->first();
            
    
    
        if ($farmaco->Nome_Farmaco === $validated['Nome_Farmaco'] && $farmaco->Descrizione === $validated['Descrizione']) {
            return redirect()->back()->with('error', 'Il farmaco "'.$farmaco->Nome_Farmaco.'" non è stato modificato!');
        }

        
        $farmaco->Nome_Farmaco = $validated['Nome_Farmaco'];
        $farmaco->Descrizione = $validated['Descrizione'];

        $farmaco->save();        

        return redirect()->route('FarmaciAdmin')->with('success', 'Il farmaco "'.$old->Nome_Farmaco.
                                                        '" è stato aggiornato in "'.$farmaco->Nome_Farmaco.'" con successo!');
        }

        public function editFarmaco($IDFarmaco):View{
            $farmaco = Farmaci::where('ID_Farmaco', $IDFarmaco)->first();
    
            return view('modificaFarmacoAdmin', compact('farmaco'));
        }


        public function getStoreFarmacoPage():View{
                return view('aggiungiNuovoFarmacoAdmin');
            
        }
        
        public function storeFarmaco (Request $request ):RedirectResponse{

            $validated = $request->validate([
                'Nome_Farmaco' => 'required|string|max:250',
                'Descrizione' => 'required|string',
            ]);
    
            
    
            $farmaco= new Farmaci();
            $farmaco->Nome_Farmaco = $validated['Nome_Farmaco'];
            $farmaco->Descrizione = $validated['Descrizione'];

    
            //se il farmaco esiste già non lo aggiungo al catalogo e lo rimando alla form
            $exists = Farmaci::where('Nome_Farmaco', $validated['Nome_Farmaco'])
                                ->exists();
    
            if($exists){
    
                return redirect()->back()->with('error', 'Il farmaco "'.$farmaco->Nome_Farmaco.'" è già presente nel catalogo!');
            
            }else{
                $farmaco->save();
            }
    
            return redirect()->route('FarmaciAdmin')->with('success', 'Il farmaco "'.$farmaco->Nome_Farmaco.'" è stato aggiunto con successo!');
        }











        




    // --------------------------------CRUD ATTIVITà--------------------------------//






    public function showAttività (){
        $attività = Attivita::orderBy('Nome_Attività','asc')->paginate(5);
        return view ('HomePageAttivitàAdmin', compact('attività'));
    }



    public function deleteAttività($IDAttività)
    {
        $attività = Attivita::where('Id_Attività_Riabilitative', $IDAttività)->first();
        if ($attività) {
             $attività->delete();
            return redirect()->route('AttivitaAdmin')->with('success', 'L\'attività riabilitativa "'.$attività->Nome_Attività.'" è stata eliminata con successo!');
        } else {
            return redirect()->route('AttivitaAdmin')->with('error', 'L\'attività riabilitativa non è stata trovata.');
        }
    }
    

    public function updateAttività($IDAttività, Request $request): RedirectResponse{

        $validated = $request->validate([
            'Nome_Attività' => 'required|string|max:250',
            'Descrizione' => 'required|string',
        ]);

        $attività = Attivita::where('Id_Attività_Riabilitative', $IDAttività)->first();
            
        $old = Attivita::where('Id_Attività_Riabilitative', $IDAttività)->first();
            
    
    
        if ($attività->Nome_Attività === $validated['Nome_Attività'] && $attività->Descrizione === $validated['Descrizione']) {

            return redirect()->back()->with('error', 'L\' attività riabilitativa "'.$attività->Nome_Attività.'" non è stato modificata!');
        }
        $attività->Nome_Attività = $validated['Nome_Attività'];
        $attività->Descrizione = $validated['Descrizione'];
        $attività->save();        

        return redirect()->route('AttivitaAdmin')->with('success', 'L\' attività riabilitativa "'.$old->Nome_Attività.
                                                        '" è stato aggiornata in "'.$attività->Nome_Attività.'" con successo!');
        }
    


    public function editAttività($IDAttività): View{
        $attività = Attivita::where('Id_Attività_Riabilitative', $IDAttività)->first();

        
        return view('modificaAttivitàAdmin', compact('attività'));

    }
    public function getStoreAttivitàPage():View{
        return view('aggiungiNuovaAttivitaAdmin');
    
    }
    public function storeAttività (Request $request ):RedirectResponse{

        $validated = $request->validate([
            'Nome_Attività' => 'required|string|max:250',
            'Descrizione' => 'required|string',
        ]);

        

        $attività= new Attivita();
        $attività->Nome_Attività = $validated['Nome_Attività'];
        $attività->Descrizione = $validated['Descrizione'];


        //se il farmaco esiste già non lo aggiungo al catalogo e lo rimando alla form
        $exists = Attivita::where('Nome_Attività', $validated['Nome_Attività'])
                            ->exists();

        if($exists){

            return redirect()->back()->with('error', 'L\' attività riabilitativa "'.$attività->Nome_Attività.'" è già presente nel catalogo!');
        
        }else{
            $attività->save();
        }

        return redirect()->route('AttivitaAdmin')->with('success', 'L\' attività riabilitativa "' .$attività->Nome_Attività.'" è stata aggiunta con successo!');
    }

    // Ricerca Clinici

    public function search_clinico(Request $request)
    {
        $query = $request->input('query');

    // Cerca i clinici che corrispondono alla query
        $clinici = User::where('role', 'Clinico')
                    ->where(function($subQuery) use ($query) {
                        $subQuery->where('name', 'LIKE', "%{$query}%")
                                 ->orWhere('surname', 'LIKE', "%{$query}%");
                    })
                    ->get();

        return response()->json($clinici);
    }
}
