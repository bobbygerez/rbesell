import Vue from 'vue'
import VeeValidate from 'vee-validate';
import UserDataViewer from './components/UserDataViewer.vue'
import modal from 'vue-strap/src/modal'
import axios from 'axios'
import {store} from './store/store.vue'
import VueRouter from 'vue-router'
import {routes} from './router/routes.vue'
  
window.bus = new Vue()

Vue.use(VueRouter)

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const router = new VueRouter({
  routes // short for routes: routes
})

window.bus = new Vue()
var app = new Vue({
	router,
	store,
	components: {

		modal,
		UserDataViewer
	},
	data: {

		isActive: false,
	},
	
	computed: {

		title(){

			return this.$store.getters.title
		}

	}
		
}).$mount('#app')

