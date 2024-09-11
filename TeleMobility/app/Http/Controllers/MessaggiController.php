<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Messaggi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

use Illuminate\Database\Eloquent\Collection;

use App\Providers\AuthServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\Resources\Disturbouse;
use App\Models\Resources\Diagnosi;

use App\Models\Resources\Disturbo;
use Illuminate\Database\Eloquent\Model;
use Brick\Math\BigInteger;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Resources\Faq;
use App\Models\Resources\Clinico;
use App\Models\Resources\Paziente;

use App\Models\Catalog;
use App\Models\Resources\Evento_Disturbo;
use App\Models\Resources\Notifiche;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Contracts\Encryption\DecryptException;
class MessaggiController extends Controller
{
    protected $_MessaggiModel;

    public function __construct() {
        $this->_MessaggiModel = new Messaggi;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $user = Auth::user();
        $dataOra = now();
        if($user->role == "Clinico")
        {
            $validated = $request->validate([
                'id_destinatario' => 'required|array|min:1',
                'corpo' => 'required',
                'contenuto' => 'required',
            ]);

            $destinatari = $request->input('id_destinatario');

         
            
            foreach ($destinatari as $destinatario_id) {
                
                $corpo_criptato = Crypt::encryptString($validated['corpo']);
                $contenuto_criptato = Crypt::encryptString($validated['contenuto']); 
                
                $messaggio = new Messaggi;
                $messaggio->id_destinatario = $destinatario_id;
                $messaggio->id_mittente = $user->id;
                $messaggio->corpo =$corpo_criptato;
                $messaggio->contenuto =  $contenuto_criptato;
                $messaggio->aperto = 0;
                $messaggio->orario = $dataOra;
                $messaggio->id_risposta = null;
        
                
                $messaggio->save();
                Notifiche::create([
                    'ID_Ricevente' =>  $messaggio->id_destinatario,
                    'Messaggio' => 'Il tuo clinico ti ha inviato un messaggio.',
                    'DataNotifica' => now(),
                    'Aperta' => 0,
                    'Orario' => now(),
                ]);
            }
           
            if(count($destinatari)==1)
            return redirect()->route('home_messaggi')->with('success', 'Messaggio inviato con successo!');
           else
           return redirect()->route('home_messaggi')->with('success', 'Messaggi inviati con successo!'); 
            
    
            
        }
        if($user->role == "Paziente")
        {
            $validated = $request->validate([
                'corpo' => 'required',
                'contenuto' => 'required',
            ]);
    
            
    
            $corpo_criptato = Crypt::encryptString($validated['corpo']);
            $contenuto_criptato = Crypt::encryptString($validated['contenuto']); 
            
            $messaggio = new Messaggi;
            
            $messaggio->id_destinatario = $user->ID_Clinico_Del_Paziente;
            $messaggio->id_mittente = $user->id;
            $messaggio->corpo =$corpo_criptato;
            $messaggio->contenuto =  $contenuto_criptato;
            $messaggio->aperto = 0;
            $messaggio->orario = $dataOra;
    
            $mandante = User::where('ID', $messaggio->id_mittente)->first();

            $messaggio->save();
            Notifiche::create([
                'ID_Ricevente' =>  $messaggio->id_destinatario,
                'Messaggio' => "Il tuo paziente {$mandante->name} {$mandante->surname} ({$mandante->email}) ti ha inviato un messaggio.",
                'DataNotifica' => now(),
                'Aperta' => 0,
                'Orario' => now(),
            ]);
            return redirect()->route('home_messaggi_paziente')->with('success', 'Messaggio inviato con successo!');
        }

        
    }

    public function store_risposta(Request $request, $risposta)
    
    {   
        $user = Auth::user();
        $dataOra = now();
        if($user->role == "Clinico")
        {
            $validated = $request->validate([
                'id_destinatario' => 'required',
                'corpo' => 'required',
                'contenuto' => 'required',
            ]);
    
            
    
            $corpo_criptato = Crypt::encryptString($validated['corpo']);
            $contenuto_criptato = Crypt::encryptString($validated['contenuto']); 
            
            $messaggio = new Messaggi;

            $messaggio->id_destinatario = $validated['id_destinatario'];
            $messaggio->id_mittente = $user->id;
            $messaggio->id_risposta = $risposta; 
            $messaggio->corpo =$corpo_criptato;
            $messaggio->contenuto =  $contenuto_criptato;
            $messaggio->aperto = 0;
            $messaggio->orario = $dataOra;
    
    
            $messaggio->save();
            Notifiche::create([
                'ID_Ricevente' =>  $messaggio->id_destinatario,
                'Messaggio' => 'Il tuo clinico ha risposto ad un tuo messaggio.',
                'DataNotifica' => now(),
                'Aperta' => 0,
                'Orario' => now(),
            ]);
            return redirect()->route('home_messaggi')->with('success', 'Messaggio inviato con successo!');
        }
        if($user->role == "Paziente")
        {
            $validated = $request->validate([
                'corpo' => 'required',
                'contenuto' => 'required',
            ]);
    
            
    
            $corpo_criptato = Crypt::encryptString($validated['corpo']);
            $contenuto_criptato = Crypt::encryptString($validated['contenuto']); 
            
            $messaggio = new Messaggi;
            
            $messaggio->id_destinatario = $user->ID_Clinico_Del_Paziente;
            $messaggio->id_mittente = $user->id;
            $messaggio->id_risposta = $risposta; 
            $messaggio->corpo =$corpo_criptato;
            $messaggio->contenuto =  $contenuto_criptato;
            $messaggio->aperto = 0;
            $messaggio->orario = $dataOra;
    
    
            $messaggio->save();
            $mandante = User::where('ID', $messaggio->id_mittente)->first();
            Notifiche::create([
                'ID_Ricevente' =>  $messaggio->id_destinatario,
                'Messaggio' => "Il tuo paziente {$mandante->name} {$mandante->surname} ({$mandante->email}) ha risposto ad un tuo messaggio.",
                'DataNotifica' => now(),
                'Aperta' => 0,
                'Orario' => now(),
            ]);
    
            return redirect()->route('home_messaggi_paziente')->with('success', 'Messaggio inviato con successo!');
        }

        
    }


    public function gethome_messaggi(): View{

        return view('home_messaggi');
}

public function nuovo_mex(): View
{
    $user = Auth::user(); 
    
    if($user->role == "Clinico")
    {
        $_p = new Catalog;
        $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
        
        if (!($pazienti_lista instanceof \Illuminate\Support\Collection)) {
            $pazienti_lista = collect($pazienti_lista);
        }
        $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
            return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
            });
        
           
    
            return view('nuovo_messaggio_view', compact('pazienti'))
            ->with('ruolo', $user->role);


          
    }
    if($user->role == "Paziente")
    {   
       
        $_p = new Catalog; 
        $dottore = $_p->getDottori($user->ID_Clinico_Del_Paziente);
        return view('nuovo_messaggio_view')->with('ruolo',$user->role);
    }

    
    }

   
    
    public function set($id)
    {   $user = Auth::user();
        $messaggio = New Messaggi;
        $messaggio = Messaggi::where('id', $id)->first();
        $messaggio->aperto = 1;
        $messaggio->save();
        $tipo = 'non_letti';
        if($user->role == "Clinico")
        {
            return redirect()->route('home_messaggi')->with('success', 'Messaggio segnato come letto!');
        }
    
        if($user->role == "Paziente")
        {
            return redirect()->route('home_messaggi_paziente')->with('success', 'Messaggio segnato come letto!');
        } 
        
        
    }
    public function delete($id)
    {   $user = Auth::user();
        $messaggio = New Messaggi;
        $messaggio = Messaggi::where('id', $id)->first();

        if ($messaggio) {

            $messaggio_domanda = Messaggi::where('id_risposta', $id)->first();
    
            
            if ($messaggio_domanda) {
                $messaggio_domanda->id_risposta = null;
                $messaggio_domanda->save(); // Save the changes
            }
    
            
        } 


        
        
        if($user->role == "Clinico")
        {   
            $tipo = 'invati';
            
            Notifiche::create([
                'ID_Ricevente' =>  $messaggio->id_destinatario,
                'Messaggio' => 'Il tuo clinico ha eliminato un messaggio inviato a te.',
                'DataNotifica' => now(),
                'Aperta' => 0,
                'Orario' => now(),
            ]);
            $messaggio-> delete();     
            return redirect()->route('home_messaggi')->with('success', 'Messaggio eliminato con successo!');
        }
    
        if($user->role == "Paziente")
        {
           

            $mandante = User::where('ID', $messaggio->id_mittente)->first();

            $messaggio->save();
            Notifiche::create([
                'ID_Ricevente' =>  $messaggio->id_destinatario,
                'Messaggio' => "Il tuo paziente {$mandante->name} {$mandante->surname} ({$mandante->email}) ha eliminato un messaggio a te inviato.",
                'DataNotifica' => now(),
                'Aperta' => 0,
                'Orario' => now(),
            ]);
            
            
            $tipo = 'invati';
            $messaggio-> delete();  
            return redirect()->route('home_messaggi_paziente')->with('success', 'Messaggio eliminato con successo!');
        } 

            
    }


    public function visualizza_mex($tipo): View
    { 
        $user = Auth::user(); 
        if($tipo ==1)
        {
            if($user->role == "Paziente")
            {
                $user = Auth::user();
                $_p = new Catalog;
                $messaggi_lista = $_p->get_messaggi_by_id_mittente($user->id);
                $messaggi_a_cui_ho_risposto = $_p->get_messaggi_a_cui_ho_risposto($user->id);
                if ($tipo == 1) {
                    $tipo = 'inviati';
                    return view('messaggi')
                        ->with([
                            'tipo' => $tipo,
                            'Lista_messaggi' => $messaggi_lista,
                            'Utente' => $user,
                            'Domande' => $messaggi_a_cui_ho_risposto,
                        ]);
                }
            }
            if($user->role == "Clinico")
            { 
                
                $_p = new Catalog;
                $messaggi_lista = $_p->get_messaggi_by_id_mittente($user->id);
                $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
                $messaggi_a_cui_ho_risposto = $_p->get_messaggi_a_cui_ho_risposto($user->id);

                $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                    return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                    });
     
                
                $pazienti_messaggiati = $_p->get_pazienti_a_cui_ho_inviato_messaggi($user->id);
                if ($tipo == 1) {
                    $tipo = 'inviati';
                    return view('messaggi', compact('pazienti'))
                        ->with([
                            'tipo' => $tipo,
                            'Lista_messaggi' => $messaggi_lista,
                            'Utente' => $user,
                            'Domande' => $messaggi_a_cui_ho_risposto,
                            'Lista_pazienti' => $pazienti_messaggiati,
                        ]);
                }
    
            }
        }
        if($tipo ==2)
        {
            
            
                
                $_p = new Catalog;
                $messaggi_lista = $_p->get_messaggi_non_letti_by_id_destinatario($user->id);
                $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);

                $messaggi_prec= $_p->get_messaggi_precedenti_by_id_destinatario_da_messaggi_non_letti($user->id);
                $pazienti_messaggiati = $_p->get_pazienti_che_mi_hanno_inviato_un_messaggio_non_letto($user->id);
                $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                    return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                    });
    
                    $tipo = 'non_letti';
                    return view('messaggi', compact('pazienti'))
                        ->with([
                            'tipo' => $tipo,
                            'Lista_messaggi' => $messaggi_lista,
                            'Utente' => $user,
                            'Messaggi_prec'=>  $messaggi_prec,
                            'Lista_pazienti' => $pazienti_messaggiati,
                        ]);
                
    
            }
        
        if($tipo ==3)
        {
            
                $_p = new Catalog;
                $messaggi_lista = $_p->get_messaggi_letti_by_id_destinatario($user->id);
                
                $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
                $messaggi_prec= $_p->get_messaggi_precedenti_by_id_destinatario_da_messaggi_letti($user->id);
                $pazienti_messaggiati = $_p->get_pazienti_che_mi_hanno_inviato_un_messaggio_letto($user->id);
                $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                    return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                    });
    
               
                    $tipo = 'letti';
                    return view('messaggi', compact('pazienti'))
                        ->with([
                            'tipo' => $tipo,
                            'Lista_messaggi' => $messaggi_lista,
                            'Utente' => $user,
                            'Messaggi_prec'=>  $messaggi_prec,
                            'Lista_pazienti' => $pazienti_messaggiati,
                        ]);
                
    
            
        }
        

        
       
    }

    public function nuovo_mex_risposta($risposta): View
{
    $user = Auth::user(); 
    
    if($user->role == "Clinico")
    {
        $_p = new Catalog;
        $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
        
        if (!($pazienti_lista instanceof \Illuminate\Support\Collection)) {
            $pazienti_lista = collect($pazienti_lista);
        }
        $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
            return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
            });
        
           
            
            
            $a = $_p->get_paziente_by_id_messaggio($risposta);
            return view('nuovo_messaggio_view', compact('pazienti'))
            ->with('ruolo', $user->role)
            ->with('id_risposta', $risposta)
            ->with('id_paziente', $a);


          
    }
    if($user->role == "Paziente")
    {   
        $_p = new Catalog; 
        $dottore = $_p->getDottori($user->ID_Clinico_Del_Paziente);
        return view('nuovo_messaggio_view')->with('ruolo',$user->role)->with('id_risposta', $risposta);

    
    }
}


public function visualizza_mex_inviati_filtrata($p): View
{ 
    $user = Auth::user(); 
    $_p = new Catalog;
    $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
    $messaggi_lista = $_p->get_messaggi_filtrati_by_id_mittente($user->id,$p);
    $messaggi_a_cui_ho_risposto = $_p->get_messaggi_a_cui_ho_risposto($user->id);

    $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                });
  
            
            $pazienti_messaggiati = $_p->get_pazienti_a_cui_ho_inviato_messaggi($user->id);
           
        $tipo = 'inviati';
                return view('messaggi', compact('pazienti'))
                    ->with([
                        'tipo' => $tipo,
                        'Lista_messaggi' => $messaggi_lista,
                        'Utente' => $user,
                        'Domande' => $messaggi_a_cui_ho_risposto,
                        'Lista_pazienti' => $pazienti_messaggiati,
                        'filtro' => 1,
                        
                    ]);
            

        }
public function visualizza_mex_letti_filtrata($p): View
        {
          
                    
                    
                        $user = Auth::user(); 
                        $_p = new Catalog;
                        $messaggi_lista = $_p->get_messaggi_filtrati_letti_by_id_destinatario($user->id,$p);
                        $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
        
                        $messaggi_prec= $_p->get_messaggi_precedenti_by_id_destinatario_da_messaggi_non_letti($user->id);
        
                        $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                            return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                            });
        
                        $pazienti_messaggiati = $_p->get_pazienti_che_mi_hanno_inviato_un_messaggio_letto($user->id);
        
                            $tipo = 'letti';
                            return view('messaggi', compact('pazienti'))
                                ->with([
                                    'tipo' => $tipo,
                                    'Lista_messaggi' => $messaggi_lista,
                                    'Utente' => $user,
                                    'Messaggi_prec'=>  $messaggi_prec,
                                    'Lista_pazienti' => $pazienti_messaggiati,
                                    'filtro' => 3,
                                
                                ]);
                        
            
        }
        
        public function visualizza_mex_non_letti_filtrata($p): View
        {
          
                    
                    
                        $user = Auth::user(); 
                        $_p = new Catalog;
                        $messaggi_lista = $_p->get_messaggi_filtrati_non_letti_by_id_destinatario($user->id,$p);
                        $pazienti_lista = $_p->get_Pazienti_perClinico_lista($user->id);
        
                        $messaggi_prec= $_p->get_messaggi_precedenti_by_id_destinatario_da_messaggi_non_letti($user->id);
        
                        $pazienti = $pazienti_lista->mapWithKeys(function ($paziente) {
                            return [$paziente->id => $paziente->name . ' ' . $paziente->surname . ' -> ' . $paziente->email ];
                            });
        
                        $pazienti_messaggiati = $_p->get_pazienti_che_mi_hanno_inviato_un_messaggio_non_letto($user->id);
        
                       
                            $tipo = 'non_letti';
                            return view('messaggi', compact('pazienti'))
                                ->with([
                                    'tipo' => $tipo,
                                    'Lista_messaggi' => $messaggi_lista,
                                    'Utente' => $user,
                                    'Messaggi_prec'=>  $messaggi_prec,
                                    'Lista_pazienti' => $pazienti_messaggiati,
                                    'filtro' => 2,
                                
                                ]);
                        
            
        }
        



}


