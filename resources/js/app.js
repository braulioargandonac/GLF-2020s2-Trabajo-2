require('./bootstrap');
import 'bootstrap/dist/js/bootstrap.bundle.min';
require('particles.js');
window.vis= require('vis');
window.Vue = require('vue');
window.vis = require('vis');
require('sweetalert'); 

Vue.component('integrantes', require('./components/IntegrantesComponent.vue').default);
Vue.component('home', require('./components/HomeComponent.vue').default);
Vue.component('particles', require('./components/particulas.vue').default);
Vue.component('automata', require('./components/AutomatasComponent.vue').default);

const app = new Vue({
    el: '#app',
});