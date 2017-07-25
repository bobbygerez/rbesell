import Vue from 'vue'
import Vuetify from 'vuetify'
import axios from 'axios'
import MainLayout from './layouts/master.vue'
import MainFooter from './layouts/footer.vue'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate';
import {store} from './store/store.vue'
import {routes} from './router/routes.vue'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const router = new VueRouter({
  routes // short for routes: routes
})

Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.use(VeeValidate);

var app = new Vue({
	el: '#app',
	router,
	store,
	components: {
		MainLayout, MainFooter
	}


})