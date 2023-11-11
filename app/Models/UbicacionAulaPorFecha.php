<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AulaMovilListOverview;
use App\Models\AulaMovilMapOverview;

class UbicacionAulaPorFecha extends Model
{
    use HasFactory;
    protected $table = 'ubicacion_aula_x_fecha';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function aulaMovilDetail()
    {
        return $this->belongsTo(AulaMovilDetails::class, 'n_aula_movil', 'n_atm');
    }

    public function aulaMovilListOverview()
    {
        return $this->belongsTo(AulaMovilListOverview::class, 'n_aula_movil', 'n_atm');
    }

    public function aulaMovilMapOverview()
    {
        return $this->belongsTo(AulaMovilMapOverview::class, 'n_aula_movil', 'n_atm');
    }
}