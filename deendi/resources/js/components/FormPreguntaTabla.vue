<template>

    <form method="POST" action="" id="form_pregunta_tabla" v-on:submit.prevent="registraPregunta">
   
    <!-- Modal -->
    <div class="modal fade" id="form-tabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalCenterTitle">Agregar pregunta</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="mb-2" id="alerta-tabla">
            </div>
            <input type="hidden" name="id_encuesta" v-model="id_encuesta">
            <input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_tabla">
            <input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_tabla">
            <input type="hidden" name="num_campos" v-model="num_campos">
            
            <div class="form-group">
                <label id="pregunta">Pregunta:</label>
                <textarea name="pregunta" id="pregunta" class="form-control" rows="1" required=""></textarea>
            </div>

            <div>   
                <hr>
                <div class="row">
                   <div class="col-6" v-for="(opcion, index) in opciones" :key="index" v-html="opcion.input">                        
                        {{opcion.input}}
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
                opciones:[              //Objeto que agrega campos para las posibles opciones
                    {input: `<input type="text" name="opcion1" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required>`},
                    {input: `<input type="text" name="opcion2" id="opcion2" placeholder="Agrege su opcion" class="form-control mb-2" required>`}
                ],
                id_encuesta: 0,
                num_campos: 2
            }
        },

        computed: {
            ...Vuex.mapState(['url_desing']) //Se mapea los States deL Store
        },

        created(){
            this.id_encuesta = $('#id_encuesta').val();  
        },


        methods: {

            ...Vuex.mapActions(['getDatosEncuesta']),

            agregarCampos(){        //Metodo que agrega los campos para las posibles opciones
                if(this.opciones.length < 10){
                    let num = this.opciones.length;
                    let i = num + 1
                    this.opciones.push({
                        input: `<input type="text" name="opcion${i}" id="opcion${i}" placeholder="Agrege su opcion" class="form-control mb-2" required>`
                    })

                    this.num_campos++;
                }
            },

            eliminarCampo(index){   //Metodo que elimina los campos para las posibles opciones
             if(this.opciones.length >= 3){
                this.opciones.splice(this.opciones.length - 1, 1);
             }
             this.num_campos--;
            },

            registraPregunta() {

               var datos = $('#form_pregunta_tabla').serialize();
                                       
                    axios.post(`${this.url_desing}/guardar`, datos).then((result) => {
                        console.log(result.data);
                        if (result.data === "success") {
                            datos = '';
                            $('#pregunta').val('');
                            this. opciones = [              //Objeto que agrega campos para las posibles opciones
                                {input: ` <input type="text" name="opcion1" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required>`},
                                {input: `<input type="text" name="opcion2" id="opcion2" placeholder="Agrege su opcion" class="form-control mb-2" required>`}
                            ];

                            
                            $('#pregunta').val('');    

                            $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
                            this.getDatosEncuesta($('#id_encuesta').val()); 

                        } if (result.data === "existe"){
                            swal("Alerta!", "No se pudo registrar la pregunta, porque su encuesta cuenta uno con el mismo título.", "warning");
                        }                   
                   
                    }).catch((err) => {
                        console.log(err);
                    }); 
            }  
        }
    }

</script>