<template>
	<div>
		<form method="POST" v-on:submit.prevent="editarPregunta">
		<input type="hidden" name="id_encuesta"  v-model="id_encuesta">
		<input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_archivo">
		<input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_archivo">
		<input type="hidden" name="id_pregunta" :value="datos.id">
		<input type="hidden" name="id_datos_archivo" :value="tipo_archivo.id">
		
		<div class="form-group">
		<label id="pregunta">Pregunta:</label>
		<textarea name="pregunta" id="pregunta" class="form-control" required="" v-model="pregunta"></textarea>
		</div>

			<div>
				<label>Tipo de formato:</label>
				<select name="tipo_archivo" id="tipo_archivo" class="custom-select">
                    <option :value="tipo_archivo.tipo_formato" v-if="tipo_archivo.tipo_formato === '*'">Todos los formatos</option>
					<option :value="tipo_archivo.tipo_formato" v-else>{{tipo_archivo.tipo_formato }}</option>
					<option value="*">Todos los formatos</option>
					<option value="PNG">PNG</option>
					<option value="JPG">JPG</option>
					<option value="JPEG">JPEG</option>
				</select>
			</div>

			<div class="modal-footer mt-2">
				<button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal" v-on:click="cerrarModal()">Cancelar</button>
				<button type="submit" class="btn btn-primary border-button">Actualizar</button>
			</div>
		</form>
	</div>
</template>

<script>
	import Vuex from 'vuex'
    export default {
    	props:['datos'],
    	data(){
    		return {
    			pregunta: '',
    			id_encuesta: 0,
    			tipo_archivo: []

    		}
    	},

    	created(){
            this.id_encuesta = $('#id_encuesta').val();
            this.pregunta = this.datos.pregunta
            this.getDatosOpcionesPregunta(this.datos.id);            
        },
       
        methods: {
        	
        	...Vuex.mapActions(['getDatosEncuesta']),

        	editarPregunta(){
        		var datos = {
        			id_encuesta: $('#id_encuesta').val(),
        			tipoResPregunta: $('#tipoResPregunta').val(),
        			tipo_formato: $('#tipo_archivo').val(),
        			tipo_pregunta: 'pre_archivo',
        			pregunta: this.pregunta,
        			id_pregunta: this.datos.id,
        			id_datos_archivo: this.tipo_archivo.id
        		}
        		console.log(datos)
        		axios.post('editar', datos).then((result) => {
                    if (result.data = "success") {
                        
                        $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
                        this.getDatosEncuesta($('#id_encuesta').val()); 
                        //this.$destroy();
                    }                   
               
                }).catch((err) => {
                    console.log(err);
                });
        	},

        	getDatosOpcionesPregunta(id_pregunta = 0){
                axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
                    console.log(result.data);
                    this.tipo_archivo = result.data[0]; 

                }).catch((err) => {
                    console.log(err);
                });
            },

        	cerrarModal(){  // metodo que cierra el modal
	            this.pregunta = '';
	            $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
                //this.$destroy();
	        }
        },

        destroyed() {
            console.log('adios');
        }


    }
</script>