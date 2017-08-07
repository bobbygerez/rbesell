<template>
	<v-toolbar fixed class="red darken-2 white--text text--darken-2" dense>
      <v-toolbar-side-icon  @click.native="toggleDrawer" class="white--text text--darken-2 hidden-sm-and-down"  ></v-toolbar-side-icon>
      <v-toolbar-title >RBeSell</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items >
        <v-text-field prepend-icon="search" hide-details single-line dark class="ml-2" auto-grow label="Search product..."></v-text-field>
         
        <v-menu
          origin="center center"
          transition="scale-transition"
          bottom
          flat
          left
          class="hidden-md-and-up"
        >
          <v-btn flat dark slot="activator" class="purple white--text text--darken-2">
            <v-icon >more_vert</v-icon>
          </v-btn>
          <v-list >
            <v-list-tile v-for="item in items" :key="item.title">
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
      </v-toolbar-items>
       <v-toolbar-items class="hidden-sm-and-down">
          <v-btn flat @click="loginDialog" v-tooltip:bottom="{ html: 'Login' }">
           <v-icon class="white--text text--darken-2" >account_circle</v-icon>
         </v-btn>
         <v-btn flat @click="registerDialog" v-tooltip:bottom="{ html: 'Register Account' }">
           <v-icon class="white--text text--darken-2">assignment_ind</v-icon>
         </v-btn>
         <v-btn flat v-tooltip:bottom="{ html: 'Home' }">
           <v-icon class="white--text text--darken-2" >home</v-icon>
         </v-btn>
        <v-btn flat v-tooltip:bottom="{ html: 'About Us' }">
          <v-icon class="white--text text--darken-2" >account_balance</v-icon>
        </v-btn>
        <v-btn flat v-tooltip:bottom="{ html: 'Services' }">
          <v-icon class="white--text text--darken-2" >tag_faces</v-icon>
        </v-btn>
      </v-toolbar-items>
    </v-toolbar>
</template>

<script type="text/javascript">
	export default {

		data () {
      return {
        items: [
          { title: 'Login', icon: 'dashboard' },
          { title: 'Register', icon: 'question_answer' }
        ],
        mini: false,
        right: null
      }
    },
    computed: {
      drawer: {

          get(){

            return this.$store.getters.drawer
          }
      }
    },
    methods: {

        loginDialog(){
          this.$store.commit('loginDialog', true)
        },
        registerDialog(){
          this.$store.commit('registerDialog', true);
        },
        toggleDrawer(){

          if(this.drawer == false){
            console.log(this.drawer + 'false')
            this.$store.commit('drawer', true);

          }
          else {
            console.log(this.drawer + 'ture')
            this.$store.commit('drawer', false);
          }
        }
    }
	}
</script>

<style type="text/css">
  [data-tooltip]:before {
    background-color: rgba(0,0,0,.87);
  }
</style>