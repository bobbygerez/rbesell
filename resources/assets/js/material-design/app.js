import Vue from 'vue'
import Vuetify from 'vuetify'
import MainLayout from './layouts/master.vue'
import MainFooter from './layouts/footer.vue'
Vue.use(Vuetify)

var app = new Vue({
	el: '#app',
	components: {
		MainLayout, MainFooter
	}


})