<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="row">
            <div class="header">
              <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                      
                    <autocomplete
                     placeholder="Search firstname/lastname/email"
                    :url="userPopUp"
                    anchor="user"
                    :on-select="getData"
                    :on-input="onInput"
                    >
                  </autocomplete>
                    </div>
                     
                </div>
                <div class="content table-responsive table-full-width">
                <table class="table table-hover user-table">
                <caption class="text-center" v-if="caption"><h3>{{ firstname }} {{ lastname }} </h3><p>{{ email }} </p></caption>
                    <thead>
                      <tr>
                        <th>Menu and Functions</th>
                        <th>Add</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Override/Approve</th>
                        <th>View</th>
                        <th>Print</th>
                        <th>Publish</th>
                      </tr>
                    </thead>
                    <tbody v-for="mainFunction in mainFunctions">

                      <tr v-if="mainFunction.name == 'My Profile'">
                          <td>{{ mainFunction.name }}</td>
                          <td v-for="policy in policies" style="text-align:center">
                              <div class="checkbox checkbox-success" style="display: inline; margin: 5px;" v-if="caption">
                                  <input :id="policy.id" class="styled" type="checkbox" :value="policy.id" v-model="userPolicies" @click="addPolicy()">
                                  <label :for="policy.id">
                                      
                                  </label>
                              </div>
                          </td>
                      </tr>
                       <tr v-else>
                          <td>{{ mainFunction.name }}</td>
                          <td v-for="policy in policies">
                            {{ policy.id }}
                          </td>
                      </tr>
                      <tr v-for="sub in mainFunction.sub_functions">
                          <td><span>{{ sub.name }}</span></td>
                          <td v-for="policy in policies">{{ policy.name }}</td>
                      </tr>

                    </tbody>
                  </table>
                  </div>
              </div>
            </div><!--header end -->
          </div>

          

        </div>
      </div>


    </div>

    <alert v-model="alertSuccess" placement="top" duration="4000" type="success" width="400px" dismissable>
      <span class="icon-info-circled alert-icon-float-left"></span>
      <strong>Success!</strong>
      <p>{{ alertMessage }}</p>
    </alert>
  </div>
</template>

<script type="text/javascript">

require('vue2-autocomplete-js/dist/style/vue2-autocomplete.css')

import axios from 'axios'
import lodash from 'lodash'
import Autocomplete from 'vue2-autocomplete-js'
import alert from 'vue-strap/src/alert'

export default{

    components: {

        Autocomplete ,
        alert
      },

    data(){

        return {

            userPopUp: window.location.origin + '/api/user-pop',
            windowLocation: window.location.origin + '/',
            firstname: '',
            lastname: '',
            email: '',
            caption: false,
            defaultPolicies: [

              { name: '', id: ''},
              { name: '', id: ''},
              { name: '', id: ''},
              { name: '', id: ''},
              { name: '', id: ''},
              { name: '', id: ''},
              { name: '', id: ''}
              
            ],
            userId: '',
            alertSuccess: false
        }
        
    },

    created(){

        this.$store.commit('title', 'Access Rights')
        this.$store.commit('policies', this.defaultPolicies);
        this.fetchMainFunctions();
    },
    computed: {
        usersMatch(){

            return this.$store.getters.usersMatch
        },
        mainFunctions(){

            return this.$store.getters.mainFunctions
        },
        policies(){

          return this.$store.getters.policies
        },
        userPolicies: {

          get(){
            return this.$store.getters.userPolicies
          },
          
          set(value){

            this.$store.commit('userPolicies', value);
          }
        },
        alertMessage(){

          return this.$store.getters.alertMessage
        }


    },
    methods: {

        addPolicy(){
          var store = this.$store
          axios.post(this.windowLocation + 'api/policy',{
            userId: this.userId,
            userPolicies: this.userPolicies
          }).then( function(response){

            store.commit('alertMessage', response.data.message);
          })
          .catch(function (response){

          })
          this.alertSuccess = true
        },
        getData(obj){

            var store = this.$store
            this.userId = obj.id
            axios.get(this.windowLocation + 'api/policy?id=' + obj.id)
            .then(function(response){
                store.commit('policies', response.data.policies);
                store.commit('userPolicies', response.data.user_policies);
            })
            .catch()
            this.firstname = obj.firstname + ', '
            this.lastname = obj.lastname
            this.email = obj.email
            this.caption = true


        },
        fetchMainFunctions(){

            var store = this.$store

            axios.get(this.windowLocation + 'api/main_functions')
            .then( function(response){

                store.commit('mainFunctions', response.data.mainFunctions);

            })
            .catch()
        },
        onInput(){

          this.firstname = ''
          this.lastname = ''
          this.email = ''
          this.caption = false,
          this.$store.commit('policies', this.defaultPolicies);
        },
        checkUserPolicies(policyId){

          console.log(policyId)
        }
    }
  
}

</script>

<style type="text/css" scoped>


    tr td span{

         margin-left: 20px;
    }

    tr td span span{

         margin-left: 20px;
    }

  tr:hover{
    cursor: auto;
  }
</style>
