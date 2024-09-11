<?php

namespace App\Models; //riprende la cartella di dove sta

use Illuminate\Database\Eloquent\Model;
use Brick\Math\BigInteger;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Resources\Faq;
use App\Models\Resources\Clinico;
use App\Models\Resources\Paziente;
use App\Models\Resources\Diagnosi;
use App\Models\Messaggi;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Resources\Disturbo;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Crypt;

class Catalog extends Model {
    //valore che definisce la descrizione estesa del prodotto


public function getfaq() : Collection {
    $faq = new Faq();
    return $faq->all();

}

public function getDottori(int $Numero): Collection {

$bigInteger = BigInteger::of($Numero);

// Ora $bigInteger conterrà il valore come un oggetto BigInteger

        return User::where('id', $bigInteger)->get();
    }

public function getAllDottori(): LengthAwarePaginator {

    $Dottori = User::where('role', 'Clinico')->paginate(5);
    return $Dottori;

}

public function getUtenteBy_Id(int $ID): User {
    $bigIntegerID = BigInteger::of($ID);
            return User::where('id', $bigIntegerID)->first();
        }

public function getListaDiagnosiBy_Id(BigInteger $ID): Collection { // prende ID paziente nella tabella diaognisi

    $Lista_Disturbi = Diagnosi:: where('ID_Paziente',$ID)
    ->where('Stato', 1)
    ->get();

return $Lista_Disturbi;
}


public function getDisturboBy_Id(int $ID): Disturbo { //prende id del disturbo dalla tabella delle diagnosi dello stesso paziente

    $bigIntegerID = BigInteger::of($ID);

    return Disturbo::where('Id_Disturbo', $bigIntegerID)->first();

}

public function Avvia_Eventi_Per_Diagnosi(BigInteger $ID): Collection {

    $Lista_Diagnosi = $this->getListaDiagnosiBy_Id($ID);
    $Lista_disturbi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($Lista_Diagnosi as $diagnosi) {

        // Avvia la funzione Start_Inserisci_Evento per ogni diagnosi e raccogli i risultati nella collezione
        $ID_Int = intval($diagnosi->ID_Disturbo);
        $singolo_disturbo = $this->getDisturboBy_Id($ID_Int);
        $Lista_disturbi->push($singolo_disturbo);


    }
    return $Lista_disturbi;
}

public function getPazienti_perClinico( $ID): Collection{
    

    $Lista_pazienti = User::where('ID_Clinico_Del_Paziente', $ID)->get();


    return $Lista_pazienti;
}
   
public function get_Pazienti_perClinico_lista($ID): Collection {
    

    $elenco = User::where('ID_Clinico_Del_Paziente', $ID)->get();
    $Lista_pazienti = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $paziente) {

        
        
        $Lista_pazienti->push($paziente);

    }
    return $Lista_pazienti;


}

public function get_messaggi_by_id_destinatario($ID): Collection {
    

    $elenco = Messaggi::where('id_destinatario', $ID)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 0;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}
public function get_messaggi_non_letti_by_id_destinatario($ID): Collection {
    

    $elenco = Messaggi::where('id_destinatario', $ID)
    ->where('aperto', 0)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 0;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}
public function get_messaggi_letti_by_id_destinatario($ID): Collection {
    

    $elenco = Messaggi::where('id_destinatario', $ID)
    ->where('aperto', 1)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 1;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}
public function get_messaggi_by_id_mittente($ID): Collection {
    

    $elenco = Messaggi::where('id_mittente', $ID)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 0;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}

public function get_messaggi_filtrati_by_id_mittente($ID,$Paziente): Collection {
    

    $elenco = Messaggi::where('id_mittente', $ID)->where('id_destinatario',$Paziente)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 0;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}
public function get_messaggi_filtrati_non_letti_by_id_destinatario($ID,$Paziente): Collection {
    
    $elenco = Messaggi::where('id_mittente', $Paziente)->where('id_destinatario',$ID)->where('aperto',0)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 0;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}

public function get_messaggi_filtrati_letti_by_id_destinatario($ID,$Paziente): Collection {
    
    $elenco = Messaggi::where('id_mittente', $Paziente)->where('id_destinatario',$ID)->where('aperto',1)
    ->orderBy('orario', 'desc')
    ->get();
    $Lista_messaggi = $this->newCollection();  // Inizializza una nuova collezione per raccogliere gli eventi

    foreach ($elenco as $mex) {

        $messaggio_chiaro = new Messaggi;
        $messaggio_chiaro->id = $mex->id;
        $messaggio_chiaro->id_risposta = $mex->id_risposta; 
        $messaggio_chiaro->id_destinatario = $mex->id_destinatario;
        $messaggio_chiaro->id_mittente = $mex->id_mittente;
        $messaggio_chiaro->corpo = Crypt::decryptString($mex->corpo);
        $messaggio_chiaro->contenuto =  Crypt::decryptString($mex->contenuto);;
        $messaggio_chiaro->aperto = 0;
        $messaggio_chiaro->orario = $mex->orario;
        $Lista_messaggi->push($messaggio_chiaro);

    }
    return $Lista_messaggi;

}

public function get_paziente_by_id_messaggio($ID) 
{
    

    $elenco = Messaggi::where('id', $ID)->first();
    $a = $elenco->id_mittente;
    return $a;
  

}
public function get_messaggi_precedenti_by_id_destinatario_da_messaggi_non_letti($ID): Collection {
    
    $messaggi_lista = $this->get_messaggi_non_letti_by_id_destinatario($ID);
    $Lista_messaggi_prec = $this->newCollection();

    foreach ($messaggi_lista as $mex) {

        
        if($mex->id_risposta != null)
        {   
            
            $messaggio_prec = Messaggi::where('id',$mex->id_risposta )->first();
            $messaggio_prec_effettivo = new Messaggi;

            $messaggio_prec_effettivo->id = $messaggio_prec->id;
            $messaggio_prec_effettivo->id_risposta = $messaggio_prec->id_risposta; 
            $messaggio_prec_effettivo->id_destinatario = $messaggio_prec->id_destinatario;
            $messaggio_prec_effettivo->id_mittente = $messaggio_prec->id_mittente;
            $messaggio_prec_effettivo->corpo = Crypt::decryptString($messaggio_prec->corpo);
            $messaggio_prec_effettivo->contenuto =  Crypt::decryptString($messaggio_prec->contenuto);;
            $messaggio_prec_effettivo->aperto = 0;
            $messaggio_prec_effettivo->orario = $messaggio_prec->orario;
            
    

            $Lista_messaggi_prec->push($messaggio_prec_effettivo);
        }
        

        
    }
    return $Lista_messaggi_prec;

}
public function get_messaggi_precedenti_by_id_destinatario_da_messaggi_letti($ID): Collection {
    
    $messaggi_lista = $this->get_messaggi_letti_by_id_destinatario($ID);
    $Lista_messaggi_prec = $this->newCollection();

    foreach ($messaggi_lista as $mex) {

        
        if($mex->id_risposta != null)
        {   
            
            $messaggio_prec = Messaggi::where('id',$mex->id_risposta )->first();
            $messaggio_prec_effettivo = new Messaggi;

            $messaggio_prec_effettivo->id = $messaggio_prec->id;
            $messaggio_prec_effettivo->id_risposta = $messaggio_prec->id_risposta; 
            $messaggio_prec_effettivo->id_destinatario = $messaggio_prec->id_destinatario;
            $messaggio_prec_effettivo->id_mittente = $messaggio_prec->id_mittente;
            $messaggio_prec_effettivo->corpo = Crypt::decryptString($messaggio_prec->corpo);
            $messaggio_prec_effettivo->contenuto =  Crypt::decryptString($messaggio_prec->contenuto);;
            $messaggio_prec_effettivo->aperto = 0;
            $messaggio_prec_effettivo->orario = $messaggio_prec->orario;
            
    

            $Lista_messaggi_prec->push($messaggio_prec_effettivo);
        }
        

        
    }
    return $Lista_messaggi_prec;

}
public function get_messaggi_a_cui_ho_risposto($ID): Collection {
    
    $messaggi_destinatario = $this->get_messaggi_by_id_destinatario($ID);
    $messaggi_mittente = $this->get_messaggi_by_id_mittente($ID);
    $Lista_messaggi_a_cui_ho_risposto = $this->newCollection();


    foreach ($messaggi_mittente as $mex_mittente)
    {
        if($mex_mittente->id_risposta != null)
        {
            foreach ($messaggi_destinatario as $mex_destinatario) 
            if($mex_destinatario->id == $mex_mittente->id_risposta)
            {   
            
                $messaggio_prec = Messaggi::where('id',$mex_mittente->id_risposta )->first();
                $messaggio_prec_effettivo = new Messaggi;
    
                $messaggio_prec_effettivo->id = $messaggio_prec->id;
                $messaggio_prec_effettivo->id_risposta = $messaggio_prec->id_risposta; 
                $messaggio_prec_effettivo->id_destinatario = $messaggio_prec->id_destinatario;
                $messaggio_prec_effettivo->id_mittente = $messaggio_prec->id_mittente;
                $messaggio_prec_effettivo->corpo = Crypt::decryptString($messaggio_prec->corpo);
                $messaggio_prec_effettivo->contenuto =  Crypt::decryptString($messaggio_prec->contenuto);;
                $messaggio_prec_effettivo->aperto = 0;
                $messaggio_prec_effettivo->orario = $messaggio_prec->orario;
                
        
    
                $Lista_messaggi_a_cui_ho_risposto->push($messaggio_prec_effettivo);
            }
            
        }
    } 

return $Lista_messaggi_a_cui_ho_risposto;

}

public function get_pazienti_a_cui_ho_inviato_messaggi($ID): Collection {
    $messaggi_mittente = $this->get_messaggi_by_id_mittente($ID);
    $Lista_pazienti = $this->newCollection();
    $pazienti_inseriti = []; // Array temporaneo per tracciare gli ID dei pazienti già inseriti

    foreach ($messaggi_mittente as $mex_mittente) {
        $paziente_id = $mex_mittente->id_destinatario;

        // Verifica se l'ID del paziente è già stato inserito
        if (!in_array($paziente_id, $pazienti_inseriti)) {
            $paziente = $this->getUtenteBy_Id($paziente_id);
            $Lista_pazienti->push($paziente);
            
            // Aggiungi l'ID del paziente all'array dei pazienti inseriti
            $pazienti_inseriti[] = $paziente_id;
        }
    }

    return $Lista_pazienti;
}
public function get_pazienti_che_mi_hanno_inviato_un_messaggio_non_letto($ID): Collection {

    $messaggi_mittente = $this->get_messaggi_non_letti_by_id_destinatario($ID);
    $Lista_pazienti = $this->newCollection();
    $pazienti_inseriti = []; // Array temporaneo per tracciare gli ID dei pazienti già inseriti

    foreach ($messaggi_mittente as $mex_mittente) {
        $paziente_id = $mex_mittente->id_mittente;

        // Verifica se l'ID del paziente è già stato inserito
        if (!in_array($paziente_id, $pazienti_inseriti)) {
            $paziente = $this->getUtenteBy_Id($paziente_id);
            $Lista_pazienti->push($paziente);
            
            // Aggiungi l'ID del paziente all'array dei pazienti inseriti
            $pazienti_inseriti[] = $paziente_id;
           
        }
    }

   
    return $Lista_pazienti;
}

public function get_pazienti_che_mi_hanno_inviato_un_messaggio_letto($ID): Collection {

    $messaggi_mittente = $this->get_messaggi_letti_by_id_destinatario($ID);
    $Lista_pazienti = $this->newCollection();
    $pazienti_inseriti = []; // Array temporaneo per tracciare gli ID dei pazienti già inseriti

    foreach ($messaggi_mittente as $mex_mittente) {
        $paziente_id = $mex_mittente->id_mittente;

        // Verifica se l'ID del paziente è già stato inserito
        if (!in_array($paziente_id, $pazienti_inseriti)) {
            $paziente = $this->getUtenteBy_Id($paziente_id);
            $Lista_pazienti->push($paziente);
            
            // Aggiungi l'ID del paziente all'array dei pazienti inseriti
            $pazienti_inseriti[] = $paziente_id;
           
        }
    }

   
    return $Lista_pazienti;
}

}

