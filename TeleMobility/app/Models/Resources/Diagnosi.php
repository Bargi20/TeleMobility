<?php

namespace App\Models\Resources;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Diagnosi extends Model {

    protected $table = 'Diagnosi';

    protected $primaryKey = 'ID_Paziente';

    public $timestamps = false;


    public function disturbo()
    {
        return $this->belongsTo(Disturbo::class, 'ID_Disturbo', 'Id_Disturbo');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Paziente', 'id');
    }

}
