<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="row">
            <div class="header">
              <div class="col-lg-12">
                  <div class="content table-responsive table-full-width">
                    <div class="col-lg-6">
                      <div style="margin-top: 25px;">
                          <v-select
                            v-model="selectedBranch"
                            :on-change="onChangeBranch"
                            :debounce="250"
                            :on-search="getOptions"
                            :options="options"
                            placeholder="Search Branches..."
                            value="id"
                            label="branch_name"
                          >
                          </v-select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="pull-right">
                        <paginate
                        :page-count="branches.last_page"
                        :containerClass="'pagination'"
                        :click-handler="clickHandler"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'className'">
                      </paginate>
                    </div>
                  </div>
                    <branch-table></branch-table>
                  </div>
              </div>
            </div><!--header end -->
          </div>

        </div>
      </div>

    </div>
    <branch-modal></branch-modal>
  </div>
</template>

<script type="text/javascript">
  import branchTable from '../branches/branchTable.vue'
  import paginate from 'vuejs-paginate'
  import vSelect from 'vue-select'
  import axios from 'axios'
  import branchModal from '../branches/branchModal.vue'
  export default {

    components: {
      branchTable, paginate, vSelect, branchModal
    },
    data(){
      return {
          selectedBranch: null,
          options: []
      }
    },
    created(){
        this.$store.commit('title', 'All Branches');
    },
    computed: {
        branches(){

          return this.$store.getters.branches
        },
        page(){
          return this.$store.getters.page
        },
        per_page(){
          return this.$store.getters.per_page
        }
    },
    methods: {
      onChangeBranch(value){
        var store = this.$store;

        if (value != null) {
          axios.get( window.location.origin + '/api/branches/' + value.id + '?page=1&per_page=1')
          .then(resp => {
            store.commit('branches', resp.data.branches);
          }).catch( resp => {
              
          })
        }
        else{

           store.commit('page', 1)
           store.commit('per_page', 10)
           bus.$emit('changePage')
        }
        
      },
     
      getOptions(search, loading) {

        
        loading(true)
        axios.post( window.location.origin + '/api/branch-search', {
           q: search
        }).then(resp => {
           this.options = resp.data.branches
           loading(false)
        }).catch( resp => {
            loading(false)
        })


      },
      clickHandler(page){
         this.$store.commit('page', page)
         bus.$emit('changePage')
      }
    },
    watch: {

      
    }
  }
</script>



