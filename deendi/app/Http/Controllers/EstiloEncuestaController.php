<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\DEstiloEncuesta;
use Illuminate\Support\Facades\Storage;

class EstiloEncuestaController extends Controller
{
    public function cambiarFondoEncabezado(Request $request)
    {
        //return $request->imagen;
        if (is_file($request->file('imagen')))
         {
         	
        	$datos_archvivos = App\DEstiloEncuesta::where('encuesta_id', $request->id_encuesta)->get();

        	if (count($datos_archvivos) > 0) {
        		if ($datos_archvivos[0]->imgen != 'bg-estilos-deendi-13') {
        			try {
                        Storage::disk('deendi')->delete($datos_archvivos[0]->imgen);
                    } catch (\Throwable $th) {
                       return 'Error al cambiar la imagen' . $th;
                    }
        		}	
        	}

            $url = Storage::disk('deendi')->put('archivos', $request->file('imagen'));
            $imagen = $request->file('imagen')->getClientOriginalName(); //Obtenemos el nombre de la imagen
                   
            App\DEstiloEncuesta::where('encuesta_id', $request->id_encuesta)
                                        ->update(
                                            [
                                                'url_imagen' =>  asset($url) ?? 'null',
                                                'imgen' => $url ?? 'null'
                                            ]
                                        );
                                        
            return redirect()->route('editarEncuesta',['id' => encrypt($request->id_encuesta)]);

         }else {
            return back()->with('error','La imagen no es suportado');//mensaje
         }
      
    }

    public function cambiarEstilosFuente(Request $request)
    {
        /*return $request->all();*/
        App\DEstiloEncuesta::where('encuesta_id', $request->id_encuesta)
                                        ->update(
                                            [
                                                'color_titulo' =>   $request->color_titulo ?? 'null',
                                                'color_pregunta' =>  $request->color_pregunta ?? 'null'
                                            ]
                                        );
       
            return redirect()->route('editarEncuesta',['id' => encrypt($request->id_encuesta)]);      
    }

    public function mostrarEncuestaEnProceso($id='')
    {
        $encuesta = App\DEncuestas::where('id', decrypt($id))->get();
        $estilos_encuesta = App\DEstiloEncuesta::where('encuesta_id', decrypt($id))->get(); 
        return view('preguntas.index', compact('encuesta','estilos_encuesta'));
    }

    public function getDatosEncuestaDiseño($id_encuesta='')
     {
        try {

            $datos = [];
            $encuesta = App\DEncuestas::where('id', $id_encuesta)->first();
                $preguntas = [];

                    /*Consulta de preguntas*/
                    $query_preguntas = App\DPreguntas::where('encuesta_id', $encuesta->id)->get();

                    foreach ($query_preguntas as $pregunta) {
                        /*
                        Datos de las preguntas
                         */
                            $preguntaOpciones = [];

                            if( $pregunta->tipo_pregunta === 'pre_abierta'){

                                $preguntaOpciones = App\DDatosPreguntaAbiertas::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            if( $pregunta->tipo_pregunta === 'pre_opcion_simple' || 'pre_opcion_multiple' || 'pre_desplegable'){

                                $preguntaOpciones = App\DDatosPreguntaMultiple::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            if( $pregunta->tipo_pregunta === 'pre_escala'){

                                $preguntaOpciones = App\DDatosPreguntaEscala::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            if( $pregunta->tipo_pregunta === 'pre_archivo'){

                                $preguntaOpciones = App\DDatosPreguntaArchivo::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            if( $pregunta->tipo_pregunta === 'pre_tabla'){

                                $preguntaOpciones = App\DDatosPreguntaTabla::where('pregunta_id', $pregunta->id)->get();
                                
                            }


                        
                        $datos_pregunta = array(
                            'id' => $pregunta->id,
                            'pregunta' => $pregunta->pregunta,
                            'tipo_pregunta' => $pregunta->tipo_pregunta,
                            'tipo_respuesta' => $pregunta->tipo_respuesta,
                            'datos' => $preguntaOpciones
                        );

                        array_push($preguntas, $datos_pregunta);
                    }

                /*
                Guardamos los datos de la encuesta
                 */    

                $datos_encuesta = array(
                    'id' => $encuesta->id,
                    'titulo' => $encuesta->titulo,
                    'descripcion' => $encuesta->descripcion,
                    'usuario_id' => $encuesta->usuario_id,
                    'preguntas' => $preguntas
                );

                array_push($datos, $datos_encuesta);

            return $datos;

          } catch (Exception $e) {
              
          }  

    }
}
