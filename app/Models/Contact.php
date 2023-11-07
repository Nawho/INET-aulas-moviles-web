<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacto';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'n_aula_movil';

    public function aulaMovilDetail()
    {
        return $this->belongsTo(AulaMovilDetails::class, 'n_aula_movil', 'n_atm');
    }
}
