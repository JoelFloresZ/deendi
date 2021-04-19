<template>
	<div>
		<form method="POST" v-on:submit.prevent="agregarPregunta">
		
		<!-- Modal -->
		<div class="modal fade" id="form-archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header bg-primary">
		        <h5 class="modal-title text-white" id="exampleModalCenterTitle">Agregar pregunta</h5>
		        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	
		      	<input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_archivo">
		        <div class="form-group">
		        	<label id="pregunta">Pregunta:</label>
		        	<textarea name="pregunta" id="pregunta" class="form-control" autofocus="" required="" v-model="pregunta"></textarea>	
		        </div>

		        <div>
		        	<label>Tipo de formato:</label>
		        	<select name="tipo_archivo" id="tipo_archivo" class="custom-select">
						<option value="*">Todos los formatos</option>
						<option value="PNG">PNG</option>
						<option value="JPG">JPG</option>
						<option value="JPEG">JPEG</option>
					</select>
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
        			tipoResPregunta: 'pre_archivo',
        			tipo_pregunta: 'pre_archivo',
        			tipo_archivo: $('#tipo_archivo').val(),
        			pregunta: this.pregunta
        		}

        		axios.post(`${this.url_desing}/guardar`, DATOS).then((result) => {
        			if (result.data === "success") {
        				this.pregunta = "";
        				$('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
        				this.getDatosEncuesta($('#id_encuesta').val()); 
        			}if (result.data === "existe"){
                        swal("Alerta!", "No se pudo registrar la pregunta, porque su encuesta cuenta uno con el mismo título.", "warning");
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