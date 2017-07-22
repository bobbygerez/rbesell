 <accordion :one-at-atime="checked" type="info">
                  <panel is-open type="success">
                    <strong slot="header"><u>Basic Informations</u></strong>
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
                                    <option v-for="stat in status" :value="stat.value">@{{ stat.name }}</option>
                                </select>
                            </div>
                        </div>
                  </panel>
                  <panel  type="success">
                    <strong slot="header"><u>More Informations</u></strong>
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
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Marital Status</label>
                                <select class="form-control border-input" v-model="user.personal_data.marital_status">
                                    <option value="">Select Marital Status</option>
                                    <option v-for="marital in maritalStatus" :value="marital.id">@{{ marital.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Spouse name</label>
                                <input type="text" class="form-control border-input" v-model="user.personal_data.spouse_name" >
                            </div>
                            <div class="form-group">
                                <label>Account Status</label>
                                <select class="form-control border-input" v-model="user.status">
                                    <option value="">Select Status</option>
                                    <option v-for="stat in status" :value="stat.value">@{{ stat.name }}</option>
                                </select>
                            </div>
                        </div>
                  </panel>

                </accordion>