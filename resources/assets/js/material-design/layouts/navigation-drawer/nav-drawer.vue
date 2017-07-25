<template>
 <v-navigation-drawer
     class="pa-1"
      persistent
      absolute
      height="100%"
      clipped
      enable-resize-watcher
      v-model="drawer"
    >
      <v-list class="pa-0">
        <v-list-tile avatar tag="div">
          <v-list-tile-content>
            <v-list-tile-title class="title"><v-icon>find_in_page</v-icon> Filter Results</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-list class="pt-0" >
        <v-divider></v-divider>
         <v-list-title-title>
           <v-select
              v-bind:items="items"
              v-model="e1"
              label="Category"
              chips
              bottom
            ></v-select>
         </v-list-title-title>
         <v-list-title-title>
          <v-select
              v-bind:items="items"
              v-model="e1"
              label="Sub-category"
            ></v-select>
            <v-select
              v-bind:items="items"
              v-model="e1"
              label="Province"
              multiple

            ></v-select>
            <v-select
              v-bind:items="items"
              v-model="e1"
              label="City"
              multiple

            ></v-select>
         </v-list-title-title>
      </v-list>
    </v-navigation-drawer>
</template>
<script>
import toolbar from '../toolbar/toolbar.vue'
  export default {
    data () {
      return {
        drawer: true,
        items: [
          { title: 'Home', icon: 'dashboard' },
          { title: 'About', icon: 'question_answer' }
        ],
        mini: false,
        right: null
      }
    }
  }
</script>

