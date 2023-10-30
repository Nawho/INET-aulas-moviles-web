<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaFormativa extends Model
{
    use HasFactory;
    protected $table = 'oferta_formativa';
    protected $primaryKey = 'id';

    public function aulaMovilDetail()
    {
        return $this->belongsTo(AulaMovilDetails::class, 'n_aula_movil', 'n_ATM');
    }
}
