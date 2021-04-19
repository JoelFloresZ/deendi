<template>

    <form method="POST" action="" id="form_pregunta_escala" v-on:submit.prevent="registraPregunta">
   
    <!-- Modal -->
    <div class="modal fade" id="form-escala" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            <input type="hidden" name="tipo_pregunta" id="tipo_pregunta" value="pre_escala">
            <input type="hidden" name="tipoResPregunta" id="tipoResPregunta" value="pre_escala">
            
            <div class="form-group">
                <label id="pregunta">Pregunta:</label>
                <textarea name="pregunta" id="pregunta" class="form-control" required rows="1" v-model="pregunta"></textarea>
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
                rango: 1,
                id_encuesta: 0
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


            registraPregunta() {
                const DATOS = $('#form_pregunta_escala').serialize();
               /* console.log(DATOS);*/
               
                axios.post(`${this.url_desing}/guardar`, DATOS).then((result) => {
                    if (result.data === "success") {
                        this.pregunta = "";
                        this.rango = 1;
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