<template>
    <div>
        <hr>
        
        <div v-for="(opcion, index) in opciones" :key="index">
            <div class="row">
                <div class="col-lg-10"  v-html="opcion.input">
                    {{opcion.input}}
                </div>
                <div class="col-lg-2">
                    <div class="col-1" v-if="opciones.length > 2">
                        <a @click="eliminarCampo(index)" class="tooltip-test text-danger h5 mt-1" title="Eliminar Campo">
                            <i class="icon icon-bin2">X</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>  
        <div>
            <button type="button" class="btn btn-outline-primary btn-sm" id="addOpcionesSimple" @click="agregarCampos">Add</button>
        </div>          
    </div>
</template>

<script>
    export default {

        data() {
            return {
                opciones:[              //Objeto que agrega campos para las posibles opciones
                    {input: `<input type="text" name="opcion[]" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required>`},
                    {input: `<input type="text" name="opcion[]" id="opcion2" placeholder="Agrege su opcion" class="form-control mb-2" required>`}
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods: {
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
        }
    }

</script>