<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DContactos extends Model
{
    //use Notifiable;
    protected $fillable = [
        'nombre','ap_pat', 'ap_mat', 'correo', 'invitar'
    ];
}
