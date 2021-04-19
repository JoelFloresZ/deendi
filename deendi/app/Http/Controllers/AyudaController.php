<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AyudaController extends Controller
{
    public function showAyuda() {
    	return view('ayuda.index');
    }

    public function sobreNosotros() {
    	return view('ayuda.sobre-nosotros');
    }
}
