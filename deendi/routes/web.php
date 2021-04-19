<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Sin verificación
/*Auth::routes();
Route::get('inicio', 'HomeController@index')->name('home');
Route::get('inicio', 'EncuestasController@show')->name('home'); */


/* Verifica la autenticación del usuario descomentar para producción */
Auth::routes(['verify' => true]);
Route::get('inicio', 'HomeController@index')->name('home')->middleware(['auth', 'verified']);
Route::get('inicio', 'EncuestasController@show')->name('home')->middleware(['auth','verified']);

Route::get('recibidas','EncuestasController@listaEncuestasRecibidas')->name('recibidas')->middleware('auth');
Route::post('recibidas/eliminar/encuesta/{id}','EncuestasController@eliminarEncuestaRecibido')->name('eliminarEncuestaRecibido')->middleware('auth');
Route::get('enviadas','EncuestasController@listaEncuestasEnvidas')->name('enviadas')->middleware('auth');
Route::post('enviadas/usuario/eliminar/{id}','EncuestasController@eliminarEncuestaUsuarioEnviado')->name('eliminarEncuestaUsuarioEnviado')->middleware('auth');

Route::post('enviadas/email/eliminar/{id}','EncuestasController@eliminarEncuestaEmailEnviado')->name('eliminarEncuestaEmailEnviado')->middleware('auth');

Route::get('nueva-encuesta','EncuestasController@VerFormEncuesta')->name('nuevaEncuesta')->middleware('auth');
Route::get('encuestas/pendientes', 'EncuestasController@VerEncuestasPendientes')->name('listaEncuestasPendientes')->middleware('auth');
Route::get('encuestas/terminadas', 'EncuestasController@VerEncuestasTerminadas')->name('listaEncuestasTerminadas')->middleware('auth');
Route::get('buscar', 'EncuestasController@BuscarEncuesta')->name('buscarEncuesta')->middleware('auth');
Route::post('crear-encuesta','EncuestasController@CrearEncuesta')->name('crearEncuesta')->middleware('auth');

Route::get('encuesta/pendiente/{id}','EncuestasController@pendienteEncuesta')->name('pendienteEncuesta')->middleware('auth');
Route::get('encuesta/finalizar/{id}','EncuestasController@finalizarEncuesta')->name('finalizarEncuesta')->middleware('auth');

Route::get('encuesta/eliminar/{id}','EncuestasController@eliminarEncuesta')->name('eliminarEncuesta')->middleware('auth');
Route::post('encuesta/editar/datos/{id}','EncuestasController@editarDatosEncuesta')->name('editarDatosEncuesta')->middleware('auth');
/*
/------------------------------------------------------------------------------------------
/Preguntas
/------------------------------------------------------------------------------------------
 */
Route::get('encuesta/desarrollo/{id}', 'PreguntaController@EditarEncuesta')->name('editarEncuesta')->middleware('auth');
Route::get('encuesta/desarrollo/get/pregunta/{id}', 'PreguntaController@getDatosPregunta')->name('getPregunta')->middleware('auth');
Route::get('encuesta/desarrollo/get/pregunta/datos/{id}', 'PreguntaController@getOpcionesPregunta')->name('getOpciones')->middleware('auth');
Route::get('encuesta/desarrollo/eliminar/opcion/{id}', 'PreguntaController@eliminarOpcion')->name('eliminarOpcion')->middleware('auth');

Route::get('encuesta/desarrollo/encuesta/preguntas/{id}','PreguntaController@getDatosPreguntas')->middleware('auth');

Route::post('encuesta/desarrollo/guardar', 'PreguntaController@save')->name('agregarPregunta')->middleware('auth');

Route::post('encuesta/desarrollo/eliminar', 'PreguntaController@EliminarPregunta')->name('eliminarPregunta')->middleware('auth');

Route::post('encuesta/desarrollo/editar', 'PreguntaController@editarPregunta')->name('editarPregunta')->middleware('auth');

/*
/------------------------------------------------------------------------------------------
/Aplicar encuesta
/------------------------------------------------------------------------------------------
 */

Route::get('encuesta/responder/{id}','AplicarEncuestaController@index')->name('aplicarEncuesta')->middleware('auth');
Route::get('encuesta/responder/obtener/preguntas/{id}','AplicarEncuestaController@getDatosPreguntas')->middleware('auth');

Route::post('encuesta/responder/enviar', 'AplicarEncuestaController@store')->name('guardarRespuestas')->middleware('auth');
Route::post('encuesta/responder/enviar/archivos', 'AplicarEncuestaController@guardarImages')->name('guardarRespuestasArchivo')->middleware('auth');

/*
/------------------------------------------------------------------------------------------
/Resultados
/------------------------------------------------------------------------------------------
 */
Route::get('resultados', 'ResultadoController@show')->name('resultados')->middleware('auth');
Route::post('resultados/limpiar/{id}', 'ResultadoController@limpiarDatosEncuesta')->name('limpiarDatos')->middleware('auth');
Route::get('resultados/encuesta/{id}', 'ResultadoController@verResultado')->name('verResultado')->middleware('auth');
Route::get('resultados/encuesta/resumen/{id}', 'ResultadoController@verResultadoResume')->name('verResultadoResume')->middleware('auth');

Route::get('resultados/buscar', 'ResultadoController@buscarEncuestaAplicado')->name('buscarEncuestaAplicado')->middleware('auth');

Route::get('resultados/encuesta/get/pregunta/datos/{id}', 'ResultadoController@getDatosPreguntasResultados')->name('getDatosPreguntasAnalisis')->middleware('auth');
Route::get('resultados/encuesta/resumen/get/pregunta/datos/{id}', 'ResultadoController@getDatosPreguntasResultadosResumen')->name('getDatosPreguntasAnalisisResumen')->middleware('auth');


/*
/------------------------------------------------------------------------------------------
/Compartir
/------------------------------------------------------------------------------------------
 */
Route::get('compartir/{id}', 'CompartirController@index')->name('vistaCompartir')->middleware('auth');

Route::post('compartir/encuesta/usuario', 'CompartirController@enviarUsuario')->name('enviarUsuario')->middleware('auth');

Route::post('compartir/encuesta/datos', 'CompartirController@enviarEncuesta')->name('campartirEncuesta');//enviar encuesta
Route::get('compartir/obtener/grupos/{id}', 'CompartirController@getGrupos')->name('getGrupos');//enviar encuesta

Route::post('compartir/encuesta/grupo', 'CompartirController@campartirEncuestaGrupo')->name('campartirEncuestaGrupo')->middleware('auth');

Route::post('compartir/encuesta/correo', 'CompartirController@EnviarEncuestaCorreo')->name('EnviarEncuestaCorreo')->middleware('auth');
Route::post('compartir/encuesta/correo/grupo', 'CompartirController@EnviarEncuestaCorreoGrupo')->name('campartirEncuestaCorreoGrupo')->middleware('auth');

Route::get('responder/encuesta/{id}', 'CompartirController@encuestaResponderEmail')->name('vistaEncuestaEmail');



/*
/------------------------------------------------------------------------------------------
/Agenda
/------------------------------------------------------------------------------------------
 */
Route::get('agenda/contactos','AgendaController@showContactos')->name('agenda')->middleware('auth');

Route::post('agenda/contactos','AgendaController@registrarContacto')->name('registrarContacto')->middleware('auth');
Route::post('agenda/contactos/eliminar/{id}','AgendaController@eliminarContacto')->name('eliminarContacto')->middleware('auth');
Route::post('agenda/contactos/editar','AgendaController@editarContacto')->name('editarContacto');

Route::get('buscar/contacto','AgendaController@BuscarContacto')->name('buscarContacto')->middleware('auth');

Route::get('agenda/contactos/obtener','AgendaController@getDatosContacto')->name('getDatosContacto')->middleware('auth');



Route::get('agenda/grupos-de-trabajo','AgendaController@showGrupos')->name('gruposDeTrabajo')->middleware('auth');
Route::post('agenda/grupos-de-trabajo','AgendaController@registrarGrupo')->name('registrarGrupo')->middleware('auth');
Route::post('agenda/grupos-de-trabajo/eliminar/{id}','AgendaController@eliminarGrupo')->name('eliminarGrupo')->middleware('auth');
Route::post('agenda/grupos-de-trabajo/editar','AgendaController@editarGrupo')->name('editarGrupo');

Route::get('buscar/grupos-de-trabajo','AgendaController@BuscarGrupo')->name('buscarGrupo')->middleware('auth');

Route::get('agenda/grupos-de-trabajo/obtener','AgendaController@getDatosGrupo')->name('getDatosGrupo')->middleware('auth');

/*
/------------------------------------------------------------------------------------------
/Estilos de la encuesta
/------------------------------------------------------------------------------------------
 */

Route::post('guardar/estilos/fondo', 'EstiloEncuestaController@cambiarFondoEncabezado')->name('agregarEstilos')->middleware('auth');
Route::post('guardar/estilos/fuente', 'EstiloEncuestaController@cambiarEstilosFuente')->name('agregarEstilosFuente')->middleware('auth');
Route::get('guardar/estilos/fuente/{id}', 'EstiloEncuestaController@mostrarEncuestaEnProceso')->name('mostrarEncuestaEnProceso')->middleware('auth');
Route::get('guardar/estilos/fuente/obtener/preguntas/{id}', 'EstiloEncuestaController@getDatosEncuestaDiseño')->name('getDatosEncuestaDiseño')->middleware('auth');

/*
/------------------------------------------------------------------------------------------
/Aplicar encuesta email
/------------------------------------------------------------------------------------------
 */
Route::get('encuesta/recibido/{id}','AplicarEncuestaEmailController@mostrar_encuesta_aplicar')->name('showEncuestaEmail');
Route::get('encuesta/recibido/get/datos/{id}','AplicarEncuestaEmailController@get_datos_preguntas')->name('getDatosPreguntasEmail');
Route::post('encuesta/recibido/guardar/datos','AplicarEncuestaEmailController@guardar_datos_encuesta')->name('guardarDatos');
Route::post('encuesta/recibido/guardar/archivos','AplicarEncuestaEmailController@guardar_datos_archivo')->name('guardarDatosArchivo');
//Route::get('encuesta/recibido/finalizado','AplicarEncuestaEmailController@mensaje_encuesta_aplicado')->name('finalizado');
Route::get('encuesta/recibido/undefined/encuesta/finalizado', function (){
    return view('encuesta.email.mensaje');
})->name('saludo');

/*
/------------------------------------------------------------------------------------------
/Reporte PDF
/------------------------------------------------------------------------------------------
 */

Route::get('reporte/encuesta/{id}', 'ReporteController@index')->name('pdf')->middleware('auth');
Route::get('reporte/encuesta/get/pregunta/datos/{id}', 'ReporteController@getDatosReporte')->name('getDatosReporte')->middleware('auth');


/*
/------------------------------------------------------------------------------------------
/Ayuda
/------------------------------------------------------------------------------------------
 */
Route::get('ayuda', 'AyudaController@showAyuda')->name('ayuda');
Route::get('sobre-nosotros', 'AyudaController@sobreNosotros')->name('info')->middleware('auth');
Route::get('error/pagina',function (){
	return view('ayuda.404');
})->name('404')->middleware('auth');

Route::get('terminos', function (){
    return view('auth.perfil.terminos');
});


/*
/------------------------------------------------------------------------------------------
/Perfil
/------------------------------------------------------------------------------------------
 */

Route::get('perfil', 'HomeController@perfil')->name('perfil')->middleware('auth');
Route::put('perfil/actualizar/{id}','HomeController@actualizarUser')->name('updateUser')->middleware('auth');