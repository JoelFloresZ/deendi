<template>
	<div>
		<form method="POST" v-on:submit.prevent="agregarPregunta">
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header bg-primary">
		        <h5 class="modal-title text-white" id="exampleModalCenterTitle">Agregar pregunta</h5>
		        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	
		      	<input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_abierta">
		        <div class="form-group">
		        	<label id="pregunta">Pregunta:</label>
		        	<textarea name="pregunta" id="pregunta" class="form-control" autofocus="" v-model="pregunta" required=""></textarea>
		        </div>

		        <div>
		        	<label>Tipo de respuesta:</label>
		        	<select name="tipoResPregunta" id="tipoResPregunta" class="custom-select" required>
						<option value="" selected>Seleccione tipo de respuesta</option>
						<option value="Corta">Corta</option>
						<option value="Párrafo">Párrafo</option>
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
        
        methods: {
        	
        	...Vuex.mapActions(['getDatosEncuesta']),

        	agregarPregunta(){
        		const DATOS = {
        			id_encuesta: $('#id_encuesta').val(),
        			tipoResPregunta: $('#tipoResPregunta').val(),
        			tipo_pregunta: 'pre_abierta',
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