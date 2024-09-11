<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {

    protected $table = 'FAQ';
    protected $primaryKey = 'Id_Faq';
    public $timestamps = false;

    public function get_All()
    {
        return $this->all();
    }

}
