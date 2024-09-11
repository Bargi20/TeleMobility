<?php

use App\Http\Controllers\ClinicoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DiagnosiController;
use App\Models\Resources\Clinico;
use App\Http\Controllers\MessaggiController;
use App\Http\Controllers\NotificheController;




require __DIR__.'/auth.php';

Route::get('/verifica-notifiche', [NotificheController::class, 'verificaNotifiche'])->name('verificaNotifiche');

Route::get('/Notifiche', [NotificheController::class, 'getNotifiche'])
        ->name('NotifichePaziente');


//Liv 0
Route::get('/ListaDottori/Dottore/{numero}', [PublicController::class, 'showDottori'])
        ->name('singolo_dottore');

Route::view('/', 'home')
        ->name('home');

Route::get('/ListaDottori',[PublicController::class,'showAllDottori'])
        ->name('Listadottori');

Route::get('/Faq',[PublicController::class,'showFaq'])
        ->name('Faq');


Route::post('/update-password', [PasswordController::class, 'update'])
        ->name('password.update');

Route::post('/update-messaggio/{id}', [MessaggiController::class, 'set'])->name('segna_letto');
Route::post('/delete-messaggio/{id}', [MessaggiController::class, 'delete'])->name('elimina_mex');



//Liv 1

Route::get('/Paziente', [UserController::class, 'index'])
        ->name('Paziente')->middleware('can:isPaziente');

Route::get('/Paziente/Inserisci_Evento', [DiagnosiController::class, 'create'])
        ->name('diagnosi.create')->middleware('can:isPaziente');

Route::post('/Paziente/Inserisci_Evento', [DiagnosiController::class, 'store'])
        ->name('diagnosi.store')->middleware('can:isPaziente');

Route::get('/Paziente/GestisciAccount', [PazienteController::class,'getGestisciAccount'])
        ->name('Gestisci_Account')->middleware('can:isPaziente');

Route::post('Paziente/GestisciAccount',[PazienteController::class,'Salva_Dati'])
        ->name('Dati_salvatiPaziente')->middleware('can:isPaziente');

Route::get('Paziente/GestisciAccount/ModificaDati',[PazienteController::class,'Modifica_Dati'])
        ->name('Modifica_Dati')->middleware('can:isPaziente');

Route::post('Paziente/GestisciAccount/ModificaDati',[PazienteController::class,'Modifica_Dati'])
        ->name('Modifica_Dati')->middleware('can:isPaziente');


Route::get('/Paziente/Cartella', [PazienteController::class, 'viewCartella'])
        ->name ('cartellaPaziente')->middleware('can:isPaziente');

Route::get('/Paziente/Cartella/Terapia',[PazienteController::class, 'viewTerapy'])
        ->name('terapiaPaziente')->middleware('can:isPaziente');

Route::get('Paziente/GestisciAccount/EliminaEvento', [PazienteController::class, 'eliminaEvento'])
        ->name('EliminaEvento')->middleware('can:isPaziente');

Route::delete('/evento-disturbo/{id}', [PazienteController::class, 'delete'])->name('evento-disturbo.delete');


Route::get('Paziente/GestisciAccount/ModificaPassword',[PazienteController::class,'Modifica_Password'])
        ->name('Modifica_Password_Paziente')->middleware('can:isPaziente');


Route::get('Paziente/messaggi',[MessaggiController::class, 'gethome_messaggi'])
        ->name('home_messaggi_paziente')->middleware('can:isPaziente');

Route::post('InserisciMessaggio',[MessaggiController::class, 'store'])
        ->name('messaggi_store')->middleware('can:isPaziente');



Route::get('Paziente/messaggi/nuovo_messaggio',[MessaggiController::class, 'nuovo_mex'])
        ->name('nuovo_messaggio_paziente')->middleware('can:isPaziente');

Route::get('Paziente/messaggi/visualizza/{tipo}',[MessaggiController::class, 'visualizza_mex'])
        ->name('visualizza_messaggi_paziente')->middleware('can:isPaziente');

Route::post('InserisciMessaggioPaziente',[MessaggiController::class, 'store'])
        ->name('messaggi_store_paziente')
        ->middleware('can:isPaziente');

Route::get('Paziente/messaggi/nuovo_messaggio_di_risposta/{risposta}',[MessaggiController::class, 'nuovo_mex_risposta'])
        ->name('risposta_paziente')->middleware('can:isPaziente');

Route::post('InserisciMessaggio_di_risposta_paziente/{risposta}',[MessaggiController::class, 'store_risposta'])
        ->name('messaggi_store_risposta_paziente')->middleware('can:isPaziente'); 

Route::get('DescrizioneDisturbo/{id}',[DiagnosiController::class,'getDisturbo'])->name('Descrizione_disturbo');





//Liv 2
Route::get('/Clinico',[UserController::class,'index_clinico'])
        ->name('Clinico')->middleware('can:isClinico');

Route::get('Dottore/ModificaPassword',[ClinicoController::class,'Modifica_Password'])
        ->name('Modifica_Password_Clinico')->middleware('can:isClinico');
 
 Route::get('Dottore/Registrazione',[ClinicoController::class, 'registraPaziente'])
         ->name('registra_paziente')->middleware('can:isClinico');

Route::post('/Inserisci-Paziente', [ClinicoController::class, 'store'])
         ->name('paziente.store')->middleware('can:isClinico'); 

Route::get('Dottore/Ricerca-Paziente', [ClinicoController::class, 'ricerca'])
         ->name('ricerca_paziente')->middleware('can:isClinico');

//Rotta Ajax per filtrare i pazienti 
Route::get('/search-pazienti', [ClinicoController::class, 'search'])
->name('search-pazienti');


Route::get('Dottore/Ricerca-Paziente/Paziente_selezionato/{id}', [ClinicoController::class, 'paziente_selezionato'])
         ->name('PazienteSelezionato')->middleware('can:isClinico');

        
Route::get('Dottore/Aggiungi-Disturbo/{idPaziente}',[DiagnosiController::class, 'getDisturbiNonAssegnati'])
         ->name('aggiungi_disturbo')->middleware('can:isClinico');
 
Route::post('Dottore/storeDisturboPaziente/{idPaziente}', [DiagnosiController::class,'storeNewDiagnosi'])
         ->name('disturbo.storeClinico')->middleware('can:isClinico');

Route::get('Dottore/Rimuovi-Disturbo/{idPaziente}',[DiagnosiController::class, 'getDisturbiAssegnati'])
         ->name('rimuovi_disturbo')->middleware('can:isClinico');
 
Route::post('Dottore/deleteDisturbo/{idPaziente}', [DiagnosiController::class,'rimuovidisturbo'])
         ->name('disturbo.deletePaziente')->middleware('can:isClinico');
  

Route::get('Dottore/ModificaTerapia/{idPaziente}',[DiagnosiController::class, 'ModificaTerapia'])
        ->name('ModificaTerapia')->middleware('can:isClinico');


Route::post('update-terapia/{idPaziente}', [DiagnosiController::class, 'updateterapia'])
        ->name('modificaterapia')->middleware('can:isClinico');
        

Route::get('Dottore/messaggi',[ClinicoController::class, 'gethome_messaggi'])
        ->name('home_messaggi')->middleware('can:isClinico');

Route::post('InserisciMessaggio',[MessaggiController::class, 'store'])
        ->name('messaggi_store') ->middleware(['can:isClinico']);
        
Route::get('Dottore/messaggi/nuovo_messaggio',[MessaggiController::class, 'nuovo_mex'])
        ->name('nuovo_messaggio')->middleware('can:isClinico');

Route::get('Dottore/messaggi/visualizza/{tipo}',[MessaggiController::class, 'visualizza_mex'])
        ->name('visualizza_messaggi')->middleware('can:isClinico');

Route::get('Dottore/messaggi/nuovo_messaggio_di_risposta/{risposta}',[MessaggiController::class, 'nuovo_mex_risposta'])
        ->name('risposta_dottore')->middleware('can:isClinico');

Route::post('InserisciMessaggio_di_risposta/{risposta}',[MessaggiController::class, 'store_risposta'])
        ->name('messaggi_store_risposta')->middleware('can:isClinico'); 

//Elimina Evento Per il dottore relativo al proprio paziente 
Route::get('Clinico/PazienteSel/VisualizzaEvento/{ID}', [ClinicoController::class, 'eliminaEventoClinico'])
        ->name('EliminaEventoClinico')->middleware('can:isClinico');

Route::delete('/evento-disturboPaziente/{id}', [ClinicoController::class, 'deleteEvento'])
        ->name('evento-disturbo.deleteClinico');


Route::get('Paziente/messaggi/visualizza_con_filtro/paziente/{p}',[MessaggiController::class, 'visualizza_mex_inviati_filtrata'])
        ->name('visualizza_messaggi_filtrata')->middleware('can:isClinico');    

Route::get('Paziente/messaggi/visualizza_con_filtro_messaggi_ricevuti_non_letti/paziente/{p}',[MessaggiController::class, 'visualizza_mex_non_letti_filtrata'])
->name('visualizza_messaggi_non_letti_filtrata')->middleware('can:isClinico');  

Route::get('Paziente/messaggi/visualizza_con_filtro_messaggi_ricevuti_letti/paziente/{p}',[MessaggiController::class, 'visualizza_mex_letti_filtrata'])
->name('visualizza_messaggi_letti_filtrata')->middleware('can:isClinico');  

Route::get('/filtraEventi/{ID_Paziente}', [ClinicoController::class, 'filtraEventi'])
->name('filtraEventi')
->middleware('can:isClinico');






//Liv 3
Route::get('/Amministratore', [UserController::class, 'index_admin'])
        ->name('Amministratore')->middleware('can:isAdmin');

Route::get('/Amministratore/GestioneClinico',[PublicController::class, 'getGestioneClinico'])
        ->name('GestioneClinico')->middleware('can:isAdmin');


Route::get('/Amministratore/InserisciClinico', [AdminController::class, 'registraClinico'])
        ->name('InserisciClinico')->middleware('can:isAdmin');

Route::post('/Amministratore/InserisciClinico', [AdminController::class, 'storeClinico'])
        ->name('clinico.store')->middleware('can:isAdmin'); 

//recupera le faq e ritorna la view  di tutte le faq pubblicate
Route::get('Amministratore/Faq', [AdminController::class, 'getFaq'])
        ->name('FaqAdmin')->middleware('can:isAdmin');

//elimina la FAQ selezionata dal DB e ritorna alla pagina delle FAQ
Route::delete('Amministratore/FaqDelete/{Faqid}', [AdminController::class, 'destroyFaq'])
        ->name('faq.destroy')->middleware('can:isAdmin');

//prende l'ID della FAQ selezionata e riporta sulla pagina di Modifca FAQ
Route::get('Amministratore/FaqEdit/{Faqid}', [AdminController::class, 'editFaq'])
        ->name('faq.edit')->middleware('can:isAdmin');

//chiama la f updateFaq, salva la FAQ nel DB e ritorna alla home page delle FAQ
//la differenza tra post e put è che put, oltre a poter inserire le cose del DB
//le può pure modificare
Route::put('Amministratore/FaqUpdate/{Faqid}', [AdminController::class, 'updateFaq'])
        ->name('faq.update')->middleware('can:isAdmin');

//ritorna la view per Aggiungere una FAQ
Route::get('Amministratore/FaqStorePage',[AdminController::class, 'getStoreFaqPage'])
        ->name('FaqStorePage')->middleware('can:isAdmin');

//con store FAQ si salva nel DB e si ritorna poi alla home page delle FAQ
Route::post('Amministratore/FaqStore', [AdminController::class,'storeFaq'])
        ->name('faq.store')->middleware('can:isAdmin');

Route::get('Amministratore/ClinicoSel/{numero}', [AdminController::class, 'restituisciClinico'])
        ->name('ClinicoSel') -> middleware('can:isAdmin');

Route::get('Clinico/Dottore/ModificaPassword/{id}', [AdminController::class,'Modifica_Password'])
        ->name('Modifica_Password_Clinico_admin')->middleware('can:isAdmin');
    

Route::post('/update-password/{id}', [PasswordController::class, 'update_admin_clinico_password'])
        ->name('password.update_admin')->middleware('can:isAdmin');

Route::post('/delete-paziente/{id}', [AdminController::class, 'delete__paziente'])
        ->name('delete_paziente')->middleware('can:isAdmin');


Route::post('/delete-clinico/{id}', [AdminController::class, 'delete__clinico'])
        ->name('delete_clinico')->middleware('can:isAdmin');

Route::get('Clinico/ModificaDati/{id}', [AdminController::class,'Modifica_Dati'])
        ->name('Modifica_Admin_Clinico_admin')->middleware('can:isAdmin');

Route::post('Clinico/Dati_salvati/{id}',[AdminController::class,'Salva_Dati'])
        ->name('Dati_salvati')->middleware('can:isAdmin');


//------------------------DISTURBI ADMIN--------------------------//

Route::get('Admin/Disturbi', [AdminController::class,'getDisturbi'])
        ->name('DisturbiAdmin')->middleware('can:isAdmin');

Route::delete('Admin/DistubroDelete/{IdDisturbo}', [AdminController::class,'deleteDisturbo'])
        ->name('disturbo.destroy')->middleware('can:isAdmin');

Route::get('Admin/ModificaDisturbo{IdDisturbo}', [AdminController::class, 'editDisturbo'])
        ->name('disturbo.edit')->middleware('can:isAdmin');

Route::put('Admin/DisturboUpdate/{IdDisturbo}', [AdminController::class, 'updateDisturbo'])
        ->name('disturbo.update')->middleware('can:isAdmin');

Route::get('Admin/StoreDisturboPage', [AdminController::class, 'getStoreDisturboPage'])
        ->name('DisturbiStorePage')->middleware('can:isAdmin');

Route::post('Admin/StoreDisturbo', [AdminController::class,'storeDisturbo'])
        ->name('disturbo.store')->middleware('can:isAdmin');



        //------------------------Analisi Dati Admin--------------------------//

Route::get('Admin/Statistiche/', [AdminController::class, 'showSatistiche'])
        ->name('StatisticheAdmin')->middleware('can:isAdmin');

Route::get('/Admin/Statistiche/search', [AdminController::class, 'ricercaPaziente'])
        ->name('paziente.search')->middleware('can:isAdmin');

Route::get('/Admin/Statistiche/terapia/{id}', [AdminController::class, 'getTerapia'])
        ->name('terapia.get')->middleware('can:isAdmin');

        


//-----------------------------------CRUD FARMACI--------------------------------------//
Route::get('Admin/Farmaci', [AdminController::class, 'showFarmaci'])
        ->name ('FarmaciAdmin')->middleware('can:isAdmin');

Route::delete('Admin/FarmacoDelete/{IDFarmaco}', [AdminController::class,'deleteFarmaco'])
        ->name('farmaco.destroy')->middleware('can:isAdmin');

Route::get('Admin/ModificaFarmaco{IDFarmaco}', [AdminController::class, 'editFarmaco'])
        ->name('farmaco.edit')->middleware('can:isAdmin');


Route::put('Admin/FarmacoUpdate/{IDFarmmaco}', [AdminController::class, 'updateFarmaco'])
        ->name('farmaco.update')->middleware('can:isAdmin');

Route::get('Admin/StoreFarmacoPage', [AdminController::class, 'getStoreFarmacoPage'])
        ->name('FarmaciStorePage')->middleware('can:isAdmin');

Route::post('Admin/StoreFarmaco', [AdminController::class,'storeFarmaco'])
        ->name('farmaco.store')->middleware('can:isAdmin');







//-----------------------------------CRUD ATTIVITA'--------------------------------------//

      Route::get('Admin/Attività', [AdminController::class, 'showAttività'])
      ->name('AttivitaAdmin')->middleware('can:isAdmin');


      Route::post('Admin/DeleteAttivita/{IDAttivita}', [AdminController::class, 'deleteAttività'])
      ->name('attività.destroy')->middleware('can:isAdmin');


Route::get('Admin/ModificaAttività/{IDAttivita}', [AdminController::class, 'editAttività'])
      ->name('attività.edit')->middleware('can:isAdmin');


Route::put('Admin/AttivitàUpdate/{IDAttivita}', [AdminController::class, 'updateAttività'])
      ->name('attività.update')->middleware('can:isAdmin');

Route::get('Admin/AttivitàStorePage', [AdminController::class, 'getStoreAttivitàPage'])
      ->name('AttivitàStorePage')->middleware('can:isAdmin');

Route::post('Admin/StoreAttività', [AdminController::class,'storeAttività'])
      ->name('attività.store')->middleware('can:isAdmin');





Route::get('/search-Clinici', [AdminController::class, 'search_clinico'])
      ->name('search-clinico');