<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use App\DEncuestas;
use App\DPreguntas;
use App\DEncuestasCompartida;
use App\DEncuestasEnviadasEmail;
use App\DEncuestasRecibidas;
use Illuminate\Support\Facades\Storage;

class EncuestasController extends Controller
{
    public function show(){
        $id_user = auth()->user()->id;
        $ver = '';
    	$encuestas_user = App\DEncuestas::where('usuario_id', $id_user)->orderBy('id', 'desc')->paginate(30);
 		return view('home', compact('encuestas_user', 'ver'));   	
    }

    public function listaEncuestasEnvidas(){
        $encuestas_enviadas =  App\DEncuestasCompartida::all()->where('id_remitente',auth()->user()->id);
        $encuestas_enviadas_email =  App\DEncuestasEnviadasEmail::all()->where('id_remitente',auth()->user()->id);

        $encuestas = [];
        foreach ($encuestas_enviadas as $encuesta) {
            $encuestas_user =  DB::table('d_encuestas')->where('id', $encuesta->encuesta_id)->get();
            $datos = array(
                'id' => $encuesta->id,
                'email' => $encuesta->destinatario,
                'asunto' => $encuesta->asunto,
                'encuesta_id' => $encuesta->encuesta_id,
                'id_remitente' => $encuesta->id_remitente,
                'created_at' => $encuesta->created_at,
                'encuestas' => $encuestas_user
            );

            array_push($encuestas,$datos);
        }

        $encuestas_email = [];
        foreach ($encuestas_enviadas_email as $encuesta) {
            $encuestas_user =  DB::table('d_encuestas')->where('id', $encuesta->encuesta_id)->get();
            $datos = array(
                'id' => $encuesta->id,
                'email' => $encuesta->destinatario,
                'asunto' => $encuesta->asunto,
                'encuesta_id' => $encuesta->encuesta_id,
                'id_remitente' => $encuesta->id_remitente,
                'created_at' => $encuesta->created_at,
                'encuestas' => $encuestas_user
            );

            array_push($encuestas_email,$datos);
        }


 		return view('encuesta.encuestas-enviadas',compact('encuestas', 'encuestas_email'));   	
    }

    public function eliminarEncuestaEmailEnviado($id= 0)
    {
        $email = App\DEncuestasEnvidasEmail::find($id);
        if ($email->delete()) {
           return redirect()->route('enviadas');
        }
        
    }

    public function listaEncuestasRecibidas(){
        $email = auth()->user()->email;

        $encuestas = [];
        $encuestas_recibidas =  App\DEncuestasRecibidas::all()->where('destinatario',$email);
        foreach ($encuestas_recibidas as $encuesta) {
            $encuestas_user =  DB::table('d_encuestas')->where('id', $encuesta->encuesta_id)->get();
            $datos = array(
                'id' => $encuesta->id,
                'asunto' => $encuesta->asunto,
                'encuesta_id' => $encuesta->encuesta_id,
                'id_remitente' => $encuesta->id_remitente,
                'created_at' => $encuesta->created_at,
                'encuestas' => $encuestas_user
            );

            array_push($encuestas,$datos);
        }

 		return view('encuesta.encuestas-recibidas', compact('encuestas'));   	
    }

    public function eliminarEncuestaRecibido($id= 0)
    {
        $recibido = App\DEncuestasRecibidas::find($id);
        if ($recibido->delete()) {
           return redirect()->route('recibidas');
        }
        
    }

    public function eliminarEncuestaUsuarioEnviado($id=0)
    {
        $email = App\DEncuestasCompartida::find($id);
        if ($email->delete()) {
           return redirect()->route('enviadas');
        }
    }

    public function VerEncuestasPendientes()
    {
    	$id_user = auth()->user()->id;
         $ver = 'Pendientes';
        $encuestas_user =  App\DEncuestas::where('estado_encuesta','pendiente')->where('usuario_id', $id_user)->orderBy('id', 'desc')->paginate(30);
        return view('home', compact('encuestas_user', 'ver'));
    }

    public function VerEncuestasTerminadas()
    {
    	$id_user = auth()->user()->id;
        
        $encuestas_user =  App\DEncuestas::where('estado_encuesta','terminado')->where('usuario_id', $id_user)->orderBy('id', 'desc')->paginate(30);
        $ver = 'Terminadas';
        return view('home', compact('encuestas_user', 'ver'));
    }

    public function BuscarEncuesta(Request $request)
    {
    	$id_user = auth()->user()->id;
    	$encuestas_user = App\DEncuestas::where('titulo', 'LIKE' , "%$request->buscar%")->where('usuario_id', $id_user)->paginate(30);
        $ver = 'Resultado';
 		return view('home', compact('encuestas_user', 'ver'));
    }

    public function VerFormEncuesta()
    {
    	
    	return view('encuesta.crear-encuesta');
    }

    public function CrearEncuesta(Request $request)
    {
        $id_user = auth()->user()->id;

        $messages = [
            'titulo.required' => 'El :attribute de la encuesta es obligatorio.',
            'titulo.unique' => 'Ya tiene registrado una encuesta con el :attribute: '.$request->titulo.' en su bandeja de encuestas.',
            'descripcion.required' => 'La descripción de la encuesta es obligatorio.',
        ];
        $validatedData = $request->validate([
            'titulo' => 'required|unique:d_encuestas,titulo,NULL,id,usuario_id,'.$id_user.'|max:255',
            'descripcion' => 'required',
        ],$messages);

       
        $encuestaNueva = new App\DEncuestas;//Se obtienen todos los campos de la tabla
        $encuestaNueva->titulo = $request->titulo;
        $encuestaNueva->descripcion = $request->descripcion;
        $encuestaNueva->usuario_id = $id_user;
        $encuestaNueva->estado = 1;
        
        if ($encuestaNueva->save()) {

            $encuesta_reg = App\DEncuestas::where('titulo', $request->titulo)->first();
            $datos_encuesta = $this->getDatosEncuesta($encuesta_reg->id);

            $agregar_estilos = new App\DEstiloEncuesta;
            $agregar_estilos->encuesta_id = $encuesta_reg->id;
            $agregar_estilos->url_imagen = asset('archivos/bg-estilos-deendi-13.png');
            $agregar_estilos->imgen = 'bg-estilos-deendi-13';
            $agregar_estilos->color_titulo = '#3498DB';
            $agregar_estilos->color_pregunta = 'null';
             $agregar_estilos->save();

            //return view('preguntas.index', compact('datos_encuesta'));
            return redirect()->route('editarEncuesta',['id' => encrypt($datos_encuesta[0]['id'])]);
        }else {
            return 'fallo';
        }        
       
    }

    public function getDatosEncuesta($id_encuesta)
    {
       $encuesta = App\DEncuestas::where('id', $id_encuesta)->first();
        $datos_encuesta = [];
        $array_preguntas = [];
         
        //obtenemos todos las preguntas de la encuesta
        $preguntas = DB::table('d_preguntas')->where('encuesta_id', $id_encuesta)->get();
        
            foreach ($preguntas as $key => $value) {
               $pre_datos = array(
                    'id' => $value->id,
                    'pregunta' => $value->pregunta,
                    'tipo_pregunta' => $value->tipo_pregunta

               );

               array_push($array_preguntas, $pre_datos);
            }
             
        $datos = array(
            'id' => $encuesta->id,
            'titulo' => $encuesta->titulo,
            'descripcion' => $encuesta->descripcion,
            'usuario_id' => $encuesta->usuario_id,
            'preguntas' => $array_preguntas
        );

        

        array_push($datos_encuesta, $datos);
        

        return $datos_encuesta;
    }


    public function pendienteEncuesta($id_encuesta)
    {
        try {
            $encuesta = App\DEncuestas::find($id_encuesta);

            $encuesta->estado_encuesta = 'pendiente';

            if($encuesta->save()){
                return redirect()->route('home');
            }else{
                return 'Fallo al guaradar la encuesta';
            }
        } catch (Exception $e) {
            return $this->show();
        }
    }

    public function finalizarEncuesta($id_encuesta)
    {
        try {
            $encuesta = App\DEncuestas::find($id_encuesta);

            $encuesta->estado_encuesta = 'terminado';

            if($encuesta->save()){
                return redirect()->route('home');
            }else{
                return 'Fallo al guaradar la encuesta';
            }

        } catch (Exception $e) {
            return $this->show();
        }
    }

    public function eliminarEncuesta($id= 0)
    {
        $datos_archvivos = App\DEstiloEncuesta::where('encuesta_id', $id)->get();

            if (count($datos_archvivos) > 0) {
                if ($datos_archvivos[0]->imgen != 'bg-estilos-deendi-13') {
                    Storage::disk('deendi')->delete($datos_archvivos[0]->imgen);
                }   
            }

        $pregunta = App\DEncuestas::find($id);

        if($pregunta->delete()){
            //return 'success';
            $id_user = auth()->user()->id;
            $encuestas_user = App\DEncuestas::where('usuario_id', $id_user)->orderBy('id', 'desc')->paginate(25);
            return redirect()->route('home');
            //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);
        }else{
            return 'Fallo al eliminar la pregunta';
        }
    }

    public function editarDatosEncuesta(Request $request, $id=0)
    {
        $encuesta = App\DEncuestas::find($id);
        $encuesta->titulo = $request->titulo;
        $encuesta->descripcion = $request->descripcion;
        
        if ( $encuesta->save()) {
             return redirect()->route('editarEncuesta',['id' => encrypt($id)]);
        }
        else{
            return redirect()->route('editarEncuesta',['id' => encrypt($id)]);
        }

    }

}
