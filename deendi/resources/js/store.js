import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({

  state: {
     encuesta: [],
     lista_opciones: [],
     url_desing: '/user140220202001/encuesta/desarrollo', ///user140220202001/encuesta/desarrollo
     url_aplicar_encuesta : '/user140220202001/encuesta/responder', //servicios/
     url_encuesta_recibido : '/user140220202001/encuesta/recibido', //servicios/
  },

  mutations: {

    llenarPreguntas(state, preguntas){ //Mutattion que llena el objeto de preguntas con un arreglo de objetos que
                                              // vienen de a funcion getPreguntas
      state.encuesta = preguntas;     //Llena el arrglo vacion un objetos de las preguntas

    },

    llenarOpciones(state, opciones){ //Mutattion que llena el objeto de preguntas con un arreglo de objetos que
                                              // vienen de a funcion getPreguntas
      state.lista_opciones = opciones;     //Llena el arrglo vacion un objetos de las preguntas

    },

  },

  actions: {

    getDatosEncuesta( { commit }, id) {
        axios.get('encuesta/preguntas/'+ id)
        .then((result) => {

            commit('llenarPreguntas', result.data[0].preguntas);
            console.log(result.data[0].preguntas);

        }).catch((err) => {
            console.log(err);
        });

    },


    getDatosOpcionesPregunta({ commit }, id_pregunta = 0){
        axios.get('get/pregunta/datos/' + id_pregunta).then((result) => {
            commit('llenarOpciones', result.data);
            console.log(result.data);

        }).catch((err) => {
            console.log(err);
        });
    },



  }

})
