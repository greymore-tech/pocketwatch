/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 import Vue from 'vue'

 var Chart = require('chart.js');
 
//  import VueSplide from '@splidejs/vue-splide';
 
//  Vue.use( VueSplide );
 
//  import Gate from "./gate";
//  Vue.prototype.$gate = new Gate(window.user);
 
 import router from './router.js'
 
 Vue.component(HasError.name, HasError)
 Vue.component(AlertError.name, AlertError)
 
 import swal from 'sweetalert2';
 window.swal=swal;
 const toast=swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 6000
 });
 window.toast = toast;
 
//  import VueGoodTablePlugin from 'vue-good-table';
 
 // import the styles
//  import 'vue-good-table/dist/vue-good-table.css'
 
//  Vue.use(VueGoodTablePlugin);
 
//  import EditableCell from '@lucasbiguet/vue-editable-cell'
 
//  Vue.use(EditableCell)
 
 
 import vSelect from 'vue-select'
 Vue.component('v-select',vSelect)
 import 'vue-select/dist/vue-select.css';

 
//  import { saveAs } from 'file-saver';
//  var FileSaver = require('file-saver');
 
//  import { VueEditor, Quill } from "vue2-editor";

import { ToggleButton } from 'vue-js-toggle-button'
 
Vue.component('ToggleButton', ToggleButton)
 
 
 import { Form, HasError, AlertError } from 'vform'
 window.Form=Form;
 Vue.component(HasError.name, HasError)
 Vue.component(AlertError.name, AlertError)
 
 
 import moment from 'moment'
 Vue.filter('date',function(created){
   return moment(created).format('DD MM YYYY');
 });
 
 if(document.querySelector("meta[name='user-id']") != null){
 Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
 Vue.prototype.$userEmail = document.querySelector("meta[name='user-email']").getAttribute('content');
 Vue.prototype.$name = document.querySelector("meta[name='user-name']").getAttribute('content');
 Vue.prototype.$phone = document.querySelector("meta[name='user-phone']").getAttribute('content');
 }
 //Vue.prototype.$verified = document.querySelector("meta[name='user-verified']").getAttribute('content');
 
 import VueProgressBar from 'vue-progressbar'
 Vue.use(VueProgressBar, {
   color: 'rgb(143, 255, 199)',
   failedColor: 'red',
   thickness: '10px',
   transition: {
     speed: '0.2s',
     opacity: '0.6s',
     termination: 300
   },
   autoRevert: true,
   location: 'top',
   inverse: false
 })
 
 
//  import { createDuration } from '@fullcalendar/core';
 import { utils } from 'sortablejs';
 
 const options = {
     color: '#bffaf3',
     failedColor: '#874b4b',
     thickness: '5px',
     transition: {
       speed: '0.2s',
       opacity: '0.6s',
       termination: 300
     },
     autoRevert: true,
     location: 'left',
     inverse: false
   }
 
 
 // Vue.prototype.$verified = document.querySelector("meta[name='user-verified']").getAttribute('content');
 
 // to have access to the form and other variables everywhere
 window.Form=Form;
 
 window.Vue = require('vue');
 
 
 // window.google = google;
 
 
 var Promise = require('es6-promise').Promise;
 require('es6-promise').polyfill();
 
 
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
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     el: '#app',
     Chart,
     router
 });