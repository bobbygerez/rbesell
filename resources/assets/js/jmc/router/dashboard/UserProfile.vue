<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="row">
						<div class="header">
							<div class="col-lg-12">
									<div class="col-lg-12">
										<h4>Basic Information</h4>
									</div>
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
										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email Address</label>
											<input type="text" class="form-control border-input" v-model="user.email">
										</div>
										<div class="form-group">
											<label>Member Id</label>
											<input type="text" class="form-control border-input" v-model="user.member_id">
										</div>
										<div class="form-group">
											<label>Account No.</label>
											<input type="text" class="form-control border-input" v-model="user.account_no" >
										</div>
										
									</div>
							</div>

							
					          	<div class="col-lg-12">
					          		<div class="col-lg-12">
										<h4>Personal Information</h4>
									</div>
					          		<br />
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

					          		<button class="btn btn-info btn-fill" style="margin-left: 20px;" @click="updateProfile">Update</button>
					          	</div>

					          
						</div><!--header end -->
					</div>

					

				</div>
			</div>

	        <alert v-model="showAlert" placement="top" duration="4000" type="success" width="400px" dismissable>
	        	<span class="icon-info-circled alert-icon-float-left"></span>
	        	<strong>Success!</strong>
	        	<p>{{ alertMessage }}</p>
	        </alert>
		</div>

		 

	</div>
</template>
<script type="text/javascript">
	import axios from 'axios'
	import alert from 'vue-strap/src/alert'
	export default{

		components: {

			alert
		},
		data(){

			return {

				windowLocation: window.location.origin,
				showAlert: false

			}
		},	
		created(){

			 this.$store.commit('title', 'My Profile')
			 this.fetchUserData()
		},
		computed: {

			user(){

				return this.$store.getters.user
			},
			status(){

				return this.$store.getters.status
			},
			chunkRoles(){

		            return this.$store.getters.chunkRoles
		      },
		    maritalStatus(){

		          return this.$store.getters.maritalStatus
		      },
		    heirarchy(){

		    	return this.$store.getters.heirarchy
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
		methods: {
			fetchUserData() {
				var store = this.$store
				axios.post(`${this.windowLocation}/api/user-my-profile`)
				.then(function(response) {
					store.commit('user', response.data.user)
					store.commit('chunkRoles', response.data.chunkRoles)
					store.commit('maritalStatus', response.data.maritalStatus)
					store.commit('heirarchy', response.data.heirarchy)

				})
				.catch(function(response) {
				})

				var vm = this
				 this.$store.watch(
			          function (state) {
			              return state.user;
			          },
			          function () {
			              vm.getUserRoles()
			          },
			          {
			              deep: true //add this if u need to watch object properties change etc.
			          }
			      );
				
			},
			getUserRoles(){

	            this.$store.commit('clearRoles')
	            
	            var userRoles = this.$store.getters.user.roles
	            
	            for ( var role in userRoles){
	            	
	                this.$store.commit('checkedRoles', userRoles[role].id)

	            }
			},
			updateProfile(){

				let store = this.$store

				axios.put(`${this.windowLocation}/api/user/` + this.user.id,{

					member_id: this.user.member_id,
					account_no: this.user.account_no,
					email: this.user.email,
					lastname: this.user.personal_data.lastname,
					firstname: this.user.personal_data.firstname,
					middlename: this.user.personal_data.middlename,
					nationality: this.user.personal_data.nationality,
					birthplace: this.user.personal_data.birthplace,
					birthdate: this.user.personal_data.birthdate,
					gender_id: this.user.personal_data.gender_id,
					mothers_maiden_name: this.user.personal_data.mothers_maiden_name,
					spouse_name: this.user.personal_data.spouse_name,
					marital_status: this.user.personal_data.marital_status,
					roles: this.checkedRoles,
					messenger_acct: this.user.contact_data.messenger_acct,
					mobile_no: this.user.contact_data.mobile_no,
					tel_no: this.user.contact_data.tel_no

				}).then( function(response){

					store.commit('alertMessage', response.data.message)
				})


				.catch(function(response){

					console.log(response)

				});

				this.showAlert = true
			}
		}
	}
</script>