<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="row">
            <div class="header">
              <div class="col-lg-12">
                  <p><a href="/" @click="newPosition($event)">New Position</a></p>
                  <div class="content table-responsive table-full-width">
                  <table class="table table-hover user-table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="position in positions">
                        <td>{{ position.name }}</td>
                        <td>{{ position.desc }}</td>
                        <td>{{ position.created_at }}</td>
                        <td>
                          <a href="/" style="font-size:20px;" class="text-success" @click="editPosition($event, position.id)"><span class="fa fa-edit"></span></a>
                          <a href="/" style="font-size:20px;" class="text-danger" @click="deletePosition($event, position.id)"><span class="fa fa-trash"></span></a>
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

    <modal v-model="positionModal" effect="fade" large width="40%" :backdrop="backdrop">
      <!-- custom header -->
      <div slot="modal-header" class="modal-header">
        <h4 class="modal-title text-center"> Edit {{ position.name }}</h4>

      </div>

      <div class="modal-body"> 
        <div class="form-group">
        <label>Name: </label>
          <input type="text" class="form-control border-input" v-model="position.name">
        </div>  

        <div class="form-group">
        <label>Description: </label>
          <textarea class="form-control border-input" v-model="position.desc">
            
          </textarea>
        </div> 

        
        <div class="row">
          <div class="col-lg-12">
            
           <div class="col-lg-6">
            <div class="form-group">
              <label>User Functions:</label>
              <select multiple="" class="form-control border-input" v-model="selectedCurrentRoles">
               <option v-for="cPosition in currentRoles" :value="cPosition.id">{{ cPosition.name }}</option>
             </select>
             <input type="button" value="Remove" style="margin-top: 10px;" @click="removeCurrentRole($event)">
           </div>
         </div>

         <div class="col-lg-6">
              <div class="form-group">
                <label>Built in Functions:</label>
                <select multiple="" class="form-control border-input" v-model="selectedAccess">
                 <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
               </select>
               <input type="button" value="Add" style="margin-top: 10px;" @click="addAccess($event)">
             </div>
           </div>
       </div>
     </div>


      </div>

      <div slot="modal-footer" class="modal-footer">
        <div class="pull-right" style="margin-right: 50px;">
          <button type="button" class="btn btn-default  btn-fill " @click="exitModal">Exit</button>
          <button type="button" class="btn btn-info  btn-fill " @click="saveMethod">Save</button>
        </div>
      </div>
  </modal>

  <modal v-model="newPositionModal" effect="fade" large width="40%" :backdrop="backdrop">
      <!-- custom header -->
      <div slot="modal-header" class="modal-header">
        <h4 class="modal-title text-center"> Add New Position</h4>

      </div>

      <div class="modal-body"> 
        <div class="form-group">
        <label>Name: </label>
          <input type="text" class="form-control border-input" v-model="newName">
        </div>  

        <div class="form-group">
        <label>Description: </label>
          <textarea class="form-control border-input" v-model="newDesc">
            
          </textarea>
        </div> 

        
        <div class="row">
          <div class="col-lg-12">
            
           <div class="col-lg-6">
            <div class="form-group">
              <label>User Functions</label>
              <select multiple="" class="form-control border-input" v-model="newRoles">
               <option v-for="cPosition in newSelectedRoles" :value="cPosition.id">{{ cPosition.name }}</option>
             </select>
             <input type="button" value="Clear" style="margin-top: 10px;" @click="removeSelected($event)">
           </div>
         </div>

         <div class="col-lg-6">
              <div class="form-group">
                <label>Built in Functions:</label>
                <select multiple="" class="form-control border-input" v-model="newSelectedAccess">
                 <option v-for="role in roles" :value="role">{{ role.name }}</option>
               </select>
               <input type="button" value="Add" style="margin-top: 10px;" @click="moveSelected($event)">
             </div>
           </div>
       </div>
     </div>


      </div>

      <div slot="modal-footer" class="modal-footer">
        <div class="pull-right" style="margin-right: 50px;">
          <button type="button" class="btn btn-default btn-fill" @click="exitModal">Exit</button>
          <button type="button" class="btn btn-info btn-fill" @click="createNewPosition">Save</button>
        </div>
      </div>
  </modal>

  <alert v-model="deleteDanger" placement="top" type="danger" width="400px" dismissable>
    <span class="icon-info-circled alert-icon-float-left"></span>
    <strong>Are you sure you want to delete {{ position.name }}? <input type="button" value="Yes" @click="confirmDeletePosition($event)"></strong>
    
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
import modal from 'vue-strap/src/modal' 
import alert from 'vue-strap/src/alert'
export default {

  data(){

    return {

        windowLocation: window.location.origin + '/',
        positionModal: false,
        selectedCurrentRoles: [],
        alertSuccess: false,
        selectedAccess: [],
        newPositionModal: false,
        newRoles: [],
        newName: '',
        newDesc: '',
        newSelectedRoles: [],
        newSelectedAccess: [],
        deleteDanger: false,
        backdrop: false
    }
  },

  components: {
    modal,
    alert
  },
 
  created(){
    this.$store.commit('title', 'All Positions')
    this.fetchPositions()
  },
  computed: {
    positions(){
      return this.$store.getters.positions
    },
    position(){

      return this.$store.getters.position
    },
    roles(){

      return this.$store.getters.roles
    },
    currentRoles(){

      return this.$store.getters.currentRoles
    },
    alertMessage(){

      return this.$store.getters.alertMessage
    }
  },
  methods: {
      removeSelected(){
        this.newSelectedRoles = []
      },
      moveSelected(e){
       this.newSelectedRoles = this.newSelectedAccess
      },
      addAccess(e){

        var store = this.$store;
          axios.post(this.windowLocation + 'api/position/add_access',{

            positionId: this.position.id,
            addAccess: this.selectedAccess
          })
          .then(function(response){

            store.commit('alertMessage', response.data.message);
            
          })
          .catch(function(response){

          })
        this.alertSuccess = true
        this.editPosition(e, this.position.id)

      },
      removeCurrentRole(e){
        var store = this.$store;
          axios.post(this.windowLocation + 'api/position/remove_role',{

            positionId: this.position.id,
            removeRoleId: this.selectedCurrentRoles
          })
          .then(function(response){

            store.commit('alertMessage', response.data.message);
            
          })
          .catch(function(response){

          })
        this.alertSuccess = true
        this.editPosition(e, this.position.id)
      },
      fetchPositions(){

          var store = this.$store;
          axios.get(this.windowLocation + 'api/position')
          .then( function(response){
            store.commit('positions', response.data.positions);
            
          })
          .catch( function(){

          })

      },
    editPosition: function(e, id){
      e.preventDefault()
      var store = this.$store
      axios.get(this.windowLocation + 'api/position/' + id + '/edit')
      .then(function(response){

          store.commit('position', response.data.position);
          store.commit('currentRoles', response.data.currentRoles);
          store.commit('roles', response.data.roles);
      })
      .catch(function(response){

      })
      this.positionModal = true
       this.fetchPositions()
    },
    deletePosition(e, id){
      e.preventDefault()
      var store = this.$store
      axios.get(this.windowLocation + 'api/position/' + id + '/edit')
      .then(function(response){

          store.commit('position', response.data.position);
          store.commit('currentRoles', response.data.currentRoles);
          store.commit('roles', response.data.roles);
      })
      .catch(function(response){

      })
      this.deleteDanger = true
       this.fetchPositions()
    },
    confirmDeletePosition(e){
      e.preventDefault()
      var store = this.$store
      axios.delete(this.windowLocation + 'api/position/' + this.position.id)
      .then(function(response){

           store.commit('alertMessage', response.data.message);
      })
      .catch(function(){

      })

      this.alertSuccess = true
      this.deleteDanger = false
      this.fetchPositions()
    },
    newPosition(e){
      e.preventDefault()
      var store = this.$store
      axios.get(this.windowLocation + 'api/position/create')
      .then(function(response){
        store.commit('roles', response.data.roles);
      })
      .catch(function(response){



      })

      this.newPositionModal = true
       this.fetchPositions()
    },
    exitModal(){
      this.positionModal = false
      this.newPositionModal = false
      this.fetchPositions()

    },
    saveMethod: function(){
      var store = this.$store
      var vm = this
      axios.put(this.windowLocation + 'api/position/' + this.position.id,{

          name: this.position.name,
          desc: this.position.desc
      })
      .then( function(response){
           store.commit('alertMessage', response.data.message);

      })

      .catch(function(response){

      })

      this.alertSuccess = true

    },
    createNewPosition(){

      var store = this.$store;

      axios.post(this.windowLocation + 'api/position',{

          name: this.newName,
          desc: this.newDesc,
          roles: this.newSelectedRoles
      })
      .then( function(response){

        store.commit('alertMessage', response.data.message);
        

      })
      .catch(function(response){

      })

      this.newName = ''
      this.newDesc = ''
      this.newSelectedRoles = {}
      this.alertSuccess = true
    }
  }
}

</script>
<style type="text/css" scoped>
  tr:hover{
    cursor: auto;
  }
</style>

