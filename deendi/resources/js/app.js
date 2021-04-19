/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('pregunta-simple', require('./components/PreguntaSimpleComponent.vue').default);
Vue.component('edit-pregunta-simple', require('./components/EditFormSimpleComponent.vue').default);

Vue.component('diselo-encuesta', require('./components/DiseñoDeLaEncuestaComponent.vue').default);
Vue.component('sidebar-dising', require('./components/SidebarDisingComponent.vue').default);

Vue.component('formAbierta', require('./components/FormPreguntaAbierta.vue').default);
Vue.component('formSimple', require('./components/FormPreguntaSimple.vue').default);
Vue.component('formMultiple', require('./components/FormPreguntaMultiple.vue').default);
Vue.component('formDesplegable', require('./components/FormPreguntaDesplegable.vue').default);
Vue.component('formEscala', require('./components/FormPreguntaEscala.vue').default);
Vue.component('formArchivo', require('./components/FormPreguntaArchivo.vue').default);
Vue.component('formNota', require('./components/FormNota.vue').default);
Vue.component('formTabla', require('./components/FormPreguntaTabla.vue').default);

Vue.component('EditAbierta', require('./components/EditFormAbierta.vue').default);
Vue.component('EditSimple', require('./components/EditFormSimple.vue').default);
Vue.component('EditMultiple', require('./components/EditFormMultiple.vue').default);
Vue.component('EditDesplegable', require('./components/EditFormDesplegable.vue').default);
Vue.component('EditEscala', require('./components/EditFormEscala.vue').default);
Vue.component('EditArchivo', require('./components/EditFormArchivo.vue').default);
Vue.component('EditNota', require('./components/EditFormNota.vue').default);
Vue.component('EditTabla', require('./components/EditFormTabla.vue').default);

Vue.component('encuesta', require('./components/Encuesta.vue').default);
Vue.component('encuestavista', require('./components/EncuestaVista.vue').default);
Vue.component('encuestaemail', require('./components/EncuestaEmail.vue').default);

Vue.component('tablaDinamica', require('./components/TablaDinamica.vue').default);

Vue.component('analisisresultados', require('./components/AnalisisDeResultados.vue').default);
Vue.component('analisisresumen', require('./components/AnalisisDeResultadosResumen.vue').default);
Vue.component('reporte', require('./components/Reporte.vue').default);
Vue.component('reportefinal', require('./components/ReporteFinal.vue').default);

Vue.component('formemail', require('./components/FormEmail.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import store from './store'
import swal from 'sweetalert'
import lighbox2 from 'lightbox2'

const app = new Vue({
    el: '#app',
    store,
    swal,
    lighbox2,
});
