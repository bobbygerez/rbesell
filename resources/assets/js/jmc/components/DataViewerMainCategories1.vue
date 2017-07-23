<template>
    <div class="container">
      <h2>{{ title }}</h2>

      <div class="row">
          <table class="table table-hover">
              <tr>
                <th v-for="column in columns" @click="toggleOrder(column)">
                <span>{{ column }}</span>
                <span v-if="column === query.column" >
                  <span v-if="query.direction === 'desc'">&darr;</span>
                  <span v-else>&uarr;</span>
                </span>
                </th>

              </tr>
              <tbody>
                <tr v-for="row in model.data">
                    <td v-for="(value, key) in row">{{ value }}</td>
                </tr>
              </tbody>
          </table>
          <div>
              <span>Displaying {{ model.from }} - {{ model.to }} of {{ model.total }} rows</span>
          </div>

          <div>
            <span>Rows per page</span>
            <input type="text" v-model="query.per_page" @blur="fetchIndexData()">
          </div>

          <div>
            <button @click="prev()">&laquo;</button>
            <button @click="next()">&raquo;</button>
          </div>
      </div>  
    </div>

</template>

<script>
  import Vue from 'vue'
  import axios from 'axios'
  //similar to vue-resource

  export default {
    props: ['source', 'title'],
    data() {
      return {
        model: {},
        columns: {},
        query: {
          page: 1,
          column: 'id',
          direction: 'desc',
          per_page: 10
        }
      }
    },
    created() {
      this.fetchIndexData()
    },

    methods: {

      next(){
        if(this.model.next_page_url){

          this.query.page++
          this.fetchIndexData()
        }
      },
      prev(){
        if(this.model.prev_page_url){
          this.query.page--
          this.fetchIndexData()
        }
      },

      toggleOrder(column){

          if(column === this.query.column){

              if(this.query.direction === 'desc'){
                this.query.direction = 'asc'
              }
              else{
                this.query.direction = 'desc'
              }
          }
          else{
            this.query.column = column
            this.query.direction = 'asc'
          }
          this.fetchIndexData()
      },

      fetchIndexData() {
        var vm = this
        axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}`)
          .then(function(response) {
            Vue.set(vm.$data, 'model', response.data.model)
            Vue.set(vm.$data, 'columns', response.data.columns)
            
          })
          .catch(function(response) {
            console.log(response)
          })
      }

    }
      
  }
</script>