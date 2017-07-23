<template>
   <div>
    <v-breadcrumbs icons divider="chevron_right" >
      <v-breadcrumbs-item 
        v-for="item in items" :key="item.text"
        :disabled="item.disabled"
      >
        {{ item.text }}
      </v-breadcrumbs-item>
    </v-breadcrumbs>
    <br style="clear:both" />    
    </div>
</template>
<script>
  export default {
    data () {
      return {
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
    float: left;

  }
  ul{
    padding-left: 0px;
  }
</style>