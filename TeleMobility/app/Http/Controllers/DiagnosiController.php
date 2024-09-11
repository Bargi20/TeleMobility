<?php

namespace App\Http\Controllers;

use App\Models\Resources\Disturbo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Resources\Evento_Disturbo;
use Illuminate\Support\Facades\Log;
use App\Models\Resources\Diagnosi;
use App\Models\Resources\Notifiche;
use App\Models\Resources\Attività;
use App\Models\Resources\Farmaci;
use App\Models\Resources\Attivita;

class DiagnosiController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $disturbi = Disturbo::whereHas('diagnosi', function($query) use ($user) {
            $query->where('ID_Paziente', $user->id)->where('Stato', '1');
        })->pluck('Nome_Disturbo', 'Id_Disturbo');

        return view('InserisciEvento', compact('disturbi'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ID_Disturbo' => ['required'],
            'Data_Evento' => ['required'],
            'Durata' => ['required'],
            'Intensita' => ['required'],
            'Orario' => ['required'],
        ]);
    $user = Auth::user();


    $disturbo = new Evento_Disturbo();

    $disturbo->ID_Paziente = $user->id;
    $disturbo->ID_Disturbo = $validated['ID_Disturbo'];
    $disturbo->Data_Evento = $validated['Data_Evento'];
    $disturbo->Durata = $validated['Durata'];
    $disturbo->Intensità = $validated['Intensita'];
    $disturbo->Orario = $validated['Orario'];
    $disturbo->save();
    Notifiche::create([
        'ID_Ricevente' =>  $user->ID_Clinico_Del_Paziente,
        'Messaggio' => "Il tuo paziente {$user->name} {$user->surname} ({$user->email}) ha inserito un nuovo evento.",
        'DataNotifica' => now(),
        'Aperta' => 0,
        'Orario' => now(),
    ]);

    return redirect()->route('Paziente')->with('success', 'Evento inserito con successo!');
}

public function getDisturbiNonAssegnati ( int $idPaziente){

    $p = User::where('id', $idPaziente)->first();

    //recupero solo i disturbi che ancora non sono assegnati al paziente
    $disturbi = Disturbo::whereDoesntHave('diagnosi', function($query) use ($idPaziente){
        $query->where('ID_Paziente', $idPaziente);
    })
    ->orWhereHas('diagnosi', function($query) use ($idPaziente)
    {
        $query->where('ID_Paziente', $idPaziente)
              ->where('Stato', 0);
              
    })->orderBy('Nome_Disturbo', 'asc')->get()->pluck('Nome_Disturbo', 'Id_Disturbo');
    
    
    
    //qui vedo se il paziente ha tutti i disturbi possibili 
    //così posso mostrare un messaggio nella pagina aggiungiDisturbo
    $disturbiDisponibili = $disturbi->isEmpty(); 

    //qui ritorno la vista aggiungiDisturbo e gli passo i parametri
    //$idPaziente, $disturbi e $disturbiDisponibili
   
    return view('aggiungiDisturbo', compact('disturbi','idPaziente', 'disturbiDisponibili'))
    ->with('paziente', $p);

}

public function storeNewDiagnosi($idPaziente, Request $request ):RedirectResponse{

    $validated = $request->validate([
        'ID_Disturbo' => ['required'],
        
    ]);

    $exists = Diagnosi::where('ID_Paziente', $idPaziente)
                ->where('ID_Disturbo', $validated['ID_Disturbo'])
                ->exists();

   
    if ($exists) {
        $diagnosi = Diagnosi::where('ID_Paziente', $idPaziente)->where('ID_Disturbo', $validated['ID_Disturbo'])->where('Stato', 0)->update(['Stato' => 1]);
            return redirect()->route('aggiungi_disturbo', ['idPaziente' => $idPaziente]);
        
        
    }
    if(!$exists)
    {
    $diagnosi = new Diagnosi();
    $diagnosi -> ID_Disturbo = $validated['ID_Disturbo'];
    $diagnosi -> ID_Paziente = $idPaziente;
    $diagnosi -> stato = 1;
    $diagnosi->save();

    return redirect()->route('aggiungi_disturbo', ['idPaziente' => $idPaziente])->with('success', 'Disturbo inserito con successo!');
    }
    
}
  
    public function getDisturbo($id)
    {
        $disturbo = Disturbo::where('Id_disturbo', $id)->first();
        return view('DescrizioneDisturbo')->with('disturbo',$disturbo );
    }


    public function getDisturbiAssegnati ( int $idPaziente)
    {

        $p = User::where('id', $idPaziente)->first();

        $disturbi = Disturbo::whereHas('diagnosi', function($query) use ($idPaziente){
            $query->where('ID_Paziente', $idPaziente)
            ->where('Stato', 1);
        })->orderBy('Nome_Disturbo', 'asc')->get()->pluck('Nome_Disturbo', 'Id_Disturbo');
        

        
        $disturbiposseduti = $disturbi->isEmpty(); 

        return view('rimuovidisturbo_clinico', compact('disturbi','idPaziente', 'disturbiposseduti'))
        ->with('paziente', $p);

}

public function rimuovidisturbo($idPaziente, Request $request ):RedirectResponse{
    $validated = $request->validate([
        'ID_Disturbo' => ['required'],
        
    ]);

    
        $diagnosi = Diagnosi::where('ID_Paziente', $idPaziente)->where('ID_Disturbo', $validated['ID_Disturbo'])->where('Stato', 1)->update(['Stato' => 0]);

        return redirect()->route('rimuovi_disturbo', ['idPaziente' => $idPaziente])->with('success', 'Disturbo eliminato con successo!');
    }
    




    public function ModificaTerapia($idPaziente)
    {
        $k= User::where('id',$idPaziente)->first();
        $farmaci = Farmaci::orderBy('Nome_Farmaco', 'asc')->get();
        $attivita = Attivita::orderBy('Nome_Attività','asc')->get();
        

        return view ('ModificaTerapia')->with('paziente',$k)->with('farmaci', $farmaci)->with('attività', $attivita);
    }


public function updateterapia(Request $request, $idPaziente)
{
    $user = User::findOrFail($idPaziente);
    $farmaci = $request->input('farmaci');
    $attivita = $request->input('attivita');


    if (!empty($farmaci)) {
        if($request->terapia == "")
        {
            $stringa_iniziale = "Lista dei farmaci:\n\n";
        }
        else
        {
            $stringa_iniziale = "\n<------------------------> \n\n Lista dei farmaci:\n\n";
        }
        
        $stringa_farmaci = $stringa_iniziale;

        $primo_ciclo = true;
            foreach ($farmaci as $id) 
            {
                $farmaco = Farmaci::findOrFail($id);
                $singolo_farmaco = $farmaco->Nome_Farmaco;
                $descrizione = $farmaco->Descrizione;
                $add = "$singolo_farmaco\n -> $descrizione";
                if ($primo_ciclo) {
                
                    $stringa_farmaci .= $add . "\n";
                    $primo_ciclo = false; 
                }else
            {
                $stringa_farmaci .= "\n" . $add . "\n"; // Aggiungi un ritorno a capo dopo ogni singolo farmaco

            }
             }
        
    
        $stringa_finale_farmaci = $stringa_farmaci;
    } 
    else
    {
        $stringa_finale_farmaci = "/";
    }

    

    $primo_ciclo = true;
    
    if (!empty($attivita))
     {
        if($request->terapia == "" and empty($farmaci))
        {
            $stringa_iniziale_attività = "Lista delle attività riabilitative :\n\n";

        }
        else
        {
           
            $stringa_iniziale_attività = "\n<------------------------> \n\n Lista delle attività riabilitative :\n\n";
            
 
        }
        $stringa_lista_att =  $stringa_iniziale_attività;
        foreach ($attivita as $id) 
        {
            $singola_attivita = Attivita::findOrFail($id);
            $nome_att = $singola_attivita->Nome_Attività;
            $descrizione = $singola_attivita->Descrizione;
            $add = "$nome_att\n -> $descrizione";
            if ($primo_ciclo) {
                
                $stringa_lista_att .= $add . "\n"; 
                $primo_ciclo = false; 
            }
            else
            {
                $stringa_lista_att .= "\n" . $add . "\n"; // Aggiungi un ritorno a capo dopo ogni singolo farmaco

            }
        }
        $stringa_finale_attività = $stringa_lista_att;
    }
    else
    {
        $stringa_finale_attività = "/";
    }

    if($request->terapia == "")
    {
        $stringa_terapia = "/";
    }
    else
    {
        $stringa_terapia = $request->terapia;
        $stringa_terapia .= "\n";
    }

    $finale = "";
    if($stringa_terapia != "/" or $stringa_finale_farmaci != "/" or $stringa_finale_attività != "/")
    {
       if($stringa_terapia != "/")
        {
            $finale .= $stringa_terapia;
        }

        if($stringa_finale_farmaci != "/")
        {
            $finale .= $stringa_finale_farmaci;
        }
        if($stringa_finale_attività != "/")
        {
            $finale .= $stringa_finale_attività;
        }
    }
    else
    {
        $finale .= $stringa_terapia . $stringa_finale_farmaci . $stringa_finale_attività;
    }
    

    
   

  

    $user->update([
        'Terapia' => ($finale),
        'NumeroTerapia' => $user->NumeroTerapia + 1,
    ]);

    Notifiche::create([
        'ID_Ricevente' => $user->id,
        'Messaggio' => 'La tua terapia è stata aggiornata',
        'DataNotifica' => now(),
        'Aperta' => 0,
        'Orario' => now(),
    ]);

    return redirect()->route('PazienteSelezionato', ['id' => $idPaziente])
        ->with('paziente', $user)
        ->with('success', 'Terapia riabilitativa inserita con successo!');
}




}




    

