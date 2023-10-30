<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AulaMovilDetails extends Model
{
    use HasFactory;
    protected $table = 'aula_movil_details';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'n_ATM';

    public function contact()
    {
        return $this->hasOne(Contact::class, 'n_aula_movil', 'n_ATM');
    }

    public function ofertaFormativas()
    {
        return $this->hasMany(OfertaFormativa::class, 'n_aula_movil', 'n_ATM');
    }

    public function ubicaciones()
    {

        return $this->hasMany(UbicacionAulaPorFecha::class, 'n_aula_movil', 'n_ATM');
    }
}
