<template>
    <form method="POST" v-on:submit.prevent="editarPregunta">
        <div>
         <input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_abierta">
        <div class="form-group">
            <label id="pregunta">Pregunta:</label>
            <textarea name="edit_pregunta" id="edit_pregunta" class="form-control" required="">{{datos.pregunta}}</textarea>
        </div>   

         <div>
            <label>Tipo de respuesta:</label>
            <select name="tipoResPregunta" id="tipoResPregunta" class="custom-select" required="">
                <div v-if="datos.tipo_respuesta === 'corta'">
                    <option value="Corta">Corta</option>
                </div>
                <div v-else>
                    <option value="Párrafo">Párrafo</option>
                </div>
                <option value="Corta">Corta</option>
                <option value="Párrafo">Párrafo</option>
            </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary border-button">Actualizar</button>
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
                pregunta: '',
                tipo_res_pregunta: ''
            }
        },
        
        methods: {
            
            ...Vuex.mapActions(['getDatosEncuesta']),


            editarPregunta(){
                const DATOS = {
                    id_pregunta: this.datos.id ,
                    tipoResPregunta: $('#tipoResPregunta').val(),
                    tipo_pregunta: 'pre_abierta',
                    pregunta: $('#edit_pregunta').val()
                }

                
                axios.post('editar', DATOS).then((result) => {
                    if (result.data === 'success') {
                        this.getDatosEncuesta($('#id_encuesta').val());
                        $('.modal').modal('hide');
                    }                  
               
                }).catch((err) => {
                    console.log(err);
                });
            },
        },

        cerrarModal(){  // metodo que cierra el modal
           
            $('.modal').modal('hide'); //Oculta el modal del formulario para agregar preguntas
        }
    }

</script>