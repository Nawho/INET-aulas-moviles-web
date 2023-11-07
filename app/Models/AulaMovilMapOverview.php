<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UbicacionAulaPorFecha;

class AulaMovilMapOverview extends Model
{
    use HasFactory;
    protected $table = 'aula_movil_map_overview';
    protected $primaryKey = 'n_atm';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function ubicaciones()
    {
        return $this->hasMany(UbicacionAulaPorFecha::class, 'n_aula_movil', 'n_atm');
    }

    public function ofertasFormativas()
    {
        return $this->hasMany(OfertaFormativa::class, 'n_aula_movil', 'n_atm');
    }
}

