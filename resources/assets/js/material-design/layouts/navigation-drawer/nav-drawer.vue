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
         <v-list-tile-title>
            <v-select
              label="Category"
              v-bind:items="categories"
              v-model="e7"
              chips
              persistent-hint
            ></v-select>
         </v-list-tile-title>
         <v-list-tile-title>
           <v-select
              label="Sub-category"
              v-bind:items="states"
              v-model="e7"
              chips
              persistent-hint
            ></v-select>
            <v-select
              label="Province"
              v-bind:items="states"
              v-model="e7"
              multiple
              chips
              persistent-hint
            ></v-select>
            <v-select
              label="City"
              v-bind:items="states"
              v-model="e7"
              multiple
              chips
              persistent-hint
            ></v-select>
         </v-list-tile-title>
      </v-list>
    </v-navigation-drawer>
</template>

<script>

  export default {
    data () {
      return {
        drawer: true,
        e6: [],
        e7: [],
        states: [
          'Alabama','Alaska','American Samoa','Arizona',
          'Arkansas','California','Colorado','Connecticut',
          'Delaware','District of Columbia','Federated States of Micronesia',
          'Florida','Georgia','Guam','Hawaii','Idaho',
          'Illinois','Indiana','Iowa','Kansas','Kentucky',
          'Louisiana','Maine','Marshall Islands','Maryland',
          'Massachusetts','Michigan','Minnesota','Mississippi',
          'Missouri','Montana','Nebraska','Nevada',
          'New Hampshire','New Jersey','New Mexico','New York',
          'North Carolina','North Dakota','Northern Mariana Islands','Ohio',
          'Oklahoma','Oregon','Palau','Pennsylvania','Puerto Rico',
          'Rhode Island','South Carolina','South Dakota','Tennessee',
          'Texas','Utah','Vermont','Virgin Island','Virginia',
          'Washington','West Virginia','Wisconsin','Wyoming'
        ],
        categories: []
      }
    },
    created(){
      this.getCategories()
    },
    methods: {

        getCategories(){
          var store = this.$store
          window.axios.get(window.base_url + 'api/maincategory')
          .then(res => {
            store.commit('mainCategories', res.data.mainCategories)
          })
          .catch()
        }
    }
  }
</script>

