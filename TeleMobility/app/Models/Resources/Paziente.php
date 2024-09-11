<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Paziente extends Model {

    protected $table = 'Paziente';
    protected $primaryKey = 'ID_Paziente';
    public $timestamps = false;

}
public function Clinico (){
    return this->belongsTo(Clinico::class);
}
