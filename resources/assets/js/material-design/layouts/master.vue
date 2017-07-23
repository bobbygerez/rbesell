<template>
  <v-app id="example-2" standalone>
    <v-navigation-drawer
      temporary
      v-model="drawer" 
      :mini-variant.sync="mini" 
      light 
      overflow
      absolute
    >
      <v-list class="pa-0">
        <v-list-tile avatar tag="div">
          <v-list-tile-avatar>
            <img src="https://randomuser.me/api/portraits/men/85.jpg" />
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title>John Leider</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-btn icon  @click.native.stop="mini = !mini">
              <v-icon>chevron_left</v-icon>
            </v-btn>
          </v-list-tile-action>
        </v-list-tile>
      </v-list>
      <v-list class="pt-0" dense>
        <v-divider></v-divider>
        <v-list-tile v-for="item in items" :key="item.title">
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar fixed class="red darken-2 white--text text--darken-2" dense>
      <v-toolbar-side-icon @click.native.stop="drawer = !drawer" class="white--text text--darken-2"></v-toolbar-side-icon>
      <v-toolbar-title>RBeSell</v-toolbar-title>
      <v-spacer></v-spacer>
       <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat class="white--text text--darken-2">Home</v-btn>
        <v-btn flat class="white--text text--darken-2">About Us</v-btn>
        <v-btn flat class="white--text text--darken-2">Services</v-btn>
      </v-toolbar-items>
    </v-toolbar>
    <main class="grey lighten-4">
      <v-container class="pt-0 mt-0" fluid>
        <bread-crumb></bread-crumb>
        <!--v-router-->
        <products-view></products-view>
      </v-container>
    </main>
  </v-app>
</template>
<script>
import ProductsView from '../layouts/cards/products.vue'
import BreadCrumb from '../layouts/breadcrumbs/location.vue'
import NavDrawer from '../layouts/navigation-drawer/nav-drawer.vue'

  export default {
    data () {
      return {
        drawer: null,
        items: [
          { title: 'Home', icon: 'dashboard' },
          { title: 'About', icon: 'question_answer' }
        ],
        mini: false,
        right: null
      }
    },
    components: {
      ProductsView, BreadCrumb, NavDrawer
    }
  }
</script>