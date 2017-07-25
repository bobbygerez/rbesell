<template>
	<modal v-model="show" effect="fade" width="80%" :backdrop="false">
    <!-- custom header -->
    <div slot="modal-header" class="modal-header">
      <h4 class="modal-title">
        <i>{{ branch.branch_name }}</i>
      </h4>
    </div>
    <div class="modal-body">
    	<div class="row">
    		<tabs></tabs>
    	</div>
    </div>
    <!-- custom buttons -->
    <div slot="modal-footer" class="modal-footer">
      <button type="button" class="btn btn-default btn-fill" @click="exitModal">Exit</button>
      <button type="button" class="btn btn-success btn-fill" @click="saveMethod">Save</button>
    </div>

    <alert v-model="alertSuccess" placement="top" type="success" width="70%" dismissable  duration="4000">
      <span class="fa fa-check-circle alert-icon-float-left"></span>
      <div style="margin-left: 40px;">
      <strong>Updated Successfully</strong>
      <p>{{ alertMessage }}</p>
      </div>
    </alert>

    <alert v-model="alertDanger" placement="top" type="danger" width="70%" dismissable  duration="4000">
      <span class="fa fa-warning alert-icon-float-left"></span>
      <div style="margin-left: 40px;">
      <strong>Please correct the following error/s:</strong>
      	 <ul>
            <li v-for="val in alertMessage">{{ val[0] }}</li>
         </ul>
      </div>
    </alert>
  </modal>

</template>

<script type="text/javascript">
	import axios from 'axios'
	import modal from 'vue-strap/src/modal'
	import tabs from '../branches/tabs.vue'
	import alert from 'vue-strap/src/alert'
	export default {

		components: {

			modal, tabs, alert
		},
		
		data(){

			return {
				alertSuccess: false,
				alertDanger: false
			}
		},
		computed: {

			branchUrlSave(){

				return this.$store.getters.branchUrlSave
			},
			branch(){

				return this.$store.getters.branch
			},
			show(){

				return this.$store.getters.showModal
			},
			alertMessage(){

				return this.$store.getters.alertMessage
			},

			coordinates(){

				return this.$store.getters.coordinates
			}


		},
		methods: {

			saveMethod(){
				var store = this.$store
				var vm = this

				if (this.coordinates.lat != '') {
					this.$store.dispatch('branchLat', this.coordinates.lat);
					this.$store.dispatch('branchLong', this.coordinates.long);
					this.$store.dispatch('branchAddressId', this.branch.id);
					this.$store.dispatch('branchAddressType', 'App\\Branch');
				}
				

				this.$store.dispatch('deleteAddressFieldName', 'country')
				this.$store.dispatch('deleteAddressFieldName', 'province')
				this.$store.dispatch('deleteAddressFieldName', 'city')

				axios.post(this.branchUrlSave, this.branch)
					.then(resp => {
						store.commit('branch', resp.data.branch);
						store.commit('alertMessage', resp.data.message);
						vm.alertSuccess = true
					})
					.catch(error => {
						store.commit('alertMessage', error.response.data);
						vm.alertDanger = true
					})
			},
			exitModal(){

				bus.$emit('activeTab');
				this.$store.commit('showModal', false);
			}
		}
	}
</script>
<style type="text/css" scoped>
	 .alert-icon-float-left {
		  font-size:40px;
		  float:left;
		  margin: 5px;
		  margin-right:20px;
		  color: #403D39;
		  
		}
</style>