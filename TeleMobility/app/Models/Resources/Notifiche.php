<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Notifiche extends Model
    {
        protected $table = 'Notifiche';
        protected $fillable = ['ID_Ricevente', 'Messaggio', 'DataNotifica', 'Aperta','Orario'];
        public $timestamps = false;

        public function user()
        {
            return $this->belongsTo(User::class, 'ID_Paziente');
        }
}
    

