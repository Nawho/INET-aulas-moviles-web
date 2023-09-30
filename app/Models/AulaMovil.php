<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AulaMovil extends Model
{
    use HasFactory;

    protected $table = 'aulas_moviles';
    protected $primaryKey = 'n_CUE';

    // Define the fillable columns
    protected $fillable = [
        'jurisdiccion',
        'n_ATM',
        'n_CUE',
        'n_chasis',
        'dominio',
        'especialidad_formativa',
    ];
}