<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\CollectionstdClass;
use App;
use App\DEncuestasCompartida;
use App\DEncuestasEnviadasEmail;
use App\DEncuestasRecibidas;
use App\Mail\EncuestasCorreoElectronico;
use Illuminate\Support\Facades\Mail;



class CompartirController extends Controller
{
    public function index($id_encuesta)
    {
        $id = decrypt($id_encuesta);
        $id_user = auth()->user()->id; //id del usuario
        $grupos = App\DGrupo::where('user_id', $id_user)->orderBy('id', 'desc')->get();
    	return view('encuesta.compartir.index', compact('id','grupos'));
    }

    public function getGrupos($id= 0)
    {
        $id = auth()->user()->id; //id del usuario
        $grupos = App\DGrupo::where('user_id', $id)->orderBy('id', 'desc')->get();
        return $grupos;
    }

    public function enviarUsuario(Request $request)
    {
    	//return $request->all();

    	$usuario_email = DB::table('users')->where('email', $request->correo)->value('email');

    	if ($usuario_email === $request->correo) {


    		$encuestaRecibido = App\DEncuestasCompartida::where('destinatario', $request->correo)->where('encuesta_id', $request->encuesta_id)->get();

    		if (count($encuestaRecibido) == 0) {
    			$compartir = new App\DEncuestasCompartida;
		    	$compartir->destinatario = $usuario_email;
		    	$compartir->asunto = $request->mensaje;
		    	$compartir->encuesta_id = $request->encuesta_id;
		    	$compartir->id_remitente = auth()->user()->id;
		    	$compartir->estado = 1;

		    	if ($compartir->save()) {

                    $compartir = new App\DEncuestasRecibidas;
                    $compartir->destinatario = $usuario_email;
                    $compartir->asunto = $request->mensaje;
                    $compartir->encuesta_id = $request->encuesta_id;
                    $compartir->id_remitente = auth()->user()->id;
                    $compartir->estado = 1;
                    $compartir->save();

		    		return back()->with('mensaje','Encuesta compartida exitosamente');//mensaje
		    	}else {
		    		return back()->with('error','Fallo al enviar la encuesta');//mensaje
		    	}
    		}else {
    			return back()->with('error','No se envio la encuesta, por que ya se le habia enviado una vez al usuario antes');//mensaje
    		}
    	}else {
    		return back()->with('error','El usuario no existe');//mensaje
    	}
    }

    public function campartirEncuestaGrupo(Request $request) {

        $grupos = App\DGruposDeContato::where('grupo_id', $request->grupo)->orderBy('id', 'desc')->get();
        $contactos_a_enviar_encuesta = [];
        $contactos_no_registrados = [];
        $contatos_recibido_encuesta = [];

            foreach ($grupos as $grupo) {
                $contacto = App\DContactos::where('id', $grupo->contacto_id)->orderBy('id', 'desc')->get();

                $usuario_email = DB::table('users')->where('email', $contacto[0]->email)->value('email');

                if ( $usuario_email != '') {
                    $encuestaRecibido = App\DEncuestasCompartida::where('destinatario',$usuario_email)
                                        ->where('encuesta_id', $request->encuesta_id)->get();
                    if (count($encuestaRecibido) > 0) {
                        array_push($contatos_recibido_encuesta, $contacto[0]->email);
                    }else {
                        array_push($contactos_a_enviar_encuesta, $contacto[0]->email);
                    }

                }else {
                    array_push($contactos_no_registrados, $contacto[0]->email);
                }

            }

        if (count($contactos_no_registrados) > 0) {
            return back()
            ->with('warning', 'No se pudo compartir la encuesta ya que el grupo contiene usuarios que no estan registrados en la plataforma');
        }else {
            for ($i=0; $i < count($contactos_a_enviar_encuesta) ; $i++) {
                $compartir = new App\DEncuestasCompartida;
                $compartir->destinatario =$contactos_a_enviar_encuesta[$i];
                $compartir->asunto = $request->mensaje;
                $compartir->encuesta_id = $request->encuesta_id;
                $compartir->id_remitente = auth()->user()->id;
                $compartir->estado = 1;
                $compartir->save();


                $compartir = new App\DEncuestasRecibidas;
                $compartir->destinatario =$contactos_a_enviar_encuesta[$i];
                $compartir->asunto = $request->mensaje;
                $compartir->encuesta_id = $request->encuesta_id;
                $compartir->id_remitente = auth()->user()->id;
                $compartir->estado = 1;
                $compartir->save();
            }

            return back()->with('mensaje','Encuesta compartida exitosamente');//mensaje

        }
    }

    public function EnviarEncuestaCorreoGrupo(Request $request)
    {

        $grupos = App\DGruposDeContato::where('grupo_id', $request->grupo)->orderBy('id', 'desc')->get();

        foreach ($grupos as $grupo) {
            $contacto = App\DContactos::where('id', $grupo->contacto_id)->orderBy('id', 'desc')->get();
            $encuesta = App\DEncuestas::where('id', $request->encuesta_id)->first();
            $data = array(
                    'id' => $contacto[0]->id,
                    'name' => $contacto[0]->name,
                    'email' => $contacto[0]->email,
                    'correo_remitente' => $id_user = auth()->user()->email,
                    'id_encuesta' => $request->encuesta_id,
                    'asunto' => $request->mensaje,
                    'encuesta' => $encuesta->titulo
            );

            $compartir = new App\DEncuestasEnviadasEmail;
            $compartir->destinatario = $contacto[0]->email;
            $compartir->asunto = $request->mensaje;
            $compartir->encuesta_id = $request->encuesta_id;
            $compartir->id_remitente = auth()->user()->id;
            $compartir->estado = 1;

            if ($compartir->save()) {
                Mail::to($contacto[0]->email)->queue(new  EncuestasCorreoElectronico($data));
            }else {
                 return back()->with('error','No se pudo compartir la encuesta al grupo');//mensaje
            }

        }

        return back()->with('mensaje','Encuesta compartida exitosamente');//mensaje
    }

    public function EnviarEncuestaCorreo(Request $request)
    {

        $contacto = App\DContactos::where('email', $request->correo)->orderBy('id', 'desc')->get();
        $encuesta = App\DEncuestas::where('id', $request->encuesta_id)->first();
        $data = array(
                'id' => $contacto[0]->id,
                'name' => $contacto[0]->name,
                'email' => $contacto[0]->email,
                'correo_remitente' => $id_user = auth()->user()->email,
                'id_encuesta' => $request->encuesta_id,
                'asunto' => $request->mensaje,
                'encuesta' => $encuesta->titulo
        );

        $compartir = new App\DEncuestasEnviadasEmail;
        $compartir->destinatario = $contacto[0]->email;
        $compartir->asunto = $request->mensaje;
        $compartir->encuesta_id = $request->encuesta_id;
        $compartir->id_remitente = auth()->user()->id;
        $compartir->estado = 1;

        if ($compartir->save()) {
            Mail::to($contacto[0]->email)->queue(new  EncuestasCorreoElectronico($data));
            return back()->with('mensaje','Encuesta compartida exitosamente');//mensaje
        }else {
             return back()->with('error','No se pudo compartir la encuesta al grupo');//mensaje
        }
    }

    public function enviarEncuesta(Request $request)
    {

        switch ($request->tipo_de_envio) {
            case 'correo':
                if ($request->usuario === "usuario") {

                   return $this->EnviarEncuestaCorreo($request); //enviar encuesta a un usuario

                }if($request->usuario === "grupo"){

                    return $this->EnviarEncuestaCorreoGrupo($request); // enviar encuesta a un grupo
                }
                break;

            case 'plataforma':
                if ($request->usuario === "usuario") {

                   return $this->enviarUsuario($request); //enviar encuesta a un usuario

                }if($request->usuario === "grupo"){

                    return $this->campartirEncuestaGrupo($request); // enviar encuesta a un grupo
                }
                break;

            default:
                    return back()->with('error','Hubo un error al tratar de enviar la encuesta');//mensaje
                break;
        }
    }


}
