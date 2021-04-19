<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\CollectionstdClass;
use Illuminate\Support\Facades\DB;
use App;
use App\DEncuestas;
use App\DPreguntas;
use App\DDatosPreguntaAbiertas;
use App\DDatosPreguntaMultiple;
use App\DDatosPreguntaEscala;
use App\DDatosPreguntaArchivo;
use App\DDatosPreguntaTabla;
use App\DEstiloEncuesta;


use App\EstilosEncuesta;

class PreguntaController extends Controller
{
    //
    
    public function EditarEncuesta($id_encuesta = '')
    {
        //$datos_encuesta = DB::table('encuestas')->where('id', $id_encuesta)->first(); //Contiene toda la informacion de la encuesta creada  
        $datos_encuesta =  $this->getDatosEncuesta(decrypt($id_encuesta));  
        $estilos_encuesta = App\DEstiloEncuesta::where('encuesta_id', decrypt($id_encuesta))->get(); 
        return view('preguntas.plantilla', compact('datos_encuesta', 'estilos_encuesta'));
    }


    public function save(Request $request)
    {
        //return $request->opcion2 ?? 'hola';
        //return $pregunta = DB::table('preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();
       $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->value('pregunta');
        if ($pregunta != $request->pregunta) 
        {
            $tipo_pregunta = $request->tipo_pregunta;

            $addNuevaPre = new App\DPreguntas; //Se obtienen todos los campos de la tabla preguntaAbierta
            $addNuevaPre->pregunta = $request->pregunta;
            $addNuevaPre->tipo_pregunta = $tipo_pregunta;
            $addNuevaPre->analizar_dato = 'si';
            $addNuevaPre->tipo_respuesta = $request->tipoResPregunta;
            $addNuevaPre->encuesta_id = $request->id_encuesta;
            $addNuevaPre->estado = 1;
            $addNuevaPre->save();

            switch ($tipo_pregunta) {
                case 'pre_abierta':

                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();
                    
                    $addOpcPre = new App\DDatosPreguntaAbiertas;  
                    $addOpcPre->tipo_respuesta = $tipo_pregunta;
                    $addOpcPre->tipo_form =  $request->tipoResPregunta;
                    $addOpcPre->res_requerido = 'si' ;
                    $addOpcPre->pregunta_id = $pregunta->id;
                    $addOpcPre->estado = 1;
                    $addOpcPre->save();

                    return "success";    
                    break;

                case 'pre_opcion_simple':
                    /*Obtner id de la pregunta*/
                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();

                    for ($i=0; $i < count($request->opcion); $i++) { 
                        $addOpcPre = new App\DDatosPreguntaMultiple;
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->tipo_opcion = 'res_simple';
                        $addOpcPre->opcion_otra = 'no';
                        /*if ($i == $numeroOpciones - 1 && $request->otra_opcion == true) {
                            $addOpcPre->opcion_otra = 'si';
                        } else {
                            $addOpcPre->opcion_otra = 'no';
                        }*/

                        $addOpcPre->analizar_dato = 'si';
                        $addOpcPre->pregunta_id = $pregunta->id;
                        $addOpcPre->estado = 1;
                        
                        if($addOpcPre->save()){
                           
                        }else {
                            return "Fallo";
                        }
                    }

                    //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);
                    return "success";

                    break;

                case 'pre_opcion_multiple':
                    /*Obtner id de la pregunta*/
                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();

                    for ($i=0; $i < count($request->opcion); $i++) { 
                        $addOpcPre = new App\DDatosPreguntaMultiple;
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->tipo_opcion = 'res_multiple';
                        $addOpcPre->opcion_otra = 'no';
                        /*if ($i == $numeroOpciones - 1 && $request->otra_opcion == true) {
                            $addOpcPre->opcion_otra = 'si';
                        } else {
                            $addOpcPre->opcion_otra = 'no';
                        }*/

                        $addOpcPre->analizar_dato = 'si';
                        $addOpcPre->pregunta_id = $pregunta->id;
                        $addOpcPre->estado = 1;
                        
                        if($addOpcPre->save()){
                            
                        }else {
                            return "Fallo";
                        }
                    }
                    return "success";
                   /* return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);*/

                    break; 

                case 'pre_desplegable':
                    /*Obtner id de la pregunta*/
                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();

                    for ($i=0; $i < count($request->opcion); $i++) { 
                        $addOpcPre = new App\DDatosPreguntaMultiple;
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->tipo_opcion = 'res_desplegable';
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->analizar_dato = 'si';
                        $addOpcPre->pregunta_id = $pregunta->id;
                        $addOpcPre->estado = 1;
                        
                        if($addOpcPre->save()){
                            
                        }else {
                            return "Fallo";
                        }
                    }
                    return 'success';    
                    //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);

                    break;

                case 'pre_escala':
                    /*Obtner id de la pregunta*/
                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();

                    for ($i=1; $i <= $request->rango; $i++) { 
                        $addOpcPre = new App\DDatosPreguntaEscala;
                        $addOpcPre->tipo_res = 'res_escala';
                        $addOpcPre->rango = $request->rango;
                        $addOpcPre->valor = $i;
                        $addOpcPre->analizar_dato = 1;
                        $addOpcPre->pregunta_id = $pregunta->id;
                        $addOpcPre->estado = 1;
                                            
                        if($addOpcPre->save()){
                            
                        }else {
                            return "Fallo";
                        }
                    }
                    return "success";
                    //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);

                    break; 

                case 'pre_archivo':
                    /*Obtner id de la pregunta*/
                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();
                   
                    $addOpcPre = new App\DDatosPreguntaArchivo;
                    $addOpcPre->tipo_formato = $request->tipo_archivo;
                    $addOpcPre->tipo_res = 'pre_img';
                    $addOpcPre->pregunta_id = $pregunta->id;
                    $addOpcPre->estado = 1;
                                                            
                    if($addOpcPre->save()){
                        
                    }else {
                        return "Fallo";
                    }
                
                    return "success";
                    //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);

                    break;        

                case 'pre_tabla':
                    /*Obtner id de la pregunta*/
                    $pregunta = DB::table('d_preguntas')->where([['pregunta', $request->pregunta], ['encuesta_id', $request->id_encuesta]])->first();
                   
                    $addOpcPre = new App\DDatosPreguntaTabla;
                    $addOpcPre->tipo_pregunta = $request->tipo_pregunta;
                    $addOpcPre->numero_columnas = $request->num_campos;
                    $addOpcPre->column1 = $request->opcion1 ?? 'null';
                    $addOpcPre->column2 = $request->opcion2 ?? 'null';
                    $addOpcPre->column3 = $request->opcion3 ?? 'null';
                    $addOpcPre->column4 = $request->opcion4 ?? 'null';
                    $addOpcPre->column5 = $request->opcion5 ?? 'null';
                    $addOpcPre->column6 = $request->opcion6 ?? 'null';
                    $addOpcPre->column7 = $request->opcion7 ?? 'null';
                    $addOpcPre->column8 = $request->opcion8 ?? 'null';
                    $addOpcPre->column9 = $request->opcion9 ?? 'null';
                    $addOpcPre->column10 = $request->opcion10 ?? 'null';
                    $addOpcPre->pregunta_id = $pregunta->id;
                                                            
                    if($addOpcPre->save()){
                        
                    }else {
                        return "Fallo";
                    }
                
                    return "success";
                    //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);

                    break; 
                case 'pre_nota':

                        return "success";
                        //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);
    
                        break;                 

                       
                default:
                    # code...
                    break;
            }
        
        }else {
            return 'existe';
        }
    	
    }

    public function EliminarPregunta(Request $request)
    {
        
        $pregunta = App\DPreguntas::find($request->id_pregunta);

        if($pregunta->delete()){
            return 'success';
            //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);
        }else{
            return 'Fallo al eliminar la pregunta';
        }
    }


    public function getDatosPregunta($id)
    {
        $preguntas = DB::table('d_preguntas')->where('id', $id)->get();
        $array_datos_pregunta;

           

            foreach ($preguntas as $key) {
                $datos_pregunta = [];

                if ( $key->tipo_pregunta === 'pre_abierta') {
                   $datos_pregunta = DB::table('d_datos_pregunta_abiertas')->where('pregunta_id', $key->id)->get();
                }

                else if ( $key->tipo_pregunta === 'pre_opcion_simple' || 'pre_opcion_multiple' || 'pre_desplegable') {
                   $datos_pregunta = DB::table('d_datos_pregunta_multiples')->where('pregunta_id', $key->id)->get();
                }

                else if ( $key->tipo_pregunta === 'pre_archivo') {
                   $datos_pregunta = DB::table('d_datos_pregunta_archivos')->where('pregunta_id', $key->id)->get();
                }
                
            
               return  $datos = array(
                    'id' => $key->id,
                    'pregunta' => $key->pregunta,
                    'tipo_pregunta' => $key->tipo_pregunta,
                    'tipo_respuesta' => $key->tipo_respuesta,
                    'datos' => $datos_pregunta

                );


                array_push($array_datos_pregunta, $datos);
            }

        return $array_datos_pregunta;
    }

//Funcion que recupera los datos y las preguntas de la encuesta
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
                        'tipo_pregunta' => $value->tipo_pregunta,
                        'tipo_respuesta' => $value->tipo_respuesta,

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


    public function EditarPregunta(Request $request)
    {
        //return $request->all();
        $pregunta = App\DPreguntas::find($request->id_pregunta);
        $pregunta->pregunta = $request->pregunta;
        $pregunta->tipo_respuesta = $request->tipoResPregunta;


        if ($request->tipo_pregunta === 'pre_abierta') {
            if ($pregunta->save()) {
                
                App\DDatosPreguntaAbiertas::where('pregunta_id', $request->id_pregunta)->update(['tipo_form' =>  $request->tipoResPregunta]);
                return 'success';

            }else{
                return 'fallo';
            }
        }

        if ($request->tipo_pregunta === 'pre_opcion_simple') {
            if ($pregunta->save()) {
                for ($i=0; $i < count($request->opcion) ; $i++) { 
                   if($request->ids[$i] === 'insert'){
                        //Inserto opcion
                        $addOpcPre = new App\DDatosPreguntaMultiple;
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->tipo_opcion = 'res_simple';
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->analizar_dato = 'si';
                        $addOpcPre->pregunta_id = $request->id_pregunta;
                        $addOpcPre->estado = 1;
                        $addOpcPre->save();
                   }else{

                        $addOpcPre = App\DDatosPreguntaMultiple::find($request->ids[$i]);
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->save();
                   }
                }

            return 'success';

            }else{
                return 'fallo';
            }
        }

        if ($request->tipo_pregunta === 'pre_opcion_multiple') {
            if ($pregunta->save()) {
                for ($i=0; $i < count($request->opcion) ; $i++) { 
                   if($request->ids[$i] === 'insert'){
                        //Inserto opcion
                        $addOpcPre = new App\DDatosPreguntaMultiple;
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->tipo_opcion = 'res_multiple';
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->analizar_dato = 'si';
                        $addOpcPre->pregunta_id = $request->id_pregunta;
                        $addOpcPre->estado = 1;
                        $addOpcPre->save();
                   }else{

                        $addOpcPre = App\DDatosPreguntaMultiple::find($request->ids[$i]);
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->save();
                   }
                }

            return 'success';

            }else{
                return 'fallo';
            }
        }

        if ($request->tipo_pregunta === 'pre_desplegable') {
            if ($pregunta->save()) {
                for ($i=0; $i < count($request->opcion) ; $i++) { 
                   if($request->ids[$i] === 'insert'){
                        //Inserto opcion
                        $addOpcPre = new App\DDatosPreguntaMultiple;
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->tipo_opcion = 'res_desplegable';
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->analizar_dato = 'si';
                        $addOpcPre->pregunta_id = $request->id_pregunta;
                        $addOpcPre->estado = 1;
                        $addOpcPre->save();
                   }else{

                        $addOpcPre = App\DDatosPreguntaMultiple::find($request->ids[$i]);
                        $addOpcPre->opcion = $request->opcion[$i];
                        $addOpcPre->opcion_otra = 'no';
                        $addOpcPre->save();                   }
                }

            return 'success';

            }else{
                return 'fallo';
            }
        }

        if ($request->tipo_pregunta === 'pre_escala') {
            if ($pregunta->save()) {

                if (App\DDatosPreguntaEscala::where('pregunta_id', $request->id_pregunta)->delete()) {
                    for ($i=1; $i <= $request->rango; $i++) { 
                        $addOpcPre = new App\DDatosPreguntaEscala;
                        $addOpcPre->tipo_res = 'res_escala';
                        $addOpcPre->rango = $request->rango;
                        $addOpcPre->valor = $i;
                        $addOpcPre->analizar_dato = 1;
                        $addOpcPre->pregunta_id = $request->id_pregunta;
                        $addOpcPre->estado = 1;
                                            
                        if($addOpcPre->save()){
                            
                        }else {
                            return "Fallo";
                        }
                    }

                    return "success";
                }

            }else{
                return 'fallo';
            }
        }

        if ($request->tipo_pregunta === 'pre_archivo') {
            if ($pregunta->save()) {

                $addOpcPre = App\DDatosPreguntaArchivo::find($request->id_datos_archivo);
                $addOpcPre->tipo_formato = $request->tipo_formato;
                if ($addOpcPre->save()) {
                    return 'success';
                }

            }else{
                return 'fallo';
            }
        }

         if ($request->tipo_pregunta === 'pre_nota'){
             if ($pregunta->save()) {
                return 'success';
             }
            
         }

         if ($request->tipo_pregunta === 'pre_tabla') {
            if ($pregunta->save()) {
                App\DDatosPreguntaTabla::where('pregunta_id', $request->id_pregunta)
                                    ->update([
                                                'numero_columnas' =>  $request->num_campos,
                                                'column1' =>  $request->opcion1 ?? 'null',
                                                'column2' =>  $request->opcion2 ?? 'null',
                                                'column3' =>  $request->opcion3 ?? 'null',
                                                'column4' =>  $request->opcion4 ?? 'null',
                                                'column5' =>  $request->opcion5 ?? 'null',
                                                'column6' =>  $request->opcion6 ?? 'null',
                                                'column7' =>  $request->opcion7 ?? 'null',
                                                'column8' =>  $request->opcion8 ?? 'null',
                                                'column9' =>  $request->opcion9 ?? 'null',
                                                'column10' =>  $request->opcion10 ?? 'null'
                                            ]);
                return 'success';
            }
            
         }
        
    }

    public function getOpcionesPregunta($id = 0)
    {
        $pregunta = App\DPreguntas::where('id', $id)->first();
        
        if ($pregunta->tipo_pregunta === 'pre_opcion_simple') {
           $datos_pregunta = App\DDatosPreguntaMultiple::all()->where('pregunta_id',$id);
           $resultado = [];
           foreach ($datos_pregunta as $value) {
               $datos = array(
                    'id' => $value->id,
                    'opcion' => $value->opcion,
                    'tipo_opcion' => $value->tipo_opcion,
                    'pregunta_id' => $value->pregunta_id
               );

               array_push($resultado, $datos);
           }
           return $resultado;
        }

        if ($pregunta->tipo_pregunta === 'pre_opcion_multiple') {
           $datos_pregunta = App\DDatosPreguntaMultiple::all()->where('pregunta_id',$id);
           $resultado = [];
           foreach ($datos_pregunta as $value) {
               $datos = array(
                    'id' => $value->id,
                    'opcion' => $value->opcion,
                    'tipo_opcion' => $value->tipo_opcion,
                    'pregunta_id' => $value->pregunta_id
               );

               array_push($resultado, $datos);
           }
           return $resultado;
        }

        if ($pregunta->tipo_pregunta === 'pre_desplegable') {
           $datos_pregunta = App\DDatosPreguntaMultiple::all()->where('pregunta_id',$id);
           $resultado = [];
           foreach ($datos_pregunta as $value) {
               $datos = array(
                    'id' => $value->id,
                    'opcion' => $value->opcion,
                    'tipo_opcion' => $value->tipo_opcion,
                    'pregunta_id' => $value->pregunta_id
               );

               array_push($resultado, $datos);
           }
           return $resultado;
        }

        if ($pregunta->tipo_pregunta === 'pre_escala') {
           $datos_pregunta = App\DDatosPreguntaEscala::all()->where('pregunta_id',$id);
           $resultado = [];
           foreach ($datos_pregunta as $value) {
               $datos = array(
                    'id' => $value->id,
                    'tipo_res' => $value->tipo_res,
                    'rango' => $value->rango,
                    'valor' => $value->valor,
                    'pregunta_id' => $value->pregunta_id
               );

               array_push($resultado, $datos);
           }
           return $resultado;
        }

        if ($pregunta->tipo_pregunta === 'pre_archivo') {
           $datos =  App\DDatosPreguntaArchivo::all()->where('pregunta_id',$id);
           $archivo = [];
           foreach ($datos as $value) {
               $data = array(
                   'id' => $value->id,
                   'tipo_formato' => $value->tipo_formato,
                   'tipo_res' => $value->tipo_res,
                   'pregunta_id' => $value->pregunta_id

               );

               array_push($archivo, $data);
           }

           return $archivo;
           
        }

        if ($pregunta->tipo_pregunta === 'pre_tabla') {
           return App\DDatosPreguntaTabla::all()->where('pregunta_id',$id);
           
        }

        else{
            return 0;
        }

    }

    public function eliminarOpcion($id= 0)
    {
        $opcion_pregunta = App\DDatosPreguntaMultiple::find($id);

        if($opcion_pregunta->delete()){
            return 'success';
            //return redirect()->route('editarEncuesta',['id' => $request->id_encuesta]);
        }else{
            return 'Fallo al eliminar la pregunta';
        }
    }
}
