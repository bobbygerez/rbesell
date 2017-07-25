<template>
  <v-app id="example-2" standalone>
    <nav-drawer></nav-drawer>
    <toolbar></toolbar>
    <main class="grey lighten-4">
      <v-container class="pt-0 mt-0" fluid>
        <bread-crumb></bread-crumb>
        <!--v-router-->
        <products-view></products-view>
        <products-view></products-view>
        <products-view></products-view>

        <bread-crumb></bread-crumb>
      </v-container>
    </main>
    <reg-dialog></reg-dialog>
  </v-app>
</template>
<script>
import ProductsView from '../layouts/cards/products.vue'
import BreadCrumb from '../layouts/breadcrumbs/location.vue'
import NavDrawer from '../layouts/navigation-drawer/nav-drawer.vue'
import Toolbar from '../layouts/toolbar/toolbar.vue'
import RegDialog from '../layouts/dialog/register.vue'
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
      ProductsView, BreadCrumb, NavDrawer, Toolbar, RegDialog
    }
  }
</script>
<style type="text/css">
  .navigation-drawer{
    margin-top: 80px;
  }
</style>