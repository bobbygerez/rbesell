import Vue from 'vue'
import Vuetify from 'vuetify'
import MainLayout from './layouts/master.vue'
import MainFooter from './layouts/footer.vue'
import {store} from './store/store.vue'

Vue.use(Vuetify)

var app = new Vue({
	el: '#app',
	store,
	components: {
		MainLayout, MainFooter
	}


})