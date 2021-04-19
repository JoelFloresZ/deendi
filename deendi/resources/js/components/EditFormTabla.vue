<template>
    <form method="POST" v-on:submit.prevent="editarPregunta" id="form_edit_pregunta_tabla">
        <div>
        <input type="hidden" name="id_encuesta"  v-model="id_encuesta">
        <input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_tabla">
        <input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_tabla">
        <input type="hidden" name="num_campos" v-model="num_campos">
        <input type="hidden" name="id_pregunta" :value="datos.id">
            
        <div class="form-group">
            <label id="pregunta">Pregunta:</label>
            <textarea name="pregunta" id="edit_pregunta" class="form-control" required="" >{{datos.pregunta}}</textarea>
        </div>   

             <div>
                <label>Opciones:</label>

                   <div >
                    <div class="row">
                        <div class="col-6" v-for="(opcion, index) in opciones" :key="index" v-html="opcion.input">
                            {{opcion.input}}
                        </div>                        
                    </div>
                </div>

                <div>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="addOpcionesSimple" @click="agregarCampos">
                        <i class="fa fa-plus"></i>
                    </button>
                     <button type="button" class="btn btn-outline-primary btn-sm" id="addOpcionesSimple" @click="eliminarCampo">
                         <i class="fa fa-minus"></i>
                     </button>
                </div>
                    

                <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal" v-on:click="cerrarModal()">CANCELAR</button>
                    <button type="submit" class="btn btn-primary border-button">ACTUALIZAR</button>
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
                lista_opciones: [],
                num_campos: 2
                
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
                var datos = $('#form_edit_pregunta_tabla').serialize();

                console.log(datos);
                axios.post('editar', datos).then((result) => {
                    console.log(result.data) 
                    if (result.data === 'success') {
                        $('.modal').modal('hide');
                        this.getDatosEncuesta($('#id_encuesta').val()); 
                    }               
               
                }).catch((err) => {
                    console.log(err);
                });
            },

            cargaListaDeOpciones() {
                console.log(this.lista_opciones.length);
                var opcion = this.lista_opciones;
                if (opcion.column1 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion1" id="opcion1" class="form-control mb-2" required value="${this.lista_opciones.column1}">`
                            }
                        );

                    
                }

                if (opcion.column2 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion2" id="opcion2" class="form-control mb-2" required value="${this.lista_opciones.column2}">`
                            }
                        );

                    
                }

                if (opcion.column3 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion3" id="opcion3" class="form-control mb-2" required value="${this.lista_opciones.column3}">`
                            }
                        );

                     
                }

                if (opcion.column4 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion4" id="opcion4" class="form-control mb-2" required value="${this.lista_opciones.column4}">`
                            }
                        );

                    
                }

                if (opcion.column5 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion5" id="opcion5" class="form-control mb-2" required value="${this.lista_opciones.column5}">`
                            }
                        );

                   
                }

                if (opcion.column6 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion6" id="opcion6" class="form-control mb-2" required value="${this.lista_opciones.column6}">`
                            }
                        );

                    
                }

                if (opcion.column7 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion7" id="opcion7" class="form-control mb-2" required value="${this.lista_opciones.column7}">`
                            }
                        );

                   
                }

                if (opcion.column8 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion8" id="opcion8" class="form-control mb-2" required value="${this.lista_opciones.column8}">`
                            }
                        );

                    
                }

                if (opcion.column9 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion9" id="opcion9" class="form-control mb-2" required value="${this.lista_opciones.column9}">`
                            }
                        );

                }

                if (opcion.column10 !== 'null') {
                    this.opciones.push(
                            {
                                input: `<input type="text" name="opcion10" id="opcion10" class="form-control mb-2" required value="${this.lista_opciones.column10}">`
                            }
                        );

                    
                }
            },

            agregarCampos(){        //Metodo que agrega los campos para las posibles opciones
                if(this.opciones.length < 10){
                    let num = this.opciones.length;
                    let i = num + 1
                    this.opciones.push({
                        input: `<input type="text" name="opcion${i}" id="opcion${i}" placeholder="Agrege su opcion" class="form-control mb-2" required>`
                    })

                    this.num_campos ++;
                    
                }
            },

            eliminarCampo(index){   //Metodo que elimina los campos para las posibles opciones
             if(this.opciones.length >= 3){
                this.opciones.splice(this.opciones.length - 1, 1);
             }
             this.num_campos--;
            },

            getDatosOpcionesPregunta(id_pregunta = 0){
                axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
                    console.log(result.data);
                    this.lista_opciones = result.data[0];   
                    this.num_campos = result.data[0].numero_columnas;              
                    this.cargaListaDeOpciones();
                    this.getDatosEncuesta($('#id_encuesta').val()); 

                }).catch((err) => {
                    console.log(err);
                });
            },

            

            cerrarModal(){  // metodo que cierra el modal
                $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
            }

        }
    }

</script>