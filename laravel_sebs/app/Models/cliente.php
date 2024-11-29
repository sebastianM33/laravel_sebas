<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class cliente extends Model
{

    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'correo',
        'telefono'
    ];

}
