<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UbicacionAulaPorFecha;

class AulaMovilListOverview extends Model
{
    use HasFactory;
    protected $table = 'aula_movil_list_overview';
    protected $primaryKey = 'n_ATM';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function ubicaciones()
    {
        return $this->hasMany(UbicacionAulaPorFecha::class, 'n_aula_movil', 'n_ATM');
    }
}

