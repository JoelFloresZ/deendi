<template>
    <div>
        <form method="POST" v-on:submit.prevent="enviarDatos" enctype="multipart/form-data">
            
            <div class="pb-5 w-75" v-for="(formulario, index) in formularios" :key="index">
                
                <label class="font-weight-bold h4" v-if="formulario.tipo_pregunta === 'pre_nota'">{{formulario.pregunta}}</label>
                <label class="font-weight-bold h5" v-else>{{formulario.pregunta}} <span class="text-primary ml-1">*</span></label>

                <div v-if="formulario.tipo_pregunta === 'pre_abierta'">
                    <div v-html="formulario.form">
                        {{formulario.form}}
                    </div>
                </div>

                <div v-if="formulario.tipo_pregunta === 'pre_opcion_simple'">
                    
                    <div v-for="(opcion, index) in formulario.form" :key="index" v-html="opcion.opcion">
                        {{opcion.opcion}}
                    </div>
                </div>

                <div v-if="formulario.tipo_pregunta === 'pre_opcion_multiple'">
                    
                    <div v-for="(opcion, index) in formulario.form" :key="index" v-html="opcion.opcion">
                        {{opcion.opcion}}
                    </div>
                </div>

                <div v-if="formulario.tipo_pregunta === 'pre_desplegable'">
                    <div v-html="formulario.form">{{formulario.form}}</div>
                </div>

                <div v-if="formulario.tipo_pregunta === 'pre_escala'">
                    <div v-for="(opcion, index) in formulario.form" :key="index" v-html="opcion.opcion" class="d-flex justify-content-between">
                        {{opcion.opcion}}
                    </div>
                </div>

                <div v-if="formulario.tipo_pregunta === 'pre_tabla'">
                    
                    <div>
                        <table class="table table-bordered mb-0">
                        <thead class="bg-dark text-white text-center">
                            <tr class="d-flex justify-content-around">
                                <th v-if="formulario.form.column1 !== 'null'" class="border-0">{{formulario.form.column1}}</th>
                                <th v-if="formulario.form.column2 !== 'null'" class="border-0">{{formulario.form.column2}}</th>
                                <th v-if="formulario.form.column3 !== 'null'" class="border-0">{{formulario.form.column3}}</th>
                                <th v-if="formulario.form.column4 !== 'null'" class="border-0">{{formulario.form.column4}}</th>
                                <th v-if="formulario.form.column5 !== 'null'" class="border-0">{{formulario.form.column5}}</th>
                                <th v-if="formulario.form.column6 !== 'null'" class="border-0">{{formulario.form.column6}}</th>
                                <th v-if="formulario.form.column6 !== 'null'" class="border-0">{{formulario.form.column6}}</th>
                                <th v-if="formulario.form.column7 !== 'null'" class="border-0">{{formulario.form.column7}}</th>
                                <th v-if="formulario.form.column8 !== 'null'" class="border-0">{{formulario.form.column8}}</th>
                                <th v-if="formulario.form.column9 !== 'null'" class="border-0">{{formulario.form.column9}}</th>
                                <th v-if="formulario.form.column10 !== 'null'" class="border-0">{formulario.form.column10}}</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    <tablaDinamica :datos="formulario"></tablaDinamica>
                </div>

                <div v-if="formulario.tipo_pregunta === 'pre_archivo'">
                    <div v-html="formulario.form"></div> 
                </div>
                

                <hr class="bg-faded">
            </div>

            <div class="d-flex justify-content-start w-75 w-md-100">
                <button class="btn btn-outline-primary" id="save-datos" style="border-radius: 20px;">ENVIAR</button>
            </div>
        </form>


        <!-- Modal -->
        <div class="modal fade" id="model2Id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" >
                <div class="modal-content" style="background: rgba(0,0,0,0.0); border: none;">
                    <div class="modal-body d-flex justify-content-center align-items-center" style="height: 600px;">
                        <div class="spinner-border text-white"  style="width: 5rem; height: 5rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Vuex from 'vuex'
    export default {
        
        data() {
            return {
               encuesta: [], 
               formularios: [],
               campos_tabla: [],
               numero_de_campos: 2,
               contador_de_campos: 1
                
            }
        },

        computed: {
            ...Vuex.mapState(['url_aplicar_encuesta']) //Se mapea los States deL Store
        },
        
        created(){
            this.getDatosEncuesta($('#encuesta_id').val());
            
        },

        methods: {         

            getDatosEncuesta(id) {
                axios.get('obtener/preguntas/'+ id)
                .then((result) => {      
                    this.asignarFormulario(result.data[0]);    
                }).catch((err) => {
                    console.log(err);
                });
                
            },

            asignarFormulario(datos) {
                this.encuesta = datos;
                console.log(datos);               
                /*Fomulario*/
                for (var i = 0 ; i < datos.preguntas.length; i++) {

                    var tipo_form = datos.preguntas[i].tipo_pregunta;
                    var pregunta = datos.preguntas[i];

                    if (tipo_form === 'pre_abierta') {
                       if (pregunta.tipo_respuesta === 'abierta') {
                            this.formularios.push(
                                {
                                    pregunta: pregunta.pregunta,
                                    id:       pregunta.id,
                                    form:     `<input type="text" class="form-control" id="pregunta${i}" placeholder="Respuesta" required>`,
                                    tipo_pregunta: 'pre_abierta'
                                }
                            )
                        }else {
                            this.formularios.push(
                                {
                                    pregunta: pregunta.pregunta,
                                    id:       pregunta.id,
                                    form:     `<textarea id="pregunta${i}" placeholder="Respuesta" rows="3" class="form-control" required maxlenght="800"></textarea>`,
                                    tipo_pregunta: 'pre_abierta'
                                }
                            )
                        }
                    }
                    if (tipo_form === 'pre_opcion_simple') {
                        
                        var datos_opciones = [];

                            for (var x = 0 ; x < pregunta.datos.length; x++) {
                                datos_opciones.push(
                                {   opcion:`<div class="custom-control custom-radio">
                                                <input type="radio" id="opcionSimple${i}${x}" value="${pregunta.datos[x].id}" name="opcion${i}" class="custom-control-input">
                                              <label class="custom-control-label" for="opcionSimple${i}${x}">${pregunta.datos[x].opcion}</label>
                                            </div>`,
                                    id:  pregunta.datos[x].id 
                                              
                                    }
                                );

                            }

                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     datos_opciones,
                                tipo_pregunta: 'pre_opcion_simple'
                            }
                        )
                    }

                    if (tipo_form === 'pre_opcion_multiple') {
                        
                        var datos_opciones = [];

                            for (var x = 0 ; x < pregunta.datos.length; x++) {
                                datos_opciones.push(
                                {   opcion:`<div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="opcionMultiple${i}${x}" class="custom-control-input" value="${pregunta.datos[x].id}" name="opcion${i}">
                                                <label class="custom-control-label" for="opcionMultiple${i}${x}">${pregunta.datos[x].opcion}</label>
                                            </div>`,
                                    id:  pregunta.datos[x].id 
                                              
                                    }
                                );

                            }

                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     datos_opciones,
                                tipo_pregunta: 'pre_opcion_simple'
                            }
                        )
                    }

                    if (tipo_form === 'pre_desplegable') {
                        
                        var datos_opciones = '<option selected>Seleccinar opción</option>';

                            for (var x = 0 ; x < pregunta.datos.length; x++) {
                                datos_opciones += `<option value="${pregunta.datos[x].id}">${pregunta.datos[x].opcion}</option>`;
                            }

                        var form_seleccion = `<select class="custom-select" id="pregunta${i}">${datos_opciones}</select>`    

                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     form_seleccion,
                                tipo_pregunta: 'pre_desplegable'
                            }
                        )
                    }

                    if (tipo_form === 'pre_escala') {
                        
                        var datos_opciones = [];

                            for (var x = 0 ; x < pregunta.datos.length; x++) {
                                datos_opciones.push(
                                {   opcion:`<div class="custom-control custom-radio">
                                                <input type="radio" id="opcionEscala${i}${x}" value="${pregunta.datos[x].id}" name="opcion${i}" class="custom-control-input">
                                              <label class="custom-control-label" for="opcionEscala${i}${x}">${pregunta.datos[x].valor}</label>
                                            </div>`,
                                    id:  pregunta.datos[x].id 
                                              
                                    }
                                );

                            }

                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     datos_opciones,
                                tipo_pregunta: 'pre_opcion_simple'
                            }
                        )
                    }

                    if (tipo_form === 'pre_tabla') { 
                        var campos = '';
                                                 

                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     pregunta.datos[0],
                                tipo_pregunta: 'pre_tabla',
                                tabla: campos,
                                numero_de_campo: pregunta.datos[0].numero_columnas,
                            }
                        )
                       
                    }

                    if (tipo_form === 'pre_archivo') { 
                        if (pregunta.datos[0].tipo_formato != '*') {
                           var inpit_archivo = `<div class="custom-file">
                                                <input type="file" class="form-control-file" id="archivo${pregunta.id}" accept="image/${pregunta.datos[0].tipo_formato}" required>
                                                <span class="text-muted">Solo se aceptan imágenes con formato de tipo .${pregunta.datos[0].tipo_formato}</span>
                                            </div>`; 
                        } else {
                            var inpit_archivo = `<div class="custom-file">
                                                <input type="file" class="form-control-file" id="archivo${pregunta.id}" accept="image/${pregunta.datos[0].tipo_formato}">
                                                <span class="text-muted">Se aceptan imágenes de todos los formatos</span>
                                            </div>`;
                        }                                               
                        
                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     inpit_archivo,
                                tipo_pregunta: 'pre_archivo',
                               
                            }
                        )
                       
                    }

                    if (tipo_form === 'pre_nota') {                                            
                        this.formularios.push(
                            {
                                pregunta: pregunta.pregunta,
                                id:       pregunta.id,
                                form:     [],
                                tipo_pregunta: 'pre_nota',
                               
                            }
                        )
                       
                    }
                }
            },

            
            getDatosEnviar(){
                console.log('obteniendo datos');
                var preguntas = this.encuesta.preguntas 
                
                var datos_enviar = [];  //Objeto de arreglos que se envian al servidor

                for(var j = 0;  j < preguntas.length; j++){

                    var tipo_pregunta = preguntas[j].tipo_pregunta;
                    if (tipo_pregunta === 'pre_abierta') {
                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuesta: $(`#pregunta${j}`).val(),
                                tipo_pregunta: 'pre_abierta'
                            }
                        );   
                    }

                    if (tipo_pregunta === 'pre_opcion_simple') {
                        var respuesta = 0;
                            for(var k = 0; k < preguntas[j].datos.length; k++){
                               if (document.getElementById(`opcionSimple${j}${k}`).checked) {
                                    respuesta = document.getElementById(`opcionSimple${j}${k}`).value;
                               }
                            }

                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuesta_id: respuesta,
                                tipo_pregunta: 'pre_opcion_simple',
                                respuesta_otra: 'no'
                            }
                        );   
                    }

                    if (tipo_pregunta === 'pre_opcion_multiple') {
                        var respuesta_opciones = [];
                            for(var k = 0; k < preguntas[j].datos.length; k++){
                               if (document.getElementById(`opcionMultiple${j}${k}`).checked) {
                                    respuesta_opciones.push({
                                        id_opcion: document.getElementById(`opcionMultiple${j}${k}`).value
                                    });
                               }
                            }

                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuesta_id: respuesta_opciones,
                                tipo_pregunta: 'pre_opcion_multiple',
                                respuesta_otra: 'no'
                            }
                        );   
                    }

                    if (tipo_pregunta === 'pre_desplegable') {

                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuesta_id: $(`#pregunta${j}`).val(),
                                tipo_pregunta: 'pre_desplegable',
                                respuesta_otra: 'no'
                            }
                        );   
                    }

                    if (tipo_pregunta === 'pre_escala') {
                        var respuesta = 0;
                            for(var k = 0; k < preguntas[j].datos.length; k++){
                               if (document.getElementById(`opcionEscala${j}${k}`).checked) {
                                    respuesta = document.getElementById(`opcionEscala${j}${k}`).value;
                               }
                            }

                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuesta_id: respuesta,
                                rango: preguntas[j].datos.length,
                                tipo_pregunta: 'pre_escala',
                                respuesta_otra: 'no'
                            }
                        );   
                    }

                    if (tipo_pregunta === 'pre_tabla') {
                        var respuesta = [];
                        var fila_respuestas = [];

                        var numeroDeCamposRespuestas = $(`#${preguntas[j].id}`).val();
                            for (var c = 0; c <= numeroDeCamposRespuestas; c++) {
                                if (fila_respuestas.length <  preguntas[j].datos[0].numero_columnas) {
                                    var respuestaTabla = $(`#tabla${preguntas[j].id}res${c}`).val();
                                    fila_respuestas.push({
                                        res_tabla: respuestaTabla
                                    });

                                }else {
                                    
                                    respuesta.push({
                                        fila:fila_respuestas
                                    });

                                    fila_respuestas = [];
                                    c--; //restamos uno para anivelar y poder guardar los datos en cada vuelta del loop
                                }  
                            }

                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuestas: respuesta,
                                tipo_pregunta: 'pre_tabla',
                                numero_columnas: preguntas[j].datos[0].numero_columnas
                            }
                        );   
                    }

                    if (tipo_pregunta === 'pre_archivo') {
                                                
                        datos_enviar.push(
                            { 
                                id_encuesta: $('#encuesta_id').val(),
                                id_pregunta: preguntas[j].id,
                                respuestas:  [],
                                tipo_pregunta: 'pre_archivo'
                            }
                        );   
                    }
                }


                return datos_enviar;
                
            },

            enviarDatos() {      
                $('#model2Id').modal('show')
                var respuestas = this.getDatosEnviar();
                //console.log(this.analisiDeDatos(respuestas));

                axios.post(`${this.url_aplicar_encuesta}/enviar`, respuestas).then((result) => {
                    
                    if (result.data === "success") {
                       $('.modal').modal('hide');
                       swal("Éxito!", "Los datos se han enviado correctamente!", "success");

                    }else{

                        this.enviarDatosArchivo(result.data);
                    }                   
               
                }).catch((err) => {
                    console.log(err);
                    $('#model2Id').modal('hide')
                });
            },

            enviarDatosArchivo(datos) {
               
                var preguntas = this.encuesta.preguntas;

                var formData = new FormData();
                var contador_de_imagenes = 0; //cuenta el numero de preguntas de tipo imagen
                var contador_de_get_image = 0;
                 for(var j = 0;  j < preguntas.length; j++){
                    var tipo_pregunta = preguntas[j].tipo_pregunta;
                    if (tipo_pregunta === 'pre_archivo') {

                        contador_de_imagenes +=1;
                        const inputFile = document.querySelector(`#archivo${preguntas[j].id}`);

                        formData.append("file" +contador_de_get_image, inputFile.files[0]);
                        formData.append("id_respuesta_img" +contador_de_get_image, datos[contador_de_get_image].respuesta_img_id);
                        formData.append("tipo_pregunta",'pre_archivo');
                        formData.append("num_preguntas_img", contador_de_imagenes); 

                        contador_de_get_image++; 
                    }


                 }

                 console.log(formData);

                $.ajax({
                    url:`${this.url_aplicar_encuesta}/enviar/archivos`,
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // unnecessary 
                    type: "post",
                    data: formData,
                    dataType: false,
                    cache: false,
                    contentType: false,
                    processData: false
                    }).done(function(res){
                    console.log(res); 
                    if (res === 'success') {
                        $('.modal').modal('hide');
                        swal("Éxito!", "Los datos se han enviado correctamente!", "success");
                    }             
                });
            },

            /* Funcion para comprobar que todos los campos esten llenos en el formualrio
                falta terminar
                este en proceso "Solo se configuro para la tabla ? Sin terminar"
            */
            analisiDeDatos(datos) {

                var total_de_preguntas = datos.length;
                var preguntas_respondidos = 0;
                var acceso = false;

                for (var i = 0; i < datos.length; i++) {
                    //console.log(datos[i]);
                    let tipo_pregunta = datos[i].tipo_pregunta;

                    if (tipo_pregunta === "pre_tabla") {

                        var campos_vacios = false

                        let tabla = datos[i];
                        let numero_columnas = tabla.numero_columnas;

                        for (var x = 0; x < tabla.respuestas.length; x++) {
                            
                            let respuestas = tabla.respuestas[x];

                            for (var z = 0; z < respuestas.length; z++) {
                                if (respuestas[z].res_tabla != "") {
                                    campos_vacion = false;
                                }else {
                                    campos_vacion = true;
                                } 
                            }
                        }

                        if (campos_vacios) {
                            preguntas_respondidos ++;
                        }


                    }
                }

                if (total_de_preguntas === preguntas_respondidos) {
                    acceso = true;
                }

                return acceso;
                
            }

        }
    }

</script>