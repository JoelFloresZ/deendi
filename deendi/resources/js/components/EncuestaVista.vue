<template>
    <div>
        <form method="POST" enctype="multipart/form-data">
            <div>
               <!--  <h2 class="font-weight-bold color_titulo">{{encuesta.titulo}}</h2>
                <p class="font-weight-normal color_titulo">{{encuesta.descripcion}}</p> -->
            </div>
            

            <div class="pb-5" v-for="(formulario, index) in formularios" :key="index">
                
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
                                    form:     `<input type="text" class="form-control" id="pregunta${i}" placeholder="Respuesta">`,
                                    tipo_pregunta: 'pre_abierta'
                                }
                            )
                        }else {
                            this.formularios.push(
                                {
                                    pregunta: pregunta.pregunta,
                                    id:       pregunta.id,
                                    form:     `<textarea id="pregunta${i}" placeholder="Respuesta" rows="1" class="form-control"></textarea>`,
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
                                                <input type="file" class="form-control-file" id="archivo${pregunta.id}" accept="image/${pregunta.datos[0].tipo_formato}">
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
            }

        }
    }

</script>