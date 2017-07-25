<template>
 <v-layout row-sm column child-flex-sm class="mt-2">
  <v-flex>
    <div class="text-xs-left ma-2">
      <v-pagination v-bind:length.number="15" v-model="page" circle></v-pagination>
    </div>
  </v-flex>
  <v-flex>
    <v-breadcrumbs icons divider="chevron_right" class="ma-2">
      <v-breadcrumbs-item 
      v-for="item in items" :key="item.text"
      :disabled="item.disabled"
      >
      {{ item.text }}
    </v-breadcrumbs-item>
  </v-breadcrumbs>
</v-flex>
</v-layout>
</template>
<script>
  export default {
    data () {
      return {
        page: 1,
        items: [
          {
            text: 'Dashboard',
            disabled: false
          },
          {
            text: 'Link 1',
            disabled: false
          },
          {
            text: 'Link 2',
            disabled: true
          }
        ]
      }
    }
  }
</script>

<style type="text/css">
  .breadcrumbs {
    float: right;

  }
  ul{
    padding-left: 0px;
  }
</style>