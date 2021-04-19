<template>
	<div>
		<form method="POST" v-on:submit.prevent="editarPregunta" id="form_pregunta_escala">
		<input type="hidden" name="id_encuesta"  v-model="id_encuesta">
		<input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_escala">
		<input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_escala">
		<input type="hidden" name="id_pregunta" :value="datos.id">
	        <div class="form-group">
	        	<label id="pregunta">Pregunta:</label>
	        	<textarea name="pregunta" id="pregunta" class="form-control" required="">{{datos.pregunta}}</textarea>
	        </div>

	       

	        <div>   
            	<hr>
                <label for="customRange2">Seleccione un rango  <span class="badge badge-primary p-1">{{rango}}</span></label>
                <input type="range" class="custom-range" name="rango" min="1" max="10" id="rango" v-model="rango"> 
                <div class="d-flex justify-content-between">
                    <span>Min</span>
                    <span>Max</span>
                </div>  
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
    			rango:0,
    			id_encuesta: 0,
    			pregunta:''
    		}
    	},

    	 created(){
            this.id_encuesta = $('#id_encuesta').val();
            this.getDatosOpcionesPregunta(this.datos.id);
            
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
        	
        	...Vuex.mapActions(['getDatosEncuesta']),

        	editarPregunta() {
                var datos = $('#form_pregunta_escala').serialize();
               /* console.log(DATOS);*/
               
                axios.post('editar', datos).then((result) => {
                    if (result.data = "success") {
                        
                        $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
                        this.getDatosEncuesta($('#id_encuesta').val()); 
                    }                   
               
                }).catch((err) => {
                    console.log(err);
                });
            },  

        	getDatosOpcionesPregunta(id_pregunta = 0){
                axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
                    console.log(result.data);
                    this.rango = result.data.length; 

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