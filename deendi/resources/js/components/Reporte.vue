<template>
    <div class="p-4 w-100" >
        <div v-for="dato in encuesta">
            <h5 class="font-weight-bold">{{dato.titulo}}</h5>
            <p class="font-weight-normal">{{dato.descripcion}}</p>
            <hr class="bg-primary">
        </div>
        
        <div v-for="pregunta in resultados">
            <div v-if="pregunta.tipo_pregunta === 'pre_abierta'">
               <label class="font-weight-bold">{{pregunta.pregunta}}</label>
               <ul class="navbar-nav">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr v-for="res in pregunta.respuestas" class="alert alert-info">
                                <td> {{res.respuesta}}</td>
                            </tr>
                        </tbody>
                    </table>
               </ul>
            </div>

            <div v-if="pregunta.tipo_pregunta === 'pre_opcion_simple'">
            <label class="font-weight-bold">{{pregunta.pregunta}}</label>
            <div class="d-flex justify-content-between">
                <div class="w-75" v-html="pregunta.contenido"></div>
                    <div class="w-25">
                        <ul class="navbar-nav">
                            <li v-for="opcion in pregunta.opciones" class="nav-item alert alert-primary p-1 rounded">
                                {{opcion.opcion}}
                            </li>
                        </ul>    
                    </div>
                </div>
            </div>

            <div v-if="pregunta.tipo_pregunta === 'pre_opcion_multiple'">
            <label class="font-weight-bold">{{pregunta.pregunta}}</label>
                <div class="d-flex justify-content-between">
                    <div class="w-75" v-html="pregunta.contenido"></div>
                        <div class="w-25">
                            <ul class="navbar-nav">
                                <li v-for="opcion in pregunta.opciones" class="nav-item alert alert-danger p-1 rounded">
                                    {{opcion.opcion}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div v-if="pregunta.tipo_pregunta === 'pre_desplegable'">
            <label class="font-weight-bold">{{pregunta.pregunta}}</label>
                <div class="d-flex justify-content-between">
                    <div class="w-75" v-html="pregunta.contenido"></div>
                        <div class="w-25">
                            <ul class="navbar-nav">
                                <li v-for="opcion in pregunta.opciones" class="nav-item alert alert-secondary p-1 rounded">
                                    {{opcion.opcion}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div v-if="pregunta.tipo_pregunta === 'pre_escala'">
            <label class="font-weight-bold">{{pregunta.pregunta}}</label>
                <div class="d-flex justify-content-between">
                    <div class="w-75" v-html="pregunta.contenido"></div>
                        <div class="w-25">
                            <ul class="navbar-nav">
                                <li v-for="opcion in pregunta.opciones" class="nav-item alert alert-success p-1 rounded">
                                    {{opcion.valor}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div v-if="pregunta.tipo_pregunta === 'pre_tabla'">
            <label class="font-weight-bold">{{pregunta.pregunta}}</label>
                <div class="d-flex justify-content-between">
                    <div class="w-100">
                        <table class="table table-striped table-bordered w-100" v-for="tabla in pregunta.resultados">
                            <thead class="table-primary">
                                <tr>
                                    <th v-if="tabla.column1 != 'null'">{{tabla.column1}}</th>
                                    <th v-if="tabla.column2 != 'null'">{{tabla.column2}}</th>
                                    <th v-if="tabla.column3 != 'null'">{{tabla.column3}}</th>
                                    <th v-if="tabla.column4 != 'null'">{{tabla.column4}}</th>
                                    <th v-if="tabla.column5 != 'null'">{{tabla.column5}}</th>
                                    <th v-if="tabla.column6 != 'null'">{{tabla.column6}}</th>
                                    <th v-if="tabla.column7 != 'null'">{{tabla.column7}}</th>
                                    <th v-if="tabla.column8 != 'null'">{{tabla.column8}}</th>
                                    <th v-if="tabla.column9 != 'null'">{{tabla.column9}}</th>
                                    <th v-if="tabla.column10 != 'null'">{{tabla.column10}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="resultado in tabla.resultado_tabla">
                                    <td v-if="tabla.column1 != 'null'">{{resultado.column1}}</td>
                                    <td v-if="tabla.column2 != 'null'">{{resultado.column2}}</td>
                                    <td v-if="tabla.column3 != 'null'">{{resultado.column3}}</td>
                                    <td v-if="tabla.column4 != 'null'">{{resultado.column4}}</td>
                                    <td v-if="tabla.column5 != 'null'">{{resultado.column5}}</td>
                                    <td v-if="tabla.column6 != 'null'">{{resultado.column6}}</td>
                                    <td v-if="tabla.column7 != 'null'">{{resultado.column7}}</td>
                                    <td v-if="tabla.column8 != 'null'">{{resultado.column8}}</td>
                                    <td v-if="tabla.column9 != 'null'">{{resultado.column9}}</td>
                                    <td v-if="tabla.column10 != 'null'">{{resultado.column10}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div v-if="pregunta.tipo_pregunta === 'pre_archivo'">
                <label class="font-weight-bold">{{pregunta.pregunta}}</label>
                <div class="row">
                    <div v-for="imagen in pregunta.resultados" class="col-6">
                    <figure>
                        <img :src="imagen.imagen" class="img-fluid img-thumbnail">
                    </figure>
                </div>
                </div>            
            </div>

           <hr class="bg-faded">
       </div>

       <!-- <p>{{resultados}}</p> -->
    </div>
</template>

<script>

    export default {

        data(){
            return {
               encuesta: [],
               resultados: [],
            }
        },

        created(){
            this.getDatosEncuesta($('#id_encuesta').val()); 
            
        },

        methods: {
            
            getDatosEncuesta(id_pregunta = 0){
                axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
                   /* console.log(result.data);*/ 
                    this.encuesta = result.data; 
                    this.mostrarResultados(result.data);  
                    this.cargarGrafias();
                    setTimeout(() => {
                        print();
                    }, 3000);     
               
                }).catch((err) => {
                    console.log(err);
                });
            },

            mostrarResultados (encuesta) {
                var resultados = encuesta[0].resultados[0];
                console.log(resultados);
                for (var i = 0; i < resultados.length; i++) {
                   var tipo_pregunta = resultados[i].tipo_pregunta;
                    if (tipo_pregunta === "pre_abierta") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<div id="respuesta${resultados[i].id}"></div>`,
                                respuestas: resultados[i].resultado
                        });
                    }

                    if (tipo_pregunta === "pre_opcion_simple") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<div id="respuesta${resultados[i].id}"></div>`,
                                opciones: resultados[i].resultado,
                        });
                        //mostramos la grafica de tipo Pie
                        //this.showChartPie(resultados[i].resultado, resultados[i].id);
                    }

                    if (tipo_pregunta === "pre_opcion_multiple") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<div id="respuesta${resultados[i].id}"></div>`,
                                opciones: resultados[i].resultado,
                        });
                    }

                    if (tipo_pregunta === "pre_desplegable") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<div id="respuesta${resultados[i].id}"></div>`,
                                opciones: resultados[i].resultado,
                        });
                    }

                    if (tipo_pregunta === "pre_escala") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<div id="respuesta${resultados[i].id}"></div>`,
                                opciones: resultados[i].resultado,
                        });
                    }

                    if (tipo_pregunta === "pre_tabla") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<div id="respuesta${resultados[i].id}"></div>`,
                                resultados: resultados[i].resultado,
                        });
                    }

                    if (tipo_pregunta === "pre_archivo") {
                        this.resultados.push({
                                id: resultados[i].id,
                                pregunta: resultados[i].pregunta,
                                tipo_pregunta: resultados[i].tipo_pregunta,
                                contenido: `<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_${resultados[i].id}">
                                              <i class="fa fa-eye mr-1"></i>Mostrar archivos
                                            </button>
                                            `,
                                id_modal: `modal_${resultados[i].id}`,            
                                resultados: resultados[i].resultado,
                        });
                    }
                }
                return true;
            },

            cargarGrafias(){
                for (var i = 0; i < this.resultados.length; i++) {
                    if (this.resultados[i].tipo_pregunta === 'pre_opcion_simple') {
                        this.showChartPie(this.resultados[i].opciones,this.resultados[i].id);
                    }

                    if (this.resultados[i].tipo_pregunta === 'pre_opcion_multiple') {
                        this.showChartPie(this.resultados[i].opciones,this.resultados[i].id);
                    }

                    if (this.resultados[i].tipo_pregunta === 'pre_desplegable') {
                        this.showChartPie(this.resultados[i].opciones,this.resultados[i].id);
                    }

                    if (this.resultados[i].tipo_pregunta === 'pre_escala') {
                        this.showDona(this.resultados[i].opciones,this.resultados[i].id);
                    }
                   
                   
                }
                
            },
            showChartPie(datos,x){
                
                // Load the Visualization API and the corechart package.
                  google.charts.load('current', {'packages':['corechart']});

                  // Set a callback to run when the Google Visualization API is loaded.
                  google.charts.setOnLoadCallback(drawChart);

                  // Callback that creates and populates a data table,
                  // instantiates the pie chart, passes in the data and
                  // draws it.
                  function drawChart() {

                    // Create the data table.
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Topping');
                    data.addColumn('number', 'Slices');
                    for (let i = 0; i < datos.length; i++) {
                    data.addRows([           
                        [`${datos[i].opcion}`, datos[i].respondido.length],
                    ]);
                    
                }

                    // Set chart options
                    var options = {'title':'',
                                   'width':400,
                                   'height':300};

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById(`respuesta${x}`));
                    chart.draw(data, options);   
            }           
            
        },

        showDona(datos, x){
            console.log(datos);
            google.charts.load("current", {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
           function drawChart() {
                
                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'Slices');
                for (let i = 0; i < datos.length; i++) {
                    data.addRows([           
                        [`${datos[i].valor}`, datos[i].respondido.length],
                    ]);
                    
                }
                

                // Set chart options
                var options = {
                    title: '',
                    pieHole: 0.4,
                    };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById(`respuesta${x}`));
                chart.draw(data, options);
            }
        }
    }
}
</script>
