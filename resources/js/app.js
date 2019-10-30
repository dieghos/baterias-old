/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import pdf from './mixins/pdfMake';
import VueSweetalert2 from 'vue-sweetalert2';

window.Vue = require('vue');
window.moment = require('moment');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.mixin(pdf);
Vue.config.productionTip = false;   
Vue.use(VueSweetalert2);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('table-component', require('./components/DynamicTableComponent').default);
Vue.component('product-form-component', require('./components/ProductFormComponent').default);
Vue.component('dependence-form-component', require('./components/DependenceFormComponent').default);
Vue.component('deliver-component', require('./components/DeliverComponent').default);
Vue.component('devolution-component', require('./components/DevolutionComponent').default);
Vue.component('select-request-component', require('./components/SelectRequestComponent').default);
Vue.component('select-year-component', require('./components/SelectYearComponent').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
