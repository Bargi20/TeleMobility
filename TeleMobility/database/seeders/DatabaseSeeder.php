<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run(): void {



        //User - Utenti
        DB::table('users')->insert([

            //Utenti per il prof 
            
            [
                'name' => 'Andrea',
                'surname' => 'Bargilli',
                'email' => 'andreabargilli@gmail.com',
                'username' => 'pazipazi',
                'password' => Hash::make('0Jmt0Jmt'),
                'role' => 'Paziente',
                'DataDiNascita' => '2002-02-20',
                'Genere' => 'M',
                'Telefono' => '3342828653',
                'Indirizzo' => 'via alessandro orsi 15',
                'Terapia' => null,
                'NumeroTerapia' => null,
                'ID_Clinico_Del_Paziente' => 2,
                'Descrizione' => null,
                'Specializzazione' => null,
                'Immagine' => 'not_found_M.jpeg',
                'Ruolo_Clinico' => null,

            ],
            [
                'name' => 'Giacomo',
                'surname' => 'Bianco',
                'email' => 'antonio_b@gmail.com',
                'username' => 'clinclin',
                'password' => Hash::make('0Jmt0Jmt'),
                'role' => 'Clinico',
                'DataDiNascita' => '2002-03-26',
                'Genere' => 'M',
                'Telefono' => '3342828653',
                'Indirizzo' => 'via alessandro orsi 15',
                'Terapia' => null,
                'NumeroTerapia' => null,
                'ID_Clinico_Del_Paziente' => null,
                'Descrizione' => 'Sono un neurologo con oltre 15 anni di esperienza nella diagnosi e trattamento dei disturbi del sistema nervoso, specializzato in malattie neurodegenerative come il morbo di Parkinson e la sclerosi multipla. Ho conseguito la laurea in Medicina e Chirurgia presso l Università di Milano e ho completato la mia specializzazione in Neurologia presso l Ospedale San Raffaele. La mia missione è fornire cure di alta qualità, basate sulle ultime ricerche scientifiche, e migliorare la qualità della vita dei miei pazienti attraverso un approccio empatico e personalizzato.',
                'Specializzazione' => 'Neurologia',
                'Immagine' => 'not_found_M.jpeg',
                'Ruolo_Clinico' => 'Medico',

            ],
            [
                'name' => 'Mario',
                'surname' => 'Rossi',
                'email' => 'admin@gmail.com',
                'username' => 'adminadmin',
                'password' => Hash::make('0Jmt0Jmt'),
                'role' => 'Admin',
                'DataDiNascita' => '2002-03-26',
                'Genere' => 'M',
                'Telefono' => '3342828653',
                'Indirizzo' => null,
                'Terapia' => null,
                'NumeroTerapia' => null,
                'ID_Clinico_Del_Paziente' => null,
                'Descrizione' => null,
                'Specializzazione' => null,
                'Immagine' => null,
                'Ruolo_Clinico' => null,

            ],
        ]);



       
    }
}
