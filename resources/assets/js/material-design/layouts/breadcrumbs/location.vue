<template>
   <div >
    <v-breadcrumbs icons divider="chevron_right" >
      <v-breadcrumbs-item 
        v-for="item in items" :key="item.text"
        :disabled="item.disabled"
      >
        {{ item.text }}
      </v-breadcrumbs-item>
    </v-breadcrumbs>
    <v-spacer></v-spacer>
    <p class="text-lg-left">...</p>
<p class="text-xl-right">...</p>
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