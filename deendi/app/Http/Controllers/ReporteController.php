<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\CollectionstdClass;
use Illuminate\Support\Facades\DB;
use App;
use App\DEncuestas;
use App\DPreguntas;
use App\DResultadoPreguntaAbierta;
use App\DResultadoPreguntaMultiple;
use App\DDatosPreguntaEscala;
use App\DResultadoPreguntaEscala;
use App\DResultadoPreguntaArchivo;
use Illuminate\Support\Facades\Storage;

class ReporteController extends Controller
{
    public function index($id_encuesta = 0)
    {
    	$id = decrypt($id_encuesta);

    	return view('resultados.reporte', compact('id'));
    }

    public function getDatosReporte($id_encuesta='')
    {
         try {

            $datos = [];
            $encuesta = App\DEncuestas::where('id', $id_encuesta)->first();
            
            
            $resultados = [];
            for ($i=1; $i <= 1 ; $i++) { 
                $preguntas = [];
                    /*Consulta de preguntas*/
                    $query_preguntas = App\DPreguntas::where('encuesta_id', $encuesta->id)->get();

                    foreach ($query_preguntas as $pregunta) {
                        /*
                        Datos de las preguntas
                         */
                           $preguntaResultados = [];


                            if( $pregunta->tipo_pregunta === 'pre_abierta'){

                                $preguntaResultados = App\DResultadoPreguntaAbierta::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            else if( $pregunta->tipo_pregunta === 'pre_opcion_simple' || 'pre_opcion_multiple'){

                                $opciones_pregunta = App\DDatosPreguntaMultiple::where('pregunta_id', $pregunta->id)->get();
                                $opciones = [];

                                    foreach ($opciones_pregunta as $key) {
                                       
                                        $resultado_opcion_pregunta =  App\DResultadoPreguntaMultiple::where('pregunta_id', $pregunta->id)
                                        ->where('respuesta_id',  $key->id)->get();
                                        //Condicion que asigna si la opcion es seleccionado
                                        
                                        
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'opcion' => $key->opcion,
                                            'tipo_opcion' => $key->tipo_opcion,
                                            'opcion_otra' => $key->opcion_otra,
                                            'respondido' => $resultado_opcion_pregunta
                                        );
                                        array_push($opciones, $dato_opciones);
                                    }

                                $preguntaResultados = $opciones;

                                
                            }

                            if( $pregunta->tipo_pregunta === 'pre_desplegable'){

                                $opciones_pregunta = App\DDatosPreguntaMultiple::where('pregunta_id', $pregunta->id)->get();
                                $opciones = [];

                                    foreach ($opciones_pregunta as $key) {
                                        
                                        $resultado_opcion_pregunta =  App\DResultadoPreguntaMultiple::where('pregunta_id', $pregunta->id)
                                        ->where('respuesta_id',  $key->id)->get();
                                        //Condicion que asigna si la opcion es seleccionado
                                                                               
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'opcion' => $key->opcion,
                                            'tipo_opcion' => $key->tipo_opcion,
                                            'opcion_otra' => $key->opcion_otra,
                                            'respondido' => $resultado_opcion_pregunta,
                                            'num_encuesta_aplicado' => $i
                                        );
                                        array_push($opciones, $dato_opciones);
                                    }

                                $preguntaResultados = $opciones;

                                
                            }

                           else if( $pregunta->tipo_pregunta === 'pre_escala'){

                                $opciones_pregunta_escala = App\DDatosPreguntaEscala::where('pregunta_id', $pregunta->id)->get();
                                $opciones_escala = [];

                                    foreach ($opciones_pregunta_escala as $key) {
                                        
                                        $resultado_opcion_pregunta =  App\DResultadoPreguntaEscala::where('pregunta_id', $pregunta->id)
                                        ->where('respuesta',  $key->id)->get();                                       
                                        
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'rango' => $key->rango,
                                            'valor' => $key->valor,
                                            'respondido' => $resultado_opcion_pregunta,
                                            'num_encuesta_aplicado' => $i
                                        );
                                        array_push($opciones_escala, $dato_opciones);
                                    }

                                $preguntaResultados = $opciones_escala;

                                
                            }

                            else if( $pregunta->tipo_pregunta === 'pre_tabla'){

                                $opciones_pregunta_tabla = App\DDatosPreguntaTabla::where('pregunta_id', $pregunta->id)->get();
                                $opciones_tabla = [];

                                    foreach ($opciones_pregunta_tabla as $key) {
                                        
                                        $resultado_tabla =  App\DResultadoPreguntaTabla::where('pregunta_id', $pregunta->id)
                                        ->get();
                                       
                                        
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'numero_columnas' => $key->numero_columnas,
                                            'column1' => $key->column1,
                                            'column2' => $key->column2,
                                            'column3' => $key->column3,
                                            'column4' => $key->column4,
                                            'column5' => $key->column5,
                                            'column6' => $key->column6,
                                            'column7' => $key->column7,
                                            'column8' => $key->column8,
                                            'column9' => $key->column9,
                                            'column10' => $key->column10,
                                            'num_encuesta_aplicado' => $i,
                                            'resultado_tabla' => $resultado_tabla
                                        );
                                        array_push($opciones_tabla, $dato_opciones);
                                    }

                                $preguntaResultados = $opciones_tabla;

                                
                            }

                            else if($pregunta->tipo_pregunta === 'pre_archivo'){
                                 $resultado_archivos =  App\DResultadoPreguntaArchivo::where('pregunta_id', $pregunta->id)->get();


                                $preguntaResultados = $resultado_archivos;
                            }


                        $datos_pregunta = array(
                            'id' => $pregunta->id,
                            'pregunta' => $pregunta->pregunta,
                            'tipo_pregunta' => $pregunta->tipo_pregunta,
                            'tipo_respuesta' => $pregunta->tipo_respuesta,
                            'resultado' =>  $preguntaResultados
                        );

                        array_push($preguntas, $datos_pregunta);
                    }

                //Guarda las veces que se aplico una encuesta
                array_push($resultados, $preguntas);    
                   
            }

                $datos_encuesta = array(
                    'id' => $encuesta->id,
                    'titulo' => $encuesta->titulo,
                    'descripcion' => $encuesta->descripcion,
                    'usuario_id' => $encuesta->usuario_id,
                    'resultados' => $resultados,
                    'num_encuesta_aplicado' => $encuesta->num_encuesta_aplicado
                );

                array_push($datos, $datos_encuesta);
                
            return $datos;

          } catch (Exception $e) {
              
          }  

    }
}
