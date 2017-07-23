  <modal v-model="show" effect="fade" large>
              <!-- custom header -->
              <div slot="modal-header" class="modal-header">
                <h4 class="modal-title">
                 <span>@{{ user.personal_data.lastname }}, </span>
                  <span>@{{ user.personal_data.firstname }}</span>
                </h4>
                
              </div>

              <div class="modal-body">
                
                <alert  v-model="showTop" duration="3000" placement="top" type="success" width="400px" dismissable >
                  <span class="icon-info-circled alert-icon-float-left"></span>
                  <p class="text-center"><strong>@{{ message }}</strong></p>
                </alert>

                
               

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="padding: 15px;">
                                    <label>Roles: </label>
                                    <br />
                                    <span v-for="roles in chunkRoles">
                                        <div class="col-sm-4" v-for="role in roles">
                                            <div class="checkbox checkbox-success" style="display: inline; margin: 5px;">
                                                <input :id="role.id" class="styled " type="checkbox" :value="role.id" v-model="checkedRoles" >
                                                <label :for="role.id">
                                                    @{{ role.name }}
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