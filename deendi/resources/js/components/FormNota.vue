<template>
	<div>
		<form method="POST" v-on:submit.prevent="agregarPregunta">
		
		<!-- Modal -->
		<div class="modal fade" id="form-nota" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header bg-primary">
		        <h5 class="modal-title text-white" id="exampleModalCenterTitle">Agregar pregunta</h5>
		        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	
		      	<input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_nota">
		        <div class="form-group">
		        	<label id="pregunta">Nota:</label>
		        	<textarea name="pregunta" id="pregunta" class="form-control" required="" rows="4" v-model="pregunta"></textarea>
		        </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal" v-on:click="cerrarModal()">Cancelar</button>
		        <button type="submit" class="btn btn-primary border-button">Agregar</button>
		      </div>
		    </div>
		  </div>
		</div>
		</form>
	</div>
</template>

<script>
	import Vuex from 'vuex'
    export default {
    	data(){
    		return {
    			pregunta: '',
    		}
    	},
		computed: {
            ...Vuex.mapState(['url_desing']) //Se mapea los States deL Store
        },
        mounted() {
           
        },

        methods: {
        	
        	...Vuex.mapActions(['getDatosEncuesta']),

        	agregarPregunta(){
        		const DATOS = {
        			id_encuesta: $('#id_encuesta').val(),
        			tipoResPregunta: 'nota',
        			tipo_pregunta: 'pre_nota',
        			pregunta: this.pregunta
        		}

        		axios.post(`${this.url_desing}/guardar`, DATOS).then((result) => {
        			if (result.data === "success") {
        				this.pregunta = "";
        				$('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
        				this.getDatosEncuesta($('#id_encuesta').val()); 
        			}if (result.data === "existe"){
                        swal("Alerta!", "La pregunta no se pudo agregar ya que tiene registrado uno con el mismo nombre!", "warning");
                    } 	                
               
                }).catch((err) => {
                    console.log(err);
                });
        	},

        	cerrarModal(){  // metodo que cierra el modal
	            this.pregunta = '';
	            $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
	        }
        }


    }
</script>