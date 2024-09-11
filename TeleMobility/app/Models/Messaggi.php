<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messaggi extends Model
{    protected $table = 'Messaggi';

    protected $primaryKey = 'id';

    public $timestamps = false;
    use HasFactory;
}

