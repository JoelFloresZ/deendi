<template>
    <form method="POST" v-on:submit.prevent="editarPregunta" id="form_edit_pregunta_simple">
        <div>
         <input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_opcion_multiple">
         <input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_simple">
         <input type="hidden" name="id_encuesta"  v-model="id_encuesta">
         <input type="hidden" name="id_pregunta" :value="datos.id">
            
        <div class="form-group">
            <label id="pregunta">Pregunta:</label>
            <textarea name="pregunta" id="edit_pregunta" class="form-control" required="">{{datos.pregunta}}</textarea>
        </div>   

             <div>
                <label>Opciones:</label>

                   <div v-for="(opcion, index) in opciones" :key="index">
                    <div class="row">
                        <div class="col-lg-10"  v-html="opcion.input">
                            {{opcion.input}}
                            {{opcion.id}}
                        </div>
                        <div class="col-lg-2">
                            <div class="col-1" v-if="opciones.length > 2">
                                <div v-if="opcion.id !== 0">
                                    <a @click="quitarCampos(opcion.id, true)" class="tooltip-test text-gray-dark h5 mt-1" title="Eliminar Campo">
                                        <i class="fa fa-minus-circle" style="cursor: pointer;"></i>
                                    </a>
                                </div>
                                <div v-if="opcion.id === 0">
                                    <a @click="quitarCampos(index, false)" class="tooltip-test text-gray-dark h5 mt-1" title="Eliminar Campo">
                                        <i class="fa fa-minus-circle" style="cursor: pointer;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="button" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center" id="addOpcionesSimple" @click="agregarCampos"><i class="fa fa-plus-circle text-info h5"></i></button>
                </div>
                    

                <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal" v-on:click="cerrarModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary border-button">Actualizar</button>
                </div> 
            </div>
        </div>  
    </form>
</template>

<script>
     import Vuex from 'vuex'
    export default {
        props:['datos'],

        data() {
            return {
                id_encuesta: 0,
                pregunta: '',
                opciones:[],             //Objeto que agrega campos para las posibles opciones
                lista_opciones: []
                
            }
        },
        
        created(){
            this.id_encuesta = $('#id_encuesta').val();
            this.getDatosOpcionesPregunta(this.datos.id);
            
        },

        computed: {
           /* ...Vuex.mapState(["lista_opciones"]) //Se mapea los States deL Store*/
        },

        methods: {
            
            ...Vuex.mapActions(['getDatosEncuesta','getDatosOpcionesPregunta']),

            editarPregunta(){
                var datos = $('#form_edit_pregunta_simple').serialize();

                console.log(datos);
                axios.post('editar', datos).then((result) => {
                    console.log(result.data) 
                    if (result.data === 'success') {
                        $('.modal').modal('hide');
                        this.getDatosEncuesta($('#id_encuesta').val());
                        this.opciones = [];
                        this.lista_opciones = []; 
                        this.getDatosOpcionesPregunta(this.datos.id);
                    }               
               
                }).catch((err) => {
                    console.log(err);
                });
            },

            cargaListaDeOpciones() {
                console.log(this.lista_opciones.length);

                for (var i = 0; i < this.lista_opciones.length; i++) {
                    this.opciones.push(
                        {input: `<input type="text" name="opcion[]" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required value="${this.lista_opciones[i].opcion}"> <input type="hidden" name="ids[]" id="opcion_id${i}" value="${this.lista_opciones[i].id}">`, 
                            id: this.lista_opciones[i].id,

                        }
                        );
                }
            },

            agregarCampos(){ //Metodo que agrega los campos para las posibles opciones
                if(this.opciones.length <= 9){
                    let num = this.opciones.length;
                    let i = num + 1
                    this.opciones.push({
                        input: `<input type="text" name="opcion[]" id="opcion${i}" placeholder="Agrege su opcion" class="form-control mb-2" required> <input type="hidden" name="ids[]" id="opcion_id${i}" value="insert">`,
                        id: 0,
                    })
                }
            },

            getDatosOpcionesPregunta(id_pregunta = 0){
                axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
                    this.lista_opciones = result.data;                 
                    this.cargaListaDeOpciones(); 
                    this.getDatosEncuesta($('#id_encuesta').val()); 

                }).catch((err) => {
                    console.log(err);
                });
            },

            quitarCampos(id = 0, accion = false){
                /* true => elimina la opcion
                    false => quita la opcion de la lista
                */
                if (accion) {
                    axios.get('eliminar/opcion/' + id).then((result) => {
                        if (result.data === 'success') {
                            this.opciones = [];
                             this.getDatosOpcionesPregunta(this.datos.id);
                        }

                }).catch((err) => {
                    console.log(err);
                });
                }else{
                    
                    this.opciones.splice(id, 1);
                }
            },

            cerrarModal(){  // metodo que cierra el modal
                //this.getDatosEncuesta($('#id_encuesta').val());
                this.opciones = [];
                this.lista_opciones = []; 
                this.getDatosOpcionesPregunta(this.datos.id);
                $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas

            }

        }
    }

</script>