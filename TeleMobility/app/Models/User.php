<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens,
        HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //aggiornati in un colpo solo con il metodo fill che ci consente di prendere dei
        //dati da una form e creare un'istanza direttamente dal contenuto del nostro form
        'name',
        'surname',
        'email',
        'username',
        'password',
        'Telefono',
        'Genere',
        'Descrizione',
        'Specializzazione',
        'Immagine',
        'Terapia',
        'NumeroTerapia',
        'ID_Clinico_Del_Paziente',
        'Indirizzo',
        'DataDiNascita',
        'Ruolo_Clinico',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ //impedisce che il contenuto di un elemento user possa essere visto in un trasferimento
        'username',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole($role): bool { //aggiungiamo un metodo che serve per verificare
        $role = (array) $role;
         return in_array($this->role, $role);//ritorna true se il ruolo dell'utente loggato se è uno dei ruoli che esistono
        //senno false se non esiste quel ruolo indicato
        //andremo a vedere di che tipo di ruolo sia associato
    }
}
