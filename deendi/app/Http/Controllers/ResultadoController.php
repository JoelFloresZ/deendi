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

class ResultadoController extends Controller
{
    //
    public function show()
    {
    	$id_user = auth()->user()->id;
        $ver = '';    	
        $encuestas_aplicadas = App\DEncuestas::where('usuario_id', $id_user)->where('num_encuesta_aplicado', '>=', 1)->where('usuario_id', $id_user)->orderBy('id', 'desc')->paginate(30);
    		
        
    	return view('resultados.index', compact('encuestas_aplicadas'));
    }


    public function buscarEncuestaAplicado(Request $request)
    {
        $id_user = auth()->user()->id;
        $ver = '';
        
        $ver = 'Resultado';

        $encuestas_aplicadas =  App\DEncuestas::where('num_encuesta_aplicado', '>=', 1)
                                ->where('usuario_id', $id_user)
                                ->where('titulo', 'LIKE' , "%$request->buscar%")->paginate(30);
           

        return view('resultados.index', compact('encuestas_aplicadas', 'ver'));

    }


    public function limpiarDatosEncuesta($id= 0)
    {
        $datos_archvivos = App\DResultadoPreguntaArchivo::all()->where('encuesta_id', $id);

        if(count($datos_archvivos) > 0){
           for ($i=0; $i < count($datos_archvivos) ; $i++) { 
              $imagen = $datos_archvivos[$i]->img;
             
              Storage::disk('deendi')->delete($imagen);
           }
        }
        
    	DB::table('d_resultado_pregunta_abiertas')->where('encuesta_id', $id)->truncate();
        DB::table('d_resultado_pregunta_multiples')->where('encuesta_id', $id)->truncate();
        DB::table('d_resultado_pregunta_escalas')->where('encuesta_id', $id)->truncate();
       /* DB::table('resultado_pregunta_likerts')->where('encuesta_id', $id)->truncate();*/
        DB::table('d_resultado_pregunta_archivos')->where('encuesta_id', $id)->truncate();
        DB::table('d_resultado_pregunta_tablas')->where('encuesta_id', $id)->truncate();
        //resultado_pregunta_images

        $encuesta = App\DEncuestas::findOrfail($id);
        $encuesta->aplicado = 'no';
        $encuesta->num_encuesta_aplicado = 0;
        $encuesta->save();

        return redirect()->route('resultados');
    }

    public function verResultado($id_encuesta='')
    {
        $id = decrypt($id_encuesta);
        return view('resultados.analisis', compact('id'));
    }

    public function verResultadoResume($id_encuesta='')
    {
         $id = decrypt($id_encuesta);
        return view('resultados.resumen', compact('id'));
    }

    public function getDatosPreguntasAnalisis($id_encuesta)
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
                           $preguntaResultados = [];

                            if( $pregunta->tipo_pregunta === 'pre_abierta'){

                                $preguntaResultados = App\DDatosPreguntaAbiertas::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            elseif( $pregunta->tipo_pregunta === 'pre_opcion_simple' || 'pre_opcion_multiple' || 'pre_desplegable'){

                                $preguntaResultados = App\DDatosPreguntaMultiple::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            elseif( $pregunta->tipo_pregunta === 'pre_escala'){

                                 $preguntaResultados = App\DDatosPreguntaEscala::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            elseif( $pregunta->tipo_pregunta === 'pre_archivo'){

                                 $preguntaResultados = App\DDatosPreguntaArchivo::where('pregunta_id', $pregunta->id)->get();
                                
                            }

                            elseif( $pregunta->tipo_pregunta === 'pre_tabla'){

                                 $preguntaResultados = App\DDatosPreguntaTabla::where('pregunta_id', $pregunta->id)->get();
                                
                            }else{
                                $preguntaResultados = 'NO';
                            }


                        $datos_pregunta = array(
                            'id' => $pregunta->id,
                            'pregunta' => $pregunta->pregunta,
                            'tipo_pregunta' => $pregunta->tipo_pregunta,
                            'tipo_respuesta' => $pregunta->tipo_respuesta,
                            'resultados' =>  $preguntaResultados
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

    public function getDatosPreguntasResultados($id_encuesta)
    {
        try {

            $datos = [];
            $encuesta = App\DEncuestas::where('id', $id_encuesta)->first();
            
            
            $resultados = [];
            for ($i=1; $i <= $encuesta->num_encuesta_aplicado ; $i++) { 
                $preguntas = [];
                    /*Consulta de preguntas*/
                    $query_preguntas = App\DPreguntas::where('encuesta_id', $encuesta->id)->get();

                    foreach ($query_preguntas as $pregunta) {
                        /*
                        Datos de las preguntas
                         */
                           $preguntaResultados = [];


                            if( $pregunta->tipo_pregunta === 'pre_abierta'){

                                $preguntaResultados = App\DResultadoPreguntaAbierta::where('pregunta_id', $pregunta->id)->where('num_encuesta_aplicado', $i)->get();
                                
                            }

                            else if( $pregunta->tipo_pregunta === 'pre_opcion_simple' || 'pre_opcion_multiple'){

                                $opciones_pregunta = App\DDatosPreguntaMultiple::where('pregunta_id', $pregunta->id)->get();
                                $opciones = [];

                                    foreach ($opciones_pregunta as $key) {
                                        $activar_opcion = 'disabled'; //variable que verifica si la opcion es seleccionado
                                        $resultado_opcion_pregunta =  App\DResultadoPreguntaMultiple::where('pregunta_id', $pregunta->id)
                                        ->where('respuesta_id',  $key->id)->where('num_encuesta_aplicado', $i)->get();
                                        //Condicion que asigna si la opcion es seleccionado
                                        if(count( $resultado_opcion_pregunta) > 0){
                                            $activar_opcion = 'activo';
                                        }
                                        
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'opcion' => $key->opcion,
                                            'tipo_opcion' => $key->tipo_opcion,
                                            'opcion_otra' => $key->opcion_otra,
                                            'respondido' => $activar_opcion
                                        );
                                        array_push($opciones, $dato_opciones);
                                    }

                                $preguntaResultados = $opciones;

                                
                            }

                            if( $pregunta->tipo_pregunta === 'pre_desplegable'){

                                $opciones_pregunta = App\DDatosPreguntaMultiple::where('pregunta_id', $pregunta->id)->get();
                                $opciones = [];

                                    foreach ($opciones_pregunta as $key) {
                                        $activar_opcion = 'disabled'; //variable que verifica si la opcion es seleccionado
                                        $resultado_opcion_pregunta =  App\DResultadoPreguntaMultiple::where('pregunta_id', $pregunta->id)
                                        ->where('respuesta_id',  $key->id)->where('num_encuesta_aplicado', $i)->get();
                                        //Condicion que asigna si la opcion es seleccionado
                                        if(count( $resultado_opcion_pregunta) > 0){
                                            $activar_opcion = 'activo';
                                        }
                                        
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'opcion' => $key->opcion,
                                            'tipo_opcion' => $key->tipo_opcion,
                                            'opcion_otra' => $key->opcion_otra,
                                            'respondido' => $activar_opcion,
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
                                        $activar_opcion = 'disabled'; //variable que verifica si la opcion es seleccionado
                                        $resultado_opcion_pregunta =  App\DResultadoPreguntaEscala::where('pregunta_id', $pregunta->id)
                                        ->where('respuesta',  $key->id)->where('num_encuesta_aplicado', $i)->get();
                                        //Condicion que asigna si la opcion es seleccionado
                                        if(count( $resultado_opcion_pregunta) > 0){
                                            $activar_opcion = 'activo';
                                        }
                                        
                                        $dato_opciones = array(
                                            'id' => $key->id,
                                            'rango' => $key->rango,
                                            'valor' => $key->valor,
                                            'respondido' => $activar_opcion,
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
                                        ->where('num_encuesta_aplicado', $i)->get();
                                       
                                        
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

                            if($pregunta->tipo_pregunta === 'pre_archivo'){
                                $resultado_archivos =  App\DResultadoPreguntaArchivo::where('pregunta_id', $pregunta->id)
                                        ->where('num_encuesta_aplicado', $i)->get();


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

    public function getDatosPreguntasResultadosResumen($id_encuesta='')
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
