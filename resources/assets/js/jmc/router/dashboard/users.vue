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
                  <div class="col-lg-6">
                    <div class="pull-right">
                      <paginate
                      :page-count="users.last_page"
                      :containerClass="'pagination'"
                      :click-handler="clickHandler"
                      :prev-text="'Prev'"
                      :next-text="'Next'"
                      :container-class="'className'">
                    </paginate>
                  </div>
                </div>
                  
                  <table class="table table-hover user-table">
                    <caption>
                      <p class="text-center">Page {{ users.current_page }} of {{ users.last_page }} <br /> Display {{ users.from }} to {{ users.to }} out of {{ users.total }}</p>
                    </caption>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="user in users.data">
                         <td>{{ user.personal_data.lastname }}, {{ user.personal_data.firstname }}</td>
                         <td>{{ user.email }}</td>
                         <td style="width: 25%;">
                           <span v-for="position in user.positions">
                             <span class="position">
                               {{ position.name }}
                             </span>
                           </span>
                          
                         </td>
                         <td v-if="user.status"><span class="label label-success"> <i class="fa fa-check"> </i></span></td>
                         <td v-else><span class="label label-danger"> <i class="fa fa-times"> </i></span></td>
                         <td>
                           <a href="/" style="font-size:20px;" class="text-success" @click="editUser($event, user.id)"><span class="fa fa-edit"></span></a>
                          <a href="/" style="font-size:20px;" class="text-danger" @click="deleteUser($event, user.id)"><span class="fa fa-trash"></span></a>
                         </td>
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
     <modal v-model="userModal" effect="fade" large width="70%" :backdrop="backdrop">
      <!-- custom header -->
      <div slot="modal-header" class="modal-header">
        <h4 class="modal-title text-center">Edit {{ user.personal_data.firstname }} {{ user.personal_data.lastname }}</h4>

      </div>

      <div class="modal-body"> 
        <div class="row">
         <tabs v-model="activeTab" nav-style="pills" :justified="justified">
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

              <tab header="Contact Informations">
                 <div class="col-md-6">
                  <div class="form-group">
                      <label>Telephone No:</label>
                      <input type="date" class="form-control border-input" v-model="user.contact_data.tel_no">
                  </div>
                  <div class="form-group">
                      <label>Mobile No:</label>
                      <input type="text" class="form-control border-input" v-model="user.contact_data.mobile_no">
                  </div>
                  
                     
              </div>
                <div class="col-md-6">

                  <div class="form-group">
                      <label>Messenger Acct:</label>
                      <input type="text" class="form-control border-input" v-model="user.contact_data.messenger_acct">
                  </div>
                </div>
              </tab>

              <tab header="Position">
               <div class="col-lg-12">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Assigned Positions:</label>
                    <select multiple="" class="form-control border-input" v-model="currentPosition">
                      <option v-for="position in user.positions" :value="position.id">{{ position.name }}</option>
                    </select>
                    <input type="button" value="Remove" style="margin-top: 10px;" @click="removePosition($event)" >
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>All Positions:</label>
                    <select multiple="" class="form-control border-input" v-model="newSelectedPosition">
                     <option v-for="position in positions" :value="position.id">{{ position.name }}</option>
                   </select>
                   <input type="button" value="Add" style="margin-top: 10px;" @click="addPosition($event)">
                 </div>
               </div>
             </div>

           </tab>
           
          </tabs>
          </div>
      </div>

      <div slot="modal-footer" class="modal-footer">
        <div class="pull-right" style="margin-right: 50px;">
          <button type="button" class="btn btn-default btn-fill" @click="exitModal">Exit</button>
          <button type="button" class="btn btn-info btn-fill" @click="saveUser">Save</button>
        </div>
      </div>
  </modal>
  <alert v-model="deleteDanger" placement="top" type="danger" width="400px" dismissable>
    <span class="icon-info-circled alert-icon-float-left"></span>
    <strong>Are you sure you want to delete {{ name }}? <input type="button" value="Yes" @click="confirmDelete($event)"></strong>
    
  </alert>
  <alert v-model="alertSuccess" placement="top" duration="4000" type="success" width="400px" dismissable>
    <span class="icon-info-circled alert-icon-float-left"></span>
    <strong>Success!</strong>
    <p>{{ alertMessage }}</p>
  </alert>
</div>
</template>

<script type="text/javascript">

  import axios from 'axios'
  import Paginate from 'vuejs-paginate'
  import Autocomplete from 'vue2-autocomplete-js'
  import lodash from 'lodash'
  import modal from 'vue-strap/src/modal'
  import dropdown from 'vue-strap/src/Dropdown.vue'
  import tabs from 'vue-strap/src/tabs'
  import tab from 'vue-strap/src/tab' 
  import alert from 'vue-strap/src/alert' 
  export default{

    components: {
      Paginate,
      Autocomplete,
      modal, dropdown, tabs, tab, alert
    },
    data(){

        return {
          deleteDanger: false,
          userPopUp: window.location.origin + '/api/user-pop',
           windowLocation: window.location.origin + '/',
           pageNum: 1,
           perPage: 40,
           userModal: false,
           activeTab: 0,
           status: [{name: 'Active' , value: 1}, {name: 'Inactive', value: 0}],
           justified: true,
           currentPosition: [],
           newSelectedPosition: [],
           alertSuccess: false,
           backdrop: false,
           obj: '',
           urlUpdate: window.location.origin + '/api/user-basic-info-update'

        }
       
    },
    computed: {

        users(){

          return this.$store.getters.users
        },
        user(){
          return this.$store.getters.user
        },
        maritalStatus(){

          return this.$store.getters.maritalStatus
        },
        positions(){

          return this.$store.getters.positions
        },
        alertMessage(){

          return this.$store.getters.alertMessage
        },
        name(){

          return  this.user.personal_data.lastname + ', ' + this.user.personal_data.firstname 
        }
    },
    created(){

        this.index();
        this.$store.commit('title', 'All Users')
    },
    methods: {

        confirmDelete(e){

          e.preventDefault()
          var store = this.$store
          axios.delete(this.windowLocation + 'api/user/' + this.user.id)
          .then(function(response){

               store.commit('alertMessage', response.data.message);
          })
          .catch(function(){

          })
          
        },
        index(){

            var store = this.$store;

            axios.get(this.windowLocation + 'api/user?page=' + this.pageNum + '&per_page=' + this.perPage)
            .then(function(response){

                store.commit('users', response.data.users);

            })
            .catch(function(response){

            })

            this.obj = ''
        },
        editUser(e, userId){
          e.preventDefault()
          var store = this.$store
          axios.get(this.windowLocation + 'api/user/' + userId +'/edit')
          .then(function(response){
            store.commit('user', response.data.user);
            store.commit('maritalStatus', response.data.maritalStatus)
            store.commit('positions', response.data.positions)
          })
          .catch()
          this.userModal = true
        },
        saveUser(e){
          var store = this.$store
          axios.post(urlUpdate, this.user)

          .then(function(response){

              store.commit('alertMessage', response.data.message);
          })
          .catch(function(response){

          })
          this.alertSuccess = true

          if(this.obj != ''){
            this.getData(this.obj)
          }
          else {
            this.index()
          }
          

        },
        deleteUser(e, userId){
          e.preventDefault()
          var store = this.$store
          axios.get(this.windowLocation + 'api/user/' + userId +'/edit')
          .then(function(response){
            store.commit('user', response.data.user);
            store.commit('maritalStatus', response.data.maritalStatus)
            store.commit('positions', response.data.positions)
          })
          .catch()
          this.deleteDanger = true
        },
        clickHandler(pageNum){

         this.pageNum = pageNum
        },
        getData(obj){
          var store = this.$store;
          this.pageNum = 1
          this.perPage = 1
          axios.get(this.windowLocation + 'api/user-search?id=' + obj.id + '&page=1&per_page=1')
          .then(function(response){

                store.commit('users', response.data.users);


            })
            .catch(function(response){

            })

            this.obj = obj
        },
        onInput(data){
          this.pageNum = 1
          this.perPage = 40
          if (data==='') {

            this.index()
          }
          
        },
        exitModal(){
          this.userModal = false
        },
        removePosition(e){

          var store = this.$store
          axios.post(this.windowLocation + 'api/user-remove-position',{
              id : this.user.id,
              positionIds: this.currentPosition
          }).then(function(response){

              store.commit('alertMessage', response.data.message);

          })

          .catch(function(response){

          })

          this.alertSuccess = true

          this.editUser(e, this.user.id);
          this.index()
        },
        addPosition(e){

          var store = this.$store
          axios.post(this.windowLocation + 'api/user-add-position',{
              id : this.user.id,
              positionIds: this.newSelectedPosition
          }).then(function(response){

              store.commit('alertMessage', response.data.message);

          })

          .catch(function(response){

          })

          this.alertSuccess = true

          this.editUser(e, this.user.id);
          this.index()
        }
    },
    watch: {

      pageNum(){

        this.index()
      },
      activeTab(val){

        switch(val){
          case 0:
              this.urlUpdate = window.location.origin + '/api/user-basic-info-update'
              break;
          case 1:
              this.urlUpdate = window.location.origin + '/api/user-personal-data-update'
              break;
          case 2:
              this.urlUpdate = window.location.origin + '/api/user-contact-info-update'
              break;
          case 3:
              this.urlUpdate = window.location.origin + '/api/user-basic-info-update'
              break;
        }


      }

      
    }
  }
</script>
<style type="text/css" scoped>
  tr:hover{
    cursor: auto;
  }

  span.position{
    border: 1px solid #e0e0e0;
    border-radius: 3px;
    color: #858585;
    font-weight: normal;
    font-size: 1em;
    padding: 0 0.5ch;
    vertical-align: middle;
    margin: 5px;
  }

</style>

