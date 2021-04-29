<template>
    <div class="card p-4 shadow w-100" >
        <div class="mt-2">
            <h5 class="font-weight-bold">{{encuesta.titulo}}</h5>
            <p class="font-weight-normal">{{encuesta.descripcion}}</p>

            <hr class="bg-primary">
            <div v-for="(pregunta,index) in preguntas" :key="index">
                <label class="font-weight-bold">{{pregunta.pregunta}} <span class="h5 ml-1 text-primary">*</span></label>

                <div v-if="pregunta.tipo_pregunta === 'pre_abierta'">
                    <div class="alert alert-info p-2">
                        <label>{{pregunta.resultado[0].respuesta}}</label>
                    </div>
                </div>

                <div v-if="pregunta.tipo_pregunta === 'pre_opcion_simple'">
                    <div v-for="opcion in pregunta.resultado">
                        <div class="custom-control custom-radio" v-bind:class="{'text-primary font-weight-bold': opcion.respondido }">
                          <input type="radio" :name="index" class="custom-control-input" disabled="" v-if="opcion.respondido === 'disabled'">
                          <input type="radio" :name="index" class="custom-control-input" checked="" v-else>
                          <label class="custom-control-label">{{ opcion.opcion }}</label>
                        </div>
                    </div>
                </div>

                <div v-if="pregunta.tipo_pregunta === 'pre_opcion_multiple'">
                    <div v-for="opcion in pregunta.resultado">
                        <div class="custom-control custom-checkbox" v-bind:class="{'text-primary font-weight-bold': opcion.respondido }">
                            <input type="checkbox" class="custom-control-input" disabled="" v-if="opcion.respondido === 'disabled'">
                            <input type="checkbox" class="custom-control-input" checked="" v-else>
                            <label class="custom-control-label">{{ opcion.opcion }}</label>
                        </div>
                    </div>
                </div>

                <div v-if="pregunta.tipo_pregunta === 'pre_desplegable'">
                    <select class="custom-select">
                        <option v-for="opcion in pregunta.resultado" v-if="opcion.respondido != 'disabled'" selected="">{{ opcion.opcion }}</option>
                        <option v-for="opcion in pregunta.resultado" v-if="opcion.respondido === 'disabled'" disabled="">{{ opcion.opcion }}</option>
                    </select>
                </div>

                <div v-if="pregunta.tipo_pregunta === 'pre_escala'">
                    <div v-for="opcion in pregunta.resultado">
                        <div class="custom-control custom-radio" v-bind:class="{'text-primary font-weight-bold': opcion.respondido }">
                          <input type="radio" :name="index+ opcion.num_encuesta_aplicado" class="custom-control-input" disabled="" v-if="opcion.respondido === 'disabled'">
                          <input type="radio" :name="index+ opcion.num_encuesta_aplicado" class="custom-control-input" checked="" v-else>
                          <label class="custom-control-label">{{ opcion.valor }}</label>
                        </div>
                    </div>
                </div>

                <div v-if="pregunta.tipo_pregunta === 'pre_archivo'">
                    <div v-for="archivo in pregunta.resultado">
                        <a :href="archivo.imagen" data-lightbox="roadtrip" :data-title="archivo.nombre_img">
                            <figure>
                                <img :src="archivo.imagen" class="img-fluid w-25 h-25">
                            </figure>
                        </a>
                    </div>
                </div>

                <div v-if="pregunta.tipo_pregunta === 'pre_tabla'">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th v-if="pregunta.resultado[0].column1 !== 'null'">{{pregunta.resultado[0].column1}}</th>
                                <th v-if="pregunta.resultado[0].column2 !== 'null'">{{pregunta.resultado[0].column2}}</th>
                                <th v-if="pregunta.resultado[0].column3 !== 'null'">{{pregunta.resultado[0].column3}}</th>
                                <th v-if="pregunta.resultado[0].column4 !== 'null'">{{pregunta.resultado[0].column4}}</th>
                                <th v-if="pregunta.resultado[0].column5 !== 'null'">{{pregunta.resultado[0].column5}}</th>
                                <th v-if="pregunta.resultado[0].column6 !== 'null'">{{pregunta.resultado[0].column6}}</th>
                                <th v-if="pregunta.resultado[0].column7 !== 'null'">{{pregunta.resultado[0].column7}}</th>
                                <th v-if="pregunta.resultado[0].column8 !== 'null'">{{pregunta.resultado[0].column8}}</th>
                                <th v-if="pregunta.resultado[0].column9 !== 'null'">{{pregunta.resultado[0].column9}}</th>
                                <th v-if="pregunta.resultado[0].column10 !== 'null'">{{pregunt.resultadoa[0].column10}}</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="res in pregunta.resultado[0].resultado_tabla">
                                    <td v-if="res.column1 !== 'null'">{{res.column1}}</td>
                                    <td v-if="res.column2 !== 'null'">{{res.column2}}</td>
                                    <td v-if="res.column3 !== 'null'">{{res.column3}}</td>
                                    <td v-if="res.column4 !== 'null'">{{res.column4}}</td>
                                    <td v-if="res.column5 !== 'null'">{{res.column5}}</td>
                                    <td v-if="res.column6 !== 'null'">{{res.column6}}</td>
                                    <td v-if="res.column7 !== 'null'">{{res.column7}}</td>
                                    <td v-if="res.column8 !== 'null'">{{res.column8}}</td>
                                    <td v-if="res.column9 !== 'null'">{{res.column9}}</td>
                                    <td v-if="res.column10 !== 'null'">{{res.column10}}</td>
                                </tr>
                            </tbody>
                    </table>
                </div>

                <hr class="bg-faded">
            </div>
            <!-- {{preguntas}} -->
        </div>

        <nav aria-label="Page navigation example" class="mb-3">
          <ul class="pagination justify-content-center">
            <li v-bind:class="{ 'page-item':li, 'disabled':previos }">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click="PreviousPage()">Atras</a>
            </li>

            <li class="page-item" v-for="n in total_de_paginas_mostrar">
                <a class="page-link" href="#" @click="mostrarPagina(encuesta.resultados, n)">{{n +1}}</a>
            </li>

            <li v-bind:class="{ 'page-item':li, 'disabled':next }">
              <a class="page-link" href="#" @click="nextPage()">Siguiente</a>
            </li>
          </ul>
        </nav>

    </div>
</template>

<script>
    import Vuex from 'vuex'
    export default {

        data(){
            return {
                encuesta_id: '',
                datos_encuesta: [],
                encuesta:[],
                preguntas: [],
                total_paginas:0,
                pagina:8,
                pagina_actual: 0,
                total_de_paginas_mostrar: [],
                previos: true,
                next : false,
                li: true
            }
        },

        created(){
            this.getDatosEncuesta($('#id_encuesta').val());
        },

        methods: {

            getDatosEncuesta(id_pregunta = 0){
                axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
                    console.log(result.data);
                    this.total_paginas = result.data[0].resultados.length;
                    this.encuesta = result.data[0];

                    var x = 0;
                    while (x < 8) {
                        if (x < result.data[0].resultados.length) {
                            this.total_de_paginas_mostrar.push(x);
                        }

                        x++;
                    }

                    if (this.total_paginas < 8) {
                        this.next = true;
                        this.pagina_actual = x;

                    }

                    this.mostrarPagina(this.encuesta.resultados, 0);

                }).catch((err) => {
                    console.log(err);
                });
            },

            mostrarPagina(datos, pagina){

                this.preguntas = datos[pagina]

            },

            nextPage(){

                if (this.total_paginas > this.pagina) {
                    var x = this.pagina_actual +1;
                    var quitar_pagina = this.total_de_paginas_mostrar.length - 2;
                    this.total_de_paginas_mostrar.splice(0 , 1);
                    this.total_de_paginas_mostrar.push(this.total_de_paginas_mostrar[quitar_pagina]+1);
                    this.previos = false;
                    this.pagina ++;
                }else{
                    this.next = true;
                    this.previos = false;
                }

            },

            PreviousPage(){

                if (this.pagina > 8) {
                    var arrTotalPage = this.total_de_paginas_mostrar.length;

                    for (let index = 0; index < arrTotalPage; index++) {
                        //var posicionNubers = arrTotalPage - 1;
                        this.total_de_paginas_mostrar.splice(index, 1, this.total_de_paginas_mostrar[index] - 1);
                    }
                     this.pagina --;
                }else{
                    this.previos = true;
                    this.next = false;
                }


            }
        }
    }
</script>
