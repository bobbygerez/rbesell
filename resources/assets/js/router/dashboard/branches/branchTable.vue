<template>
	<table class="table table-hover user-table">
	<caption>
	  <p class="text-center">Page {{ branches.current_page }} of {{ branches.last_page }} <br /> Display {{ branches.from }} to {{ branches.to }} out of {{ branches.total }}</p>
	</caption>
    <thead>
      <tr>
      	
        <th>Branch Name</th>
        <th>Telephone</th>
        <th>Mobile</th>
        <th>Merchant Name</th>
        <th>Website</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <tr v-for="branch in branches.data">
      	 <td>{{ branch.branch_name }}</td>
      	 <td>{{ branch.phone_no }}</td>
      	 <td>{{ branch.mobile_no }}</td>
      	 <td>{{ branch.merchant.name }}</td>
      	 <td>{{ branch.merchant.website }}</td>
      	 <td>{{ branch.email }}</td>
      	 <td v-if="branch.status"><span class="label label-success"> <i class="fa fa-check"> </i></span></td>
	     <td v-else><span class="label label-danger"> <i class="fa fa-times"> </i></span></td>
	      <td>
	        <a href="/" style="font-size:20px;" class="text-success" title="Edit" @click="editBranch($event, branch.id)"><span class="fa fa-edit"></span></a>
	        <a href="/" style="font-size:20px;" class="text-danger" title="Delete"><span class="fa fa-trash"></span></a>
	      </td>
      </tr>
    </tbody>
  </table>
</template>
<script type="text/javascript">

import axios from 'axios'

export default{

	data(){

		return {
			windowLocation: window.location.origin + '/'
		}
	},
	created(){

		this.getBranches()
		bus.$on('changePage', () => {
			this.getBranches()
		})

	},
	computed: {

		branch(){

			return this.$store.getters.branch
		},
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

		getBranches(){
			var store = this.$store

			axios.get( this.windowLocation + 'api/branches?page=' + this.page + '&per_page=' + this.per_page)
				.then(function(response){
					store.commit('branches', response.data.branches);
				})
				.catch(function(){

				})
		},
		editBranch(e, id){


			var store = this.$store
			e.preventDefault()
			axios.get( this.windowLocation + 'api/branches/' + id + '/edit')
				.then(res => {
					store.commit('branch', res.data.branch);
					store.commit('showModal', true);
				})
				.catch( res => {

				})

			this.$store.watch((state) => {

				return state.branch;

			}, () => {

				bus.$emit('dropZoneImages', this.branch);

			}, {

				deep: true
			});
			
			
		}
	}
}
</script>

<style type="text/css" scoped>
  tr:hover{
    cursor: auto;
  }
</style>