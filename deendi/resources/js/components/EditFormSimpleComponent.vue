<template>
    <div>
        <hr>
        
        {{opcionesDePregunta}}         
    </div>
</template>

<script>
    export default {

        data() {
            return {
                opciones:[              //Objeto que agrega campos para las posibles opciones
                    {input: `<input type="text" name="opcion[]" id="opcion1" placeholder="Agrege su opcion" class="form-control mb-2" required>`},
                    {input: `<input type="text" name="opcion[]" id="opcion2" placeholder="Agrege su opcion" class="form-control mb-2" required>`}
                ],
                opcionesDePregunta: [],
                activar_opcion_otra: false,
                datosOpcionOtra:{
                    opcion_otra: 'Otra (Especifique)',
                    id: null
                },

               camposDeOpciones:[]
            }
        },

        created(){
            
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

            //Metodo que obtine los datos de la pregunta por ID
            getDatosPregunta(){
                const URL = '/get/pregunta/' + document.getElementById('id_pregunta').value;       //URL para obtner datos
                //Peticion HTTP al servidor
                axios.get(URL).then((result) => {

                    console.log(result.data.pre_multiple);
                    

                    this.opcionesDePregunta = result.data.pre_multiple;
                    let contadorOpciones = result.data.pre_multiple.length;

                    //Loop que valida y verifica si dentra de la pregunta existe la opcion Otra para ingresar texto
                    //Si es asi muestra el campo para activarlo o desactivarlo

                    for (let index = 0; index < contadorOpciones; index++) {
                        if(result.data.pre_multiple[index].opcion_otra == 'no'){
                            this.activar_opcion_otra = false;
                        }else{
                            this.activar_opcion_otra = true;
                            this.datosOpcionOtra.opcion_otra = result.data[0].opciones[index].opcion;
                            this.datosOpcionOtra.id = result.data[0].opciones[index].id;
                        }
                        
                    }

                    this.camposOpciones();

                }).catch((err) => {
                    console.log(err);
                });
            },

            addOpcion(){ //Metodo para agregar otra opcion a la pregunta correspondiente
                const x = this.camposDeOpciones.length;    //Contador de campos de opciones agregados
                console.log(x);
                this.camposDeOpciones.push({
                    input:`<input type="text" name="opcion${x+1}" id="opcion${x+1}" placeholder="Agrege su opcion" value="" class="form-control mb-2" required>
                    <input type="hidden" id="id${x+1}" value="add">`,
                    opcion_id: 'delete'

            })
        },
        }
    }

</script>