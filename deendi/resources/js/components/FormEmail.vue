<template>
    <div>
        <div class="form-group">
            <label>Seleccione tipo de envío</label>
            <select class="form-control" name="tipo_de_envio" required="">
                <optgroup>
                    <option selected="">Seleccione una opción</option>
                    <option value="plataforma">Usuario de la plataforma</option>
                    <option value="correo">Correo electrónico</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label>Enviar a:</label>
            <select class="form-control" v-model="metodo_de_envio" name="usuario" required="">
                <optgroup>
                    <option selected="">Seleccione una opción</option>
                    <option value="usuario">Usuario</option>
                    <option value="grupo">Grupo</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group" v-if="metodo_de_envio === 'usuario'">
            <label>Correo electrónico</label>
            <input type="email" name="correo" placeholder="Correo electrónico" class="form-control" required="">
        </div>

        <div class="form-group"  v-if="metodo_de_envio === 'grupo'">
            <label>Seleccione un grupo</label>
            <select class="form-control" name="grupo" required="">
                <optgroup>
                    <option selected="">Seleccione un grupo</option>
                    <option v-for="grupo in grupos" :value="grupo.id">{{grupo.nombre}}</option>
                </optgroup>
            </select>
        </div>

        <div class="form-group">
            <label>Mensaje</label>
            <textarea class="form-control" rows="3" name="mensaje" required></textarea>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                tipo_de_envio: '',
                metodo_de_envio: 'Seleccione una opción',
                grupos: []
            }
        },

        created(){
            this.getGrupos($('#encuesta_id').val());
        },
        methods: {
            getGrupos(id) {
                axios.get('obtener/grupos/'+ id)
                .then((result) => {
                    console.log(result.data);
                    this.grupos = result.data;

                }).catch((err) => {
                    console.log(err);
                });
            }
        }


    }
</script>
