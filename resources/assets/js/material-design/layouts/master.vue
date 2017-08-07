<template>
  <v-app id="example-2" standalone>
    <nav-drawer></nav-drawer>
    <toolbar></toolbar>
    <main class="grey lighten-4">
      
      <v-container class="pt-0 mt-0" fluid>
          <v-layout row-sm column child-flex-sm class="hidden-md-and-up ma-2">
          <v-flex>
            <h1>asdfsdf</h1>
          </v-flex>
        </v-layout>

        <router-view></router-view>
      </v-container>
    </main>
    <reg-dialog></reg-dialog>
    <login-dialog></login-dialog>
  </v-app>
</template>
<script>

import NavDrawer from '../layouts/navigation-drawer/nav-drawer.vue'
import Toolbar from '../layouts/toolbar/toolbar.vue'
import RegDialog from '../layouts/dialog/register.vue'
import LoginDialog from '../layouts/dialog/login.vue'
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
    components: {
      NavDrawer, Toolbar, RegDialog, LoginDialog
    }
  }
</script>
<style type="text/css">
  .navigation-drawer{
    margin-top: 80px;
  }
</style>