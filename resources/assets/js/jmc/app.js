

import Vue from 'vue'
import axios from 'axios'
import UserRegister from './components/UserRegister.vue'
import MainCategoriesProducts from './components/MainCategoriesProducts.vue'
import SidebarOptions from './components/SidebarOptions.vue'

import alert from 'vue-strap/src/alert'
import VeeValidate from 'vee-validate';
import JuanFooter from './router/home/Footer.vue'
import MainContent from './router/home/MainContent.vue'
import HeaderBottom from './router/home/HeaderBottom.vue'
import HeaderTop from './router/home/HeaderTop.vue'
import HeaderMid from './router/home/HeaderMid.vue'
import MenuPrimary from './router/home/MenuPrimary.vue'
import Banner from './router/home/Banner.vue'
import {store} from './store/store.vue'

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.use(VeeValidate);

window.bus = new Vue();

var app = new Vue({
  el: '#app',
  store,
  components: {
    UserRegister,
    MainCategoriesProducts,
    SidebarOptions,
    alert,
    JuanFooter,
    MainContent,
    HeaderBottom,
    HeaderMid,
    MenuPrimary,
    Banner,
    HeaderTop

  },
  data: {

    Spinner: false,
    loginShow: false,
    registerSuccess: false,
    messages: {},
    errorHeader: '',
    showAlertLogin: false,
    email: '',
    password: '',
    showAlertLoginSuccess: false,
    welcomeName: false,
    user: {},
    registerShow: false,
    alertType: 'danger'

  },
  created(){
    bus.$on('register-show', data => { 
      this.registerShow = false 
      this.registerSuccess = true

    })
  },
  methods: {

    forgotPassword: function(e){
      e.preventDefault()

      if ( this.validateEmail() ){
        this.alertType = 'success'
        this.errorHeader = 'Password Reset Success'
        this.messages = {messages: { messages: 'An email has been sent. Please click the link!'}}
        this.showAlertLogin = true
      }

      else{
        this.alertType = 'danger'
        this.errorHeader = 'Forgot Password Error'
        this.messages = {messages: { messages: 'Please enter a valid email!'}}
        this.showAlertLogin = true
      }
          
    },
   
    
  }

  
})


