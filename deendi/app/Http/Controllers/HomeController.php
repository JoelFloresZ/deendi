<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\DEncuestas;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $encuestas_user = App\DEncuestas::where('usuario_id', $id_user)->orderBy('id', 'desc')->paginate(30);
        return view('home', compact('encuestas_user'));  
    }

    public function perfil(){
        $id_user = auth()->user()->id;
        $perfil = App\User::where('id', $id_user)->get();
        return view('auth.perfil.perfil', compact('perfil'));
    }

    public function actualizarUser(Request $request, $id='')
    {
        
        $user = App\User::find($id);

        $user->name = $request->name;
        $user->apellido_pat = $request->paterno;
        $user->apellido_mat = $request->materno;

        if($user->save()){
            return back()->with('mensaje','Datos actualizados correctamente!!');//mensaje
        }else {
            return back()->with('erro','Hubo un error al actualizar los datos');//mensaje
        }
    }
}
