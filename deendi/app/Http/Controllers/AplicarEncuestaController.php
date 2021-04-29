<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\CollectionstdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App;
use App\DEncuestas;
use App\DDatosPreguntaAbiertas;
use App\DDatosPreguntaMultiple;
use App\DDatosPreguntaEscala;
use App\DDatosPreguntaArchivo;
use App\DResultadoPreguntaAbierta;
use App\DResultadoPreguntaMultiple;
use App\DResultadoPreguntaEscala;
use App\DDatosPreguntaTabla;
use App\DResultadoPreguntaTabla;
use App\DResultadoPreguntaArchivo;
use App\DEstiloEncuesta;


class AplicarEncuestaController extends Controller
{
    //
    public function index($id)
    {
    	$encuesta = App\DEncuestas::where('id', decrypt($id))->get();
        $estilos_encuesta = App\DEstiloEncuesta::where('encuesta_id', decrypt($id))->get();
    	return view('encuesta.aplicar.index', compact('encuesta','estilos_encuesta'));
    }

    public function getDatosPreguntas($id_encuesta)
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

    public function store(Request $request)
    {
        $respuestas = $request->all();

        $user_id = auth()->user()->id;
        $numero_encuesta = DB::table('d_encuestas')->where([['id', $respuestas[0]['id_encuesta']], ['usuario_id', $user_id]])->first();
        $contador_encuesta_aplicado = $numero_encuesta->num_encuesta_aplicado;  //Numero

         /**Esta bloque de codigo actualiza la ancuesta diciendo que es aplicado para poder
         * ser analizado y el numero de veces que es aplicado
         */
        $aplicar_encuesta = App\DEncuestas::find($respuestas[0]['id_encuesta']);
        $aplicar_encuesta->aplicado = 'si';
        $aplicar_encuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1; //Actualiza el numero de veces que la encuesta es aplicado
        $aplicar_encuesta->save();

        $contador = count($respuestas);
        $respuestas_img_id = [];

         for ($i = 0; $i < $contador; $i++) {

            if ($respuestas[$i]['tipo_pregunta'] === 'pre_abierta') {
                    //return 'guardando res de ask open';
                    $save_res_abierta = new App\DResultadoPreguntaAbierta;
                    $save_res_abierta->encuesta_id = $respuestas[$i]['id_encuesta'];
                    $save_res_abierta->pregunta_id = $respuestas[$i]['id_pregunta'];
                    $save_res_abierta->respuesta = $respuestas[$i]['respuesta'];
                    $save_res_abierta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                    $save_res_abierta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                    $save_res_abierta->estado = 1;
                    $save_res_abierta->save();
            }
                //Validacion de pregunta simple
            if ($respuestas[$i]['tipo_pregunta'] === 'pre_opcion_simple') {

                    $save_respuesta = new App\DResultadoPreguntaMultiple;
                    $save_respuesta->encuesta_id = $respuestas[$i]['id_encuesta'];
                    $save_respuesta->pregunta_id = $respuestas[$i]['id_pregunta'];
                    $save_respuesta->respuesta_id = $respuestas[$i]['respuesta_id'];
                    $save_respuesta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                    $save_respuesta->respuesta_otra = $respuestas[$i]['respuesta_otra'];
                    $save_respuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                    $save_respuesta->estado = 1;
                    $save_respuesta->save();
            }

            if ($respuestas[$i]['tipo_pregunta'] === 'pre_opcion_multiple') {

                    for ($x=0; $x < count($respuestas[$i]['respuesta_id']) ; $x++) {
                        $save_respuesta = new App\DResultadoPreguntaMultiple;
                        $save_respuesta->encuesta_id = $respuestas[$i]['id_encuesta'];
                        $save_respuesta->pregunta_id = $respuestas[$i]['id_pregunta'];
                        $save_respuesta->respuesta_id = $respuestas[$i]['respuesta_id'][$x]['id_opcion'];
                        $save_respuesta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                        $save_respuesta->respuesta_otra = $respuestas[$i]['respuesta_otra'];
                        $save_respuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                        $save_respuesta->estado = 1;
                        $save_respuesta->save();
                    }
            }

            if ($respuestas[$i]['tipo_pregunta'] === 'pre_desplegable') {

                    $save_respuesta = new App\DResultadoPreguntaMultiple;
                    $save_respuesta->encuesta_id = $respuestas[$i]['id_encuesta'];
                    $save_respuesta->pregunta_id = $respuestas[$i]['id_pregunta'];
                    $save_respuesta->respuesta_id = $respuestas[$i]['respuesta_id'];
                    $save_respuesta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                    $save_respuesta->respuesta_otra = $respuestas[$i]['respuesta_otra'];
                    $save_respuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                    $save_respuesta->estado = 1;
                    $save_respuesta->save();
            }

            if ($respuestas[$i]['tipo_pregunta'] === 'pre_escala') {

                    $save_respuesta = new App\DResultadoPreguntaEscala;
                    $save_respuesta->encuesta_id = $respuestas[$i]['id_encuesta'];
                    $save_respuesta->pregunta_id = $respuestas[$i]['id_pregunta'];
                    $save_respuesta->respuesta = $respuestas[$i]['respuesta_id'];
                    $save_respuesta->rango = $respuestas[$i]['rango'];
                    $save_respuesta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                    $save_respuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                    $save_respuesta->estado = 1;
                    $save_respuesta->save();
            }

            if ($respuestas[$i]['tipo_pregunta'] === 'pre_tabla') {

                for ($x=0; $x < count($respuestas[$i]['respuestas']) ; $x++) {
                    $save_respuesta = new App\DResultadoPreguntaTabla;
                    $save_respuesta->encuesta_id = $respuestas[$i]['id_encuesta'];
                    $save_respuesta->pregunta_id = $respuestas[$i]['id_pregunta'];
                    $save_respuesta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                    $save_respuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                    $save_respuesta->column1 = $respuestas[$i]['respuestas'][$x]['fila'][0]['res_tabla'] ?? 'null';
                    $save_respuesta->column2 = $respuestas[$i]['respuestas'][$x]['fila'][1]['res_tabla'] ?? 'null';
                    $save_respuesta->column3 = $respuestas[$i]['respuestas'][$x]['fila'][2]['res_tabla'] ?? 'null';
                    $save_respuesta->column4 = $respuestas[$i]['respuestas'][$x]['fila'][3]['res_tabla'] ?? 'null';
                    $save_respuesta->column5 = $respuestas[$i]['respuestas'][$x]['fila'][4]['res_tabla'] ?? 'null';
                    $save_respuesta->column6 = $respuestas[$i]['respuestas'][$x]['fila'][5]['res_tabla'] ?? 'null';
                    $save_respuesta->column7 = $respuestas[$i]['respuestas'][$x]['fila'][6]['res_tabla'] ?? 'null';
                    $save_respuesta->column8 = $respuestas[$i]['respuestas'][$x]['fila'][7]['res_tabla'] ?? 'null';
                    $save_respuesta->column9 = $respuestas[$i]['respuestas'][$x]['fila'][8]['res_tabla'] ?? 'null';
                    $save_respuesta->column10 = $respuestas[$i]['respuestas'][$x]['fila'][9]['res_tabla'] ?? 'null';
                    $save_respuesta->column11 = $respuestas[$i]['respuestas'][$x]['fila'][10]['res_tabla'] ?? 'null';
                    $save_respuesta->column12 = $respuestas[$i]['respuestas'][$x]['fila'][11]['res_tabla'] ?? 'null';
                    $save_respuesta->num_columns = $respuestas[$i]['numero_columnas'];
                    $save_respuesta->estado = 1;
                    $save_respuesta->save();
                }
            }

            if($respuestas[$i]['tipo_pregunta'] === 'pre_archivo'){

                $save_respuesta = new App\DResultadoPreguntaArchivo;
                $save_respuesta->encuesta_id = $respuestas[$i]['id_encuesta'];
                $save_respuesta->pregunta_id = $respuestas[$i]['id_pregunta'];
                $save_respuesta->imagen = "null";
                $save_respuesta->nombre_img = 'null';
                $save_respuesta->img = "null";
                $save_respuesta->tipo_pregunta = $respuestas[$i]['tipo_pregunta'];
                $save_respuesta->num_encuesta_aplicado = $contador_encuesta_aplicado + 1;
                $save_respuesta->estado = 1;
                $save_respuesta->save();


                    $id_respuesta_img = DB::table('d_resultado_pregunta_archivos')
                                    ->where([
                                            ['encuesta_id', $respuestas[$i]['id_encuesta'] ],
                                            ['pregunta_id', $respuestas[$i]['id_pregunta'] ],
                                            ['num_encuesta_aplicado', $contador_encuesta_aplicado + 1]
                                            ])->first();

                    //return $id_respuesta->id;
                    $id_res_img = array(
                        'respuesta_img_id' => $id_respuesta_img->id,
                        'num_pregunta' => $i,
                        'num_encuesta_aplicado' => $contador_encuesta_aplicado + 1
                    );

                    array_push($respuestas_img_id, $id_res_img);   //Genera un arreglo de ids de las respuestas de imagen
            }

            else {

            }
        }

        if (count($respuestas_img_id) > 0) {

            return $respuestas_img_id;

        }else {
            return 'success';
        }
    }

    public function guardarImages(Request $request){

        $num_preguntas_images = $request->num_preguntas_img;

        for ($i=0; $i <  $num_preguntas_images; $i++) {

            if ($request->file('file'. $i)) {
                $num_de_pregunta = $request->$i;//Obtenemos el numero de la pregunta en la encuesta
                $num_id = 100 + $num_de_pregunta; //variable que genera un numero para obtener el id de la respuesta
                $id_respuesta_img = $request->$num_id; //Obtenemos el id de la respuesta
                //return $request->input("id".$num_de_pregunta);

               //$path = $request->file('file'.$request->$i)->store('galeria');
               $path = Storage::disk('deendi')->put('galeria', $request->file('file'. $i));
               $name = $request->file('file'. $i)->getClientOriginalName(); //Obtenemos el nombre de la imagen

               $guardarURLImage = App\DResultadoPreguntaArchivo::find($request['id_respuesta_img'. $i]);
               $guardarURLImage->imagen = asset($path);
               $guardarURLImage->nombre_img = $name;
               $guardarURLImage->img = $path;
               $guardarURLImage->save();

            }else{
                return "No hay archivos";
            }
        }
        return "success";

    }
}
