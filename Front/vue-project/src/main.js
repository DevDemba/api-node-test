// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vuetify from 'vuetify'
// index.js or main.js
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
import moment from 'moment'
import VueSweetalert2 from 'vue-sweetalert2'
import store from './store/index.js'
import axios from 'axios';

Vue.config.productionTip = false;

Vue.prototype.$axios = axios;

const token = localStorage.getItem('token');

if(token) {
  Vue.prototype.$axios.defaults.headers.common['Authorization'] = token;
}

Vue.use(BootstrapVue, Vuetify);

Vue.use(VueSweetalert2, options);

const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}


Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY hh:mm');
  }
});

Vue.filter('birthday', function (value, format) {
  if (value) {
      return moment(String(value)).format(format || 'MM/DD/YYYY');
  }
});


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>',
  // render: h => h(App),
}).$mount('#app')
