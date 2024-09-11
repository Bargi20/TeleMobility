<?php
namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Evento_Disturbo extends Model
{
    protected $table = 'Evento_Disturbo';

    // Dato che la chiave primaria è composta, Laravel non può incrementarla automaticamente
    public $incrementing = false;

    // Specifica che la chiave primaria è composta
    protected $primaryKey = ['ID_Paziente','Data_Evento', 'Durata', 'Intensità','Orario'];

    public $timestamps = false;

    protected $fillable = ['ID_Disturbo', 'ID_Paziente', 'Data_Evento', 'Durata', 'Intensità','Orario'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Metodo per gestire correttamente la chiave primaria composta
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        return $this->original[$keyName] ?? $this->getAttribute($keyName);
    }

    public function getDisturboBy_Id(int $ID): Disturbo { //prende id del disturbo dalla tabella delle diagnosi dello stesso paziente

       // $bigIntegerID = BigInteger::of($ID);
    
        return Disturbo::where('Id_Disturbo', $ID)->first();
    
    }
}

