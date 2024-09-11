<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Clinico extends Model {

    protected $table = 'Clinico';
    protected $primaryKey = 'ID';
    public $timestamps = false;
}

public function Paziente (){
    return this->hasMany(Paziente::class);
}

public funciton getAllDottori(){
    return $this->all();
}
