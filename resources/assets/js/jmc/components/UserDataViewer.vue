<template>
  <div class="card">
    <div class="header">
        <div class="form-group">
            <div class="col-md-4">
             <input type="text" class="form-control border-input" placeholder="Search Lastname, Firstname, Email" v-model="string" >
             </div>
             <div class="col-md-4">
              <select class="form-control border-input" v-model="roleId">
                  <option value="">Select Roles By Group</option>
                  <option v-for="role in roles"  :value="role.id"> {{ role.name }}</option>
              </select>
             </div>
        </div>
    </div>
    <br />
    <div class="content table-responsive table-full-width">
      <table class="table table-hover user-table">
          <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Status</th>
            
          </thead>
          <tbody>
              <tr v-for="user in users" @click="userTable(user.id)">
                <td><span> {{ user.personal_data.lastname + ', ' + user.personal_data.firstname }}</span></td>
                <td>{{ user.email }}</td>
                <td>
                  <span v-for="role in user.roles">
                    {{ role.name }},
                  </span>
                </td>
                <td>
                  <span v-if="user.status === 1" class="label label-success">Active</span>
                  <span v-if="user.status === 0" class="label label-danger">Inactive</span>
                </td>
                <td>
                  
                </td>
              </tr>
          </tbody>
      </table>                  

    </div>

    <modal v-model="show" effect="fade" large>
      <!-- custom header -->
      <div slot="modal-header" class="modal-header">
        <h4 class="modal-title">
         <span>{{ user.personal_data.lastname + ', ' + user.personal_data.firstname }}</span>
        </h4>
        
      </div>

      <div class="modal-body">
        
        <alert v-model="showTop" placement="top" duration="4000" type="success" width="400px" dismissable>
            <span class="icon-info-circled alert-icon-float-left"></span>
            <strong>Success!</strong>
            <p>{{ message }}</p>
         </alert>
        
          <tabs v-model="activeTab" nav-style="tabs" justified>
              <tab header="Basic Informations">
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Lastname</label>
                      <input type="text" class="form-control border-input" v-model="user.personal_data.lastname">
                  </div>
                  <div class="form-group">
                      <label>Firstname</label>
                      <input type="text" class="form-control border-input" v-model="user.personal_data.firstname">
                  </div>
                  <div class="form-group">
                      <label>Middlename</label>
                      <input type="text" class="form-control border-input" v-model="user.personal_data.middlename">
                  </div>
                  <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" class="form-control border-input" v-model="user.email">
                  </div>
              </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Member Id</label>
                          <input type="text" class="form-control border-input" v-model="user.member_id">
                      </div>
                      <div class="form-group">
                          <label>Account No.</label>
                          <input type="text" class="form-control border-input" v-model="user.account_no" >
                      </div>
                      <div class="form-group">
                          <label>Account Status</label>
                          <select class="form-control border-input" v-model="user.status">
                              <option value="">Select Status</option>
                              <option v-for="stat in status" :value="stat.value">{{ stat.name }}</option>
                          </select>
                      </div>
                  </div>
              </tab>
              <tab header="Personal Data">
                 <div class="col-md-6">
                  <div class="form-group">
                      <label>Birthdate</label>
                      <input type="date" class="form-control border-input" v-model="user.personal_data.birthdate">
                  </div>
                  <div class="form-group">
                      <label>Mother's Maiden Name</label>
                      <input type="text" class="form-control border-input" v-model="user.personal_data.mothers_maiden_name">
                  </div>
                  <div class="form-group">
                      <label>Nationality</label>
                      <input type="text" class="form-control border-input" v-model="user.personal_data.nationality">
                  </div>
                  <div class="form-group">
                      <label>Birth Place</label>
                      <input type="text" class="form-control border-input" v-model="user.personal_data.birthplace">
                  </div>

                  <div class="form-group">
                          <label>Marital Status</label>
                          <select class="form-control border-input" v-model="user.personal_data.marital_status">
                              <option value="">Select Marital Status</option>
                              <option v-for="marital in maritalStatus" :value="marital.id">{{ marital.name }}</option>
                          </select>
                      </div>
                      
                     
              </div>
                <div class="col-md-6">

                  <div class="form-group">
                          <label>Spouse name</label>
                          <input type="text" class="form-control border-input" v-model="user.personal_data.spouse_name" >
                      </div>
                  <div class="form-group">
                    <label>Messenger</label>
                    <input type="text" class="form-control border-input" v-model="user.contact_data.messenger_acct" >
                  </div>
                  <div class="form-group">
                    <label>Mobile No:</label>
                    <input type="text" class="form-control border-input" v-model="user.contact_data.mobile_no" >
                  </div>
                  <div class="form-group">
                    <label>Telephone No:</label>
                    <input type="text" class="form-control border-input" v-model="user.contact_data.tel_no" >
                  </div>
                </div>
              </tab>
           
          </tabs>
          <div class="row">
              <div class="col-lg-12">
                  <div class="form-group" style="padding: 15px;">
                      <label>Position: </label>
                      <br />
                      <span v-for="roles in chunkRoles">
                          <div class="col-sm-4" v-for="role in roles">
                              <div class="checkbox checkbox-success" style="display: inline; margin: 5px;">
                                  <input :id="role.id" class="styled" type="checkbox" :value="role.id" v-model="checkedRoles" >
                                  <label :for="role.id">
                                      {{ role.name }}
                                  </label>
                              </div>
                          </div>
                      </span>
                       
                  </div>
              </div>
          </div>
        </div>
       
      <!-- custom buttons -->
      <div slot="modal-footer" class="modal-footer">
        <button type="button" class="btn btn-default" @click="show = false">Exit</button>
        <button type="button" class="btn btn-success" @click="saveMethod">Save</button>
        <dropdown text="Delete" type="danger">
          <li><a href="#confirmDelete" @click="confirmDelete">Confirm Delete?</a></li>
        </dropdown>

      </div>
   </modal>
   <alert v-model="errorAlert" placement="top"  type="danger" width="400px" dismissable>
    <span class="icon-info-circled alert-icon-float-left"></span>
    <strong>Contact Your Administrator!</strong>
    <p>{{ alertMessage }}</p>
  </alert>
  </div>

</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import lodash from 'lodash'
import modal from 'vue-strap/src/modal' 
import alert from 'vue-strap/src/alert'
import dropdown from 'vue-strap/src/Dropdown.vue'
import panel from 'vue-strap/src/panel'
import popover from 'vue-strap/src/popover'
import tabs from 'vue-strap/src/tabs'
import tab from 'vue-strap/src/tab'



export default{
   components: {
        modal,
        alert,
        dropdown,
        panel,
        popover,
        tabs,
        tab
    },
  data(){

      return {
        query: {},
        columns: {},
        string: '',
        userId: '',
        myUser: {},
        roleId: '',
        windowLocation: window.location.origin + '/',
        showTop: false,
        show: false,
        activeTab: 0,
        selectedMaritalStatus: '',
        status: [{name: 'Active' , value: 1}, {name: 'Inactive', value: 0}],
        message: '',
        activeTab: 0,
        checked: true,
        largeModal: false,
        windowLocation: window.location.origin + '/',
        confirmDeleteUser: true,
        errorAlert: false,

      }

          
  },
  computed: {

     show(){

        return this.$store.state.userModal
     }, 
     user(){

            return this.$store.getters.user
     },
     users(){
        return this.$store.state.users
     },
     roles(){

        return this.$store.state.roles
     },
     chunkRoles(){

            return this.$store.getters.chunkRoles
      },
      maritalStatus(){

          return this.$store.getters.maritalStatus
      },
      alertMessage(){
          return this.$store.getters.alertMessage
      },
    checkedRoles: {
        
        get(){
            return this.$store.getters.checkedRoles
        },
        set(value){

            this.$store.commit('clearRoles')
            this.$store.dispatch('checkedRoles', value)
        }
        
    }
  },
  created(){

    this.fetchUserData()
    bus.$on('updated-user', data => { this.fetchUserData()})
  },

  methods: {
    
    fetchUserData() {
        var store = this.$store
        var vm = this
        axios.get(`${this.windowLocation}api/user?&string=${this.string}&roleId=${this.roleId}`)
          .then(function(response) {
            store.commit('users', response.data.users)
            store.commit('roles', response.data.roles)

            if (response.data.error.length > 0) {

              store.commit('alertMessage', response.data.error);
              vm.errorAlert = true;
            }

          })
          .catch(function(response) {
            console.log(response);

          })
        },
    userTable: function(userId){

      var store = this.$store
      this.userId = userId
      var vm = this

      axios.get(`${this.windowLocation}/api/user/${this.userId}/edit`)
        .then(function(response){
          
           store.commit('user', response.data.user)
           store.commit('chunkRoles', response.data.chunkRoles)
           store.commit('maritalStatus', response.data.maritalStatus)
           
        
        })
        .catch(function(response){


            
        })

        this.$store.watch(
          function (state) {
              return state.user;
          },
          function () {
              vm.showModal()
          },
          {
              deep: true //add this if u need to watch object properties change etc.
          }
      );

       
    },
    showModal: function(){

            this.show = true

            this.$store.commit('clearRoles')
            
            var userRoles = this.$store.getters.user.roles

            for ( var role in userRoles){

                this.$store.commit('checkedRoles', userRoles[role].id)

            }


        },
        saveMethod: function(){

            var vm = this
            var user = this.$store.getters.user

            axios.put(`${this.windowLocation}/api/user/` + user.id,{
                member_id: user.member_id,
                account_no: user.account_no,
                status: user.status,
                email: user.email,
                roles: this.checkedRoles,
                firstname: user.personal_data.firstname,
                lastname: user.personal_data.lastname,
                middlename: user.personal_data.middlename,
                mothers_maiden_name: user.personal_data.mothers_maiden_name,
                birthdate: user.personal_data.birthdate,
                birthplace: user.personal_data.birthplace,
                nationality: user.personal_data.nationality,
                marital_status: user.personal_data.marital_status,
                spouse_name: user.personal_data.spouse_name,
                messenger_acct: this.user.contact_data.messenger_acct,
                mobile_no: this.user.contact_data.mobile_no,
                tel_no: this.user.contact_data.tel_no
                

            })
            .then(function(response){

                Vue.set(vm.$data, 'message', response.data.message)
                Vue.set(vm.$data, 'showTop', true)

            })

            .catch(function(response){

            })

            bus.$emit('updated-user')
        },
        confirmDelete: function(){
            
            var vm = this
            var user = this.$store.getters.user
            axios.delete(`${this.windowLocation}/api/admin/`+ user.id)
                .then(function(response){
                    vm.message = response.data.message
                    Vue.set(vm.$data, 'showTop', true)
                })
                .catch(function(response){

                })
            bus.$emit('updated-user')

        }
  },

  watch: {

    string: _.debounce(function(){

      this.fetchUserData()

    }, 500),

    roleId: _.debounce(function(){

      this.fetchUserData()
    }, 500)
  }
}
</script>