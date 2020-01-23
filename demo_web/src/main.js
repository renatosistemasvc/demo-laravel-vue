import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './vuex/store'
import axios from 'axios'
import moment from 'moment'

window.eventBus = new Vue();
Vue.config.productionTip = false

Vue.prototype.$axios = axios;
Vue.prototype.$moment = moment;
Vue.prototype.$requiredBlur = { required: true, message: 'Campo obrigatório.', trigger: 'blur'};
Vue.prototype.$requiredChange = { required: true, message: 'Campo obrigatório.', trigger: 'change'};
Vue.prototype.$emailBlur = { type: 'email', message: 'E-mail inválido.', trigger: 'blur' };
Vue.prototype.$dataBlur = { validator: (rule, value, callback) => {

  if(!value){
      callback();
      return false;
  }
      
  if (value.length == 10 && !moment(value, 'DD/MM/YYYY').isValid()) {
      callback(new Error('Data inválida.'));
  } else {
      callback();
  }

}, trigger: 'blur' };

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import money from './shared/moneys'
Vue.use(money, {precision: 4})

import cPanel from './shared/c-panel/c-panel'
Vue.component('c-panel', cPanel);

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/pt'
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI, { size: 'medium', locale });

Vue.filter('truncate', function(text, length, clamp){

  if(!text)
    return '';

  clamp = clamp || '...';
  return text.length > length ? text.slice(0, length) + clamp : text;
});

new Vue({  
  store,
  router,
  render: h => h(App)
}).$mount('#app')