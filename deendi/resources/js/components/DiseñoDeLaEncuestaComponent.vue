<template>
    <div>
        <div v-if="encuesta.length > 0">
            <div v-for="(pregunta, index) in encuesta" :key="index">
                <div class="">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-light text-dark btn-sm" v-on:click="getDatosPregunta(pregunta.id)" data-toggle="modal" data-target="#updatePregunta"><i class="fa fa-edit h5"></i></button>
                        <button class="btn btn-outline-light text-dark btn-sm" v-on:click="eliminarPregunta(pregunta.id)">
                            <i class="fa fa-trash h5"></i>
                        </button>
                    </div>
                    <label class="font-weight-bold h5">{{pregunta.pregunta}} <span class="ml-1 h2 text-primary">*</span></label>

                    <div v-if="pregunta.tipo_pregunta === 'pre_abierta'">
                        <div v-if="pregunta.tipo_respuesta === 'Corta'">
                            <input type="text" name="pregunta" id="pregunra" class="form-control" placeholder="Respuesta">
                        </div>
                        <div v-else>
                            <textarea name="parrafo" class="form-control" rows="2" placeholder="Respuesta"></textarea>
                        </div>
                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_opcion_simple'">

                        <div v-for="(opcion, index) in pregunta.datos" :key="index">
                            <div>
                                <div class="custom-control custom-radio">
                                  <input type="radio" id="customRadio" name="customRadio" class="custom-control-input">
                                  <label class="custom-control-label" for="customRadio1">{{ opcion.opcion }}</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_opcion_multiple'">
                        <div v-for="(opcion, index) in pregunta.datos" :key="index">
                            <div>
                               <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">{{ opcion.opcion }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_desplegable'">
                        <div>
                            <select class="custom-select"> 
                                <option v-for="(opcion, index) in pregunta.datos" :key="index" value="">{{opcion.opcion }}</option>
                            </select>
                        </div>
                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_escala'">
                        <div class="d-flex justify-content-between">
                            <p>Min</p>
                            <div class="custom-control custom-radio custom-control-inline" v-for="(opcion, index) in pregunta.datos" :key="index">
                                <input type="radio" id="customRadioInline1" name="rango[]" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">{{opcion.valor}}</label>
                            </div>
                            <p class="mr-5">Max</p>
                        </div>
                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_archivo'">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLangHTML">
                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Buscar">Seleccione el archivo</label>
                            <small class="text-muted" v-if="pregunta.datos[0].tipo_formato === '*'">Se aceptan imágenes de todos los formatos</small>
                            <small class="text-muted" v-else>Solo se aceptan imágenes con formato de tipo .{{pregunta.datos[0].tipo_formato}}</small>
                        </div>   
                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_tabla'">
                
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white text-center">
                                <tr>
                                    <th v-if="pregunta.datos[0].column1 !== 'null'">{{pregunta.datos[0].column1}}</th>
                                    <th v-if="pregunta.datos[0].column2 !== 'null'">{{pregunta.datos[0].column2}}</th>
                                    <th v-if="pregunta.datos[0].column3 !== 'null'">{{pregunta.datos[0].column3}}</th>
                                    <th v-if="pregunta.datos[0].column4 !== 'null'">{{pregunta.datos[0].column4}}</th>
                                    <th v-if="pregunta.datos[0].column5 !== 'null'">{{pregunta.datos[0].column5}}</th>
                                    <th v-if="pregunta.datos[0].column6 !== 'null'">{{pregunta.datos[0].column6}}</th>
                                    <th v-if="pregunta.datos[0].column6 !== 'null'">{{pregunta.datos[0].column6}}</th>
                                    <th v-if="pregunta.datos[0].column7 !== 'null'">{{pregunta.datos[0].column7}}</th>
                                    <th v-if="pregunta.datos[0].column8 !== 'null'">{{pregunta.datos[0].column8}}</th>
                                    <th v-if="pregunta.datos[0].column9 !== 'null'">{{pregunta.datos[0].column9}}</th>
                                    <th v-if="pregunta.datos[0].column10 !== 'null'">{{pregunta.datos[0].column10}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-0 m-0" v-for="n in pregunta.datos[0].numero_columnas" :key="n.index">
                                        <input type="text" name="" class="form-control p-0 m-0">
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>

                    <div v-else-if="pregunta.tipo_pregunta === 'pre_nota'">  
                    </div>

                    <div v-else>
                      
                    </div>
                </div>
                <hr class="bg-faded">
            </div>
        </div>
        <div v-else>
            <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                <h2 class="font-weight-bold text-center">No hay preguntas registradas</h2>
            </div>
        </div>

        <!-- Formulario de editar pregunta -->
        <div class="modal fade" id="updatePregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Actualizar pregunta</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Formualrios edit -->
                <EditAbierta :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_abierta'"></EditAbierta>
                <EditSimple :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_opcion_simple'"></EditSimple>
                <EditMultiple :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_opcion_multiple'"></EditMultiple>
                <EditDesplegable :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_desplegable'"></EditDesplegable>
                <EditEscala :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_escala'"></EditEscala>
                <EditArchivo :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_archivo'"></EditArchivo>
                <EditNota :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_nota'"></EditNota>
                <EditTabla :datos="editarDatos" v-if="editarDatos.tipo_pregunta === 'pre_tabla'"></EditTabla>

              </div>
              
            </div>
          </div>
        </div>

        <!-- Formularuios -->
        <formAbierta></formAbierta>
        <formSimple></formSimple>
        <formMultiple></formMultiple>
        <formDesplegable></formDesplegable>
        <formEscala></formEscala>
        <formArchivo></formArchivo>
        <formNota></formNota>
        <formTabla></formTabla>

    </div>
</template>

<script>
    import Vuex from 'vuex'
    export default {

        data(){
            return {
                editarDatos : [],
            }
        },
        computed: {
            ...Vuex.mapState(['encuesta', 'url_desing']) //Se mapea los States deL Store
        },

        created(){
            this.getDatosEncuesta($('#id_encuesta').val());  
        },

        methods: {

            //...Vuex.mapMutations(['llenarPreguntas']),
            ...Vuex.mapActions(['getDatosEncuesta']),

            eliminarPregunta(id) {
                const DATOS = {
                    id_pregunta : id,
                }
                
                var confirmar = confirm('Estas seguro de eliminara la pregunta');
                if (confirmar) {
                    axios.post(`${this.url_desing}/eliminar`, DATOS).then((result) => {            
                        
                        if(result.data === 'success'){
                            this.getDatosEncuesta($('#id_encuesta').val()); 
                        }
               
                    }).catch((err) => {
                        console.log(err);
                    });
                }else{

                }
            },

            getDatosPregunta(id) {
                axios.get(`${this.url_desing}/get/pregunta/`+ id)
                .then((result) => {

                    console.log(result.data);  
                    this.editarDatos = result.data;   

                }).catch((err) => {
                    console.log(err);
                });
            },

            cerrarModal(){  // metodo que cierra el modal
                this.editarDatos = [];
                $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
            }

        }
    }
</script>