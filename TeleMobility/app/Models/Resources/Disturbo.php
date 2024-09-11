<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Disturbo extends Model {

    protected $table = 'Disturbo';

    protected $primaryKey = 'Id_Disturbo';

    public $timestamps = false;

    public function diagnosi()
    {
        return $this->hasMany(Diagnosi::class, 'ID_Disturbo', 'Id_Disturbo');
    }
    
}
