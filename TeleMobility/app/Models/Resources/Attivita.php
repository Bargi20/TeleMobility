<?php

namespace App\Models\Resources;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attivita extends Model
{
    protected $table = 'Attività_Riabilitative';

    protected $primaryKey = 'Id_Attività_Riabilitative';

    public $timestamps = false;


}