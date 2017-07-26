<template>
	<v-toolbar fixed class="red darken-2 white--text text--darken-2" dense>
      <v-toolbar-side-icon @click.native.stop="drawer = !drawer" class="white--text text--darken-2"></v-toolbar-side-icon>
      <v-toolbar-title  class="hidden-sm-and-down">RBeSell</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items >
        <v-text-field prepend-icon="search" hide-details single-line dark class="ml-2" auto-grow label="Search product..."></v-text-field>
         <v-menu
          origin="center center"
          transition="scale-transition"
          bottom
          flat
          left
        >
          <v-btn small fab slot="activator" class="red white--text text--darken-2">
            <v-icon dark>account_circle</v-icon>
          </v-btn>
          <v-list>
            <v-list-tile>
              <v-list-tile-title @click="loginDialog">
                Login
              </v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
              <v-list-tile-title @click="registerDialog">
                Register
              </v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
        <v-menu
          origin="center center"
          transition="scale-transition"
          bottom
          flat
          left
          class="hidden-md-and-up"
        >
          <v-btn small fab slot="activator" class="purple white--text text--darken-2">
            <v-icon dark>more_vert</v-icon>
          </v-btn>
          <v-list >
            <v-list-tile v-for="item in items" :key="item.title">
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
      </v-toolbar-items>
       <v-toolbar-items class="hidden-sm-and-down">
         <v-btn flat class="white--text text--darken-2"> Home</v-btn>
        <v-btn flat class="white--text text--darken-2"> About Us</v-btn>
        <v-btn flat class="white--text text--darken-2"> Services</v-btn>
      </v-toolbar-items>
    </v-toolbar>
</template>

<script type="text/javascript">
	export default {

		data () {
      return {
        drawer: null,
        items: [
          { title: 'Login', icon: 'dashboard' },
          { title: 'Register', icon: 'question_answer' }
        ],
        mini: false,
        right: null
      }
    },
    methods: {

        loginDialog(){
          this.$store.commit('loginDialog', true)
        },
        registerDialog(){
          this.$store.commit('registerDialog', true);
        }
    }
	}
</script>