<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DEncuestas extends Model
{
    protected $fillable = [
        'titulo', 'descripcion'
    ];
}
