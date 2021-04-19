<template>

    <form method="POST" action="" id="form_pregunta_simple" v-on:submit.prevent="registraPregunta">
   
    <!-- Modal -->
    <div class="modal fade" id="form-simple" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalCenterTitle">Agregar pregunta</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_encuesta" v-model="id_encuesta">
            <input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_opcion_simple">
            <input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_simple">
            
            <div class="form-group">
                <label id="pregunta">Pregunta:</label>
                <textarea name="pregunta" id="pregunta" class="form-control" required="" rows="1" v-model="pregunta"></textarea>
            </div>

            <div>   
                <hr>
                <div v-for="(opcion, index) in opciones" :key="index">
                    <div class="row">
                        <div class="col-lg-10"  v-html="opcion.input">
                            {{opcion.input}}
                        </div>
                        <div class="col-lg-2">
                            <div class="col-1" v-if="opciones.length > 2">
                                <a @click="eliminarCampo(index)" class="tooltip-test text-gray-dark h5 mt-1" title="Eliminar Campo">
                                    <i class="fa fa-minus-circle" style="cursor: pointer;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>  
                <div>
                    <button type="button" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center" id="addOpcionesSimple" @click="agregarCampos"><i class="fa fa-plus-circle text-info h5"></i></button>
                </div>   
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary border-button">Agregar</button>
          </div>
        </div>
      </div>
    </div>
</form>
    
</template>

<script>
    import Vuex from 'vuex'
    export default {

        data() {
            return {
                pregunta: '',
                opciones:[              //Objeto que agrega campos para las posibles opciones
                    {input: `<input type="text" name="opcion[]" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required>`},
                    {input: `<input type="text" name="opcion[]" id="opcion2" placeholder="Agrege su opcion" class="form-control mb-2" required>`}
                ],
                id_encuesta: 0
            }
        },
        computed: {
            ...Vuex.mapState(['url_desing']) //Se mapea los States deL Store
        },


        created(){
            this.id_encuesta = $('#id_encuesta').val();  
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {

            ...Vuex.mapActions(['getDatosEncuesta']),

            agregarCampos(){        //Metodo que agrega los campos para las posibles opciones
                if(this.opciones.length <= 9){
                    let num = this.opciones.length;
                    let i = num + 1
                    this.opciones.push({
                        input: `<input type="text" name="opcion[]" id="opcion${i}" placeholder="Agrege su opcion" class="form-control mb-2" required>`
                    })
                }
            },

            eliminarCampo(index){   //Metodo que elimina los campos para las posibles opciones
             if(this.opciones.length >= 3){
                this.opciones.splice(index, 1);
             }
            },

            registraPregunta() {
                var datos = $('#form_pregunta_simple').serialize();
                console.log(datos);
               
                axios.post(`${this.url_desing}/guardar`, datos).then((result) => {
                    if (result.data === "success") {
                        datos = '';
                        $('#pregunta').val('');
                        this. opciones = [              //Objeto que agrega campos para las posibles opciones
                            {input: `<input type="text" name="opcion[]" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required>`},
                            {input: `<input type="text" name="opcion[]" id="opcion2" placeholder="Agrege su opcion" class="form-control mb-2" required>`}
                        ];

                        $('#opcion1').val('');
                        $('#opcion2').val('');    

                        $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
                        this.getDatosEncuesta($('#id_encuesta').val()); 

                    }if (result.data === "existe"){
                        swal("Alerta!", "No se pudo registrar la pregunta, porque su encuesta cuenta uno con el mismo título.", "warning");
                    }                   
               
                }).catch((err) => {
                    console.log(err);
                });
            }  
        }
    }

</script>