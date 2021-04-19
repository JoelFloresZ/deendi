<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\DContactos;
use App\DGrupo;
use App\DGruposDeContato;

class AgendaController extends Controller
{
    //
    public function showContactos()
    {
    	try {
            $id = auth()->user()->id; //id del usuario
            $contactos = App\DContactos::where('user_id', $id)->orderBy('id', 'desc')->get();
            return view('agenda.index', compact('contactos'));

        } catch (\Throwable $th) {
            return redirect()->route('404');
        }
    }

    public function showGrupos()
    {
       try {
            $id = auth()->user()->id; //id del usuario
            $grupos = App\DGrupo::where('user_id', $id)->orderBy('id', 'desc')->get();
            $contactos = App\DContactos::where('user_id', $id)->orderBy('id', 'desc')->get();
            
            return view('agenda.grupos', compact('grupos', 'contactos'));
       } catch (\Throwable $th) {
            return redirect()->route('404');
       }
    }

    public function registrarContacto(Request $request)
    {
    	 $id = auth()->user()->id; //id del usuario

    	 $messages = [
            'nombre.required' => 'El :attribute del contacto es obligatorio.',
            'ap_pat.unique' => 'El apellido paterno del contacto es obligatorio.',
            'ap_mat.required' => 'El apellido materno del contacto es obligatorio.',
            'correo.required' => 'Ya existe un usuario con el mismo correo electronico.',
        ];

    	 $validatedData = $request->validate([
                'nombre' => 'required|max:100',
                'ap_pat' => 'required|max:100',
                'ap_mat' => 'required|max:100',
                'correo' => 'required|email|unique:d_contactos,email,NULL,id,user_id,'.$id.'|max:255',
            ]);
        
        try {
                        
            $contactoNueva = new App\DContactos;//Se obtienen todos los campos de la tabla
            $contactoNueva->name = $request->nombre;
            $contactoNueva->ap_pat = $request->ap_pat;
            $contactoNueva->ap_mat = $request->ap_mat;
            $contactoNueva->email = $request->correo;
            $contactoNueva->user_id = $id;
            
            if($contactoNueva->save()){
               
                if($request->invitar){
                    /*$email_id = DB::table('contactos')->where([['user_id', $id],['email',  $request->correo]])->get();
                    $contacto_id = $email_id[0]->id;
                                        
                    $fromUser =  User::find($id); 
                    $toUser = Contacto::find($contacto_id);
                    
                    // send notification using the "user" model, when the user receives new message
                    $toUser->notify(new NewMessage($fromUser));
                    
                    // send notification using the "Notification" facade
                    Notification::send($toUser, new NewMessage($fromUser));*/
                }

                return back()->with('mensaje','Contacto registrado correctamente!!');//mensaje
                
            }else{
                return back()->with('error','Fallo el registro!!');//mensaje
            }
                        
        } catch (\Throwable $th) {
            return back()->with('error','Hubo un error al registrar el contacto');//mensaje
        }
    }


    public function eliminarContacto($id='')
    {
    	$pregunta = App\DContactos::find($id);

        if($pregunta->delete()){
           return back()->with('mensaje','Contacto eliminado');//mensaje
        }else{
            return back()->with('error','Fallo al eliminar el contacto');//mensaje
        }
    }

    public function BuscarContacto(Request $request)
    {
    	
    	$contactos = App\DContactos::where('name', 'LIKE' , "%$request->buscar%")->get();
        $ver = 'Resultado';
 		return view('agenda.index', compact('contactos', 'ver'));
    }

    public function getDatosContacto(Request $request)
    {
    	
    	return App\DContactos::where('id', $request->id)->get();
       
    }

    public function editarContacto(Request $request)
    {
    	
    	$contacto = App\DContactos::find($request->id_contacto);
    	$contacto->name = $request->nombre;
        $contacto->ap_pat = $request->ap_pat;
        $contacto->ap_mat = $request->ap_mat;
        $contacto->email = $request->correo;

        if($contacto->save()){
           return back()->with('mensaje','Contacto actualizado');//mensaje
        }else{
            return back()->with('error','Fallo al actualizar los datos del contacto');//mensaje
        }
       
    }

    public function registrarGrupo(Request $request)
    {

        $id = auth()->user()->id; //id del usuario
         
       $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya tiene registrado un grupo con el nombre: '.$request->nombre.' en su lista de grupos.',
            
        ];
        $validatedData = $request->validate([
            'nombre' => 'required|unique:d_grupos,nombre,NULL,id,user_id,'.$id.'|max:255',
        ],$messages);

        if ($request->contactos ?? 0 != 0) {
            $grupo = new App\DGrupo;
            $grupo->nombre = $request->nombre;
            $grupo->user_id = $id;
            
            if ($grupo->save()) {
                $dato_grupo = App\DGrupo::where('nombre', $request->nombre)->first();
                        //return $dato_grupo->id;
                    
                    for ($i=0; $i < count($request->contactos) ; $i++) { 
                        $nuevoGrupo = new App\DGruposDeContato; //Se obtienen todos los campos de la tabla
                        $nuevoGrupo->user_id = $id;
                        $nuevoGrupo->contacto_id = $request->contactos[$i];
                        $nuevoGrupo->grupo_id = $dato_grupo->id;
                        $nuevoGrupo->save();
                    }
                        
                        
                return back()->with('mensaje','Grupo creado');//mensaje
            } 
        }else {
            return back()->with('error','No se pudo crear el grupo ya que necesita al menos un integrante para generar un grupo de trabajo');//mensaje
        }
                
    }

    public function eliminarGrupo($id='')
    {
        $pregunta = App\DGrupo::find($id);
        if($pregunta->delete()){
            return back()->with('mensaje','Grupo eliminado');//mensaje
            //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);
        }else{
            return back()->with('mensaje','Grupo creado');//mensaje
        }
    }

     public function BuscarGrupo(Request $request)
    {
        $id = auth()->user()->id; //id del usuario
        $grupos = App\DGrupo::where('nombre', 'LIKE' , "%$request->buscar%")->get();
        $contactos = App\DContactos::where('user_id', $id)->orderBy('id', 'desc')->get();
        $ver = 'Resultado';
        return view('agenda.grupos', compact('grupos', 'contactos', 'ver'));
    }

    public function getDatosGrupo(Request $request)
    {
        
        $grupo = App\DGrupo::where('id', $request->id)->get();
        $datos_grupo = [];

        foreach ($grupo as $key) {
            $contactos = [];
            $lista_contactos = App\DContactos::where('user_id', $key->user_id)->get();

                foreach ($lista_contactos as $lista) {
                    $GruposCreado = App\DGruposDeContato::where('contacto_id', $lista->id)->where('grupo_id', $key->id)->get();

                    if (count($GruposCreado) > 0) {
                        $list = array(
                            'id' => $lista->id,
                            'name' => $lista->name,
                            'ap_pat' => $lista->ap_pat,
                            'ap_mat' => $lista->ap_mat,
                            'email' => $lista->email,
                            'activo' => 'checked'
                        );

                        array_push($contactos, $list);
                    }else {
                        $list = array(
                            'id' => $lista->id,
                            'name' => $lista->name,
                            'ap_pat' => $lista->ap_pat,
                            'ap_mat' => $lista->ap_mat,
                            'email' => $lista->email,
                            'activo' => false
                        );

                        array_push($contactos, $list);
                    }
                }

            $datos = array(
                'id' => $key->id,
                'nombre' => $key->nombre,
                'user_id' => $key->user_id,
                'contactos' => $contactos
            );

            array_push($datos_grupo, $datos);
        }

        return $datos_grupo;
       
    }

    public function editarGrupo(Request $request)
    {
        
        if ($request->contactos ?? 0 != 0) {
            $edit_grupo = App\DGrupo::find($request->id_grupo);
            $edit_grupo->nombre = $request->nombre;

            if ($edit_grupo->save()) {
                
                $grupos_creados = App\DGruposDeContato::where('grupo_id', $request->id_grupo)->get();
                $id = auth()->user()->id;

                if (count($grupos_creados) > 0) {
                    if (App\DGruposDeContato::where('grupo_id', $request->id_grupo)->delete()) {
                    
                        for ($i=0; $i < count($request->contactos) ; $i++) { 
                            $nuevoGrupo = new App\DGruposDeContato; //Se obtienen todos los campos de la tabla
                            $nuevoGrupo->user_id = $id;
                            $nuevoGrupo->contacto_id = $request->contactos[$i];
                            $nuevoGrupo->grupo_id = $request->id_grupo;
                            $nuevoGrupo->save();
                        }

                        return back()->with('mensaje','Grupo actualizado');//mensaje
                    }else{
                        return back()->with('error','Fallo al actualizar el listado del grupo');//mensaje
                    }
                }else {
                    for ($i=0; $i < count($request->contactos) ; $i++) { 
                            $nuevoGrupo = new App\DGruposDeContato; //Se obtienen todos los campos de la tabla
                            $nuevoGrupo->user_id = $id;
                            $nuevoGrupo->contacto_id = $request->contactos[$i];
                            $nuevoGrupo->grupo_id = $request->id_grupo;
                            $nuevoGrupo->save();
                        }

                    return back()->with('mensaje','Grupo actualizado');//mensaje
                }

                
            }else{
                 return back()->with('error','Fallo al actualizar el grupo');//mensaje
            }
        }else {
            return back()->with('error','Fallo al actualizar los datos. Debe de seleccionar al menos un integrante');//mensaje
        }
    }
}
