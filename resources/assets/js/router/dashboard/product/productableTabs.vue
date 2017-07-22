<template>
	<tabs v-model="activeTab" nav-style="pills" :justified="true">
	 
	  <tab header="Merchant">
	  <br />
	    <table class="table table-hover">
	    	<thead>
	    		<tr>
		    		<th>Owner</th>
			     	<th>Brand</th>
			     	<th>Price</th>
			     	<th>Quantity</th>
			     	<th>Discounts</th>
			     	<th>Date Created</th>
			     	<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		<tr v-for="(productableMerchant, index) in product.productable_merchants">
		    		<td>{{ productableMerchant.name}}</td>
		    		<td>Brand</td>
		    		<td>{{ productableMerchant.pivot.price}}</td>
		    		<td>{{ productableMerchant.pivot.quantity_id }}</td>
		    		<td>{{ productableMerchantDisc(index) }}</td>
		    		<td>{{ productableMerchant.pivot.created_at}}</td>
		    		<td>
                    	<a href="/" style="font-size:20px;" class="text-success" title="Product Edit" ><span class="fa fa-edit"></span></a>
                    	<a href="/" style="font-size:20px;" class="text-danger" title="Product Delete"><span class="fa fa-trash"></span></a>
                    </td>
	    		</tr>
	    	</tbody>
	     </table>
	  </tab>
	  <tab header="Branch">
	    <br />
	    <table class="table table-hover">
	    	<thead>
	    		<tr>
		    		<th>Owner</th>
			     	<th>Brand</th>
			     	<th>Price</th>
			     	<th>Quantity</th>
			     	<th>Discounts</th>
			     	<th>Date Created</th>
			     	<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		<tr v-for="(productableBranch, index) in product.productable_branches">
		    		<td>{{ productableBranch.branch_name}}</td>
		    		<td>Brand</td>
		    		<td>{{ productableBranch.pivot.price}}</td>
		    		<td>Quantity</td>
		    		<td>{{ productableBranchDisc(index) }}</td>
		    		<td>{{ productableBranch.pivot.created_at}}</td>
		    		<td>
                    	<a href="/" style="font-size:20px;" class="text-success" title="Product Edit" ><span class="fa fa-edit"></span></a>
                    	<a href="/" style="font-size:20px;" class="text-danger" title="Product Delete"><span class="fa fa-trash"></span></a>
                    </td>
	    		</tr>
	    	</tbody>
	     </table>
	  </tab>
	   <tab header="Discounts">
	   <br />
	     <table class="table table-hover">
	     	<thead>
	     		<tr>
		    		<th>Created By</th>
	     			<th>Discounted From</th>
			     	<th>Name</th>
			     	<th>Percent</th>
			     	<th>Start Date</th>
			     	<th>End Date</th>
			     	<th>Action</th>
	    		</tr>
	     	</thead>

	     	<tbody>
	     		<tr v-for="(discount, index) in product.discounts">
	     			<td>{{ createdBy(index) }}</td>
	     			<td>{{ discountedType(index)}} </td>
	     			<td>{{ discount.name }}</td>
	     			<td>{{ discount.percent }}</td>
	     			<td>{{ discount.start }}</td>
	     			<td>{{ discount.end }}</td>
	     			<td>
                    	<a href="/" style="font-size:20px;" class="text-success" title="Product Edit" ><span class="fa fa-edit"></span></a>
                    	<a href="/" style="font-size:20px;" class="text-danger" title="Product Delete"><span class="fa fa-trash"></span></a>
                    </td>
	     		</tr>
	     	</tbody>
	     	
	     </table>
	  </tab>
	  
	</tabs>
</template>

<script type="text/javascript">
	import tabs from 'vue-strap/src/tabs'
	import tab from 'vue-strap/src/tab'
	import axios from 'axios'
	export default {

		data(){

			return {

				activeTab: 0,
			}
		},
		components: {

			tabs, tab
		},
		computed: {

			createdBy(){

				return (index) => {

					return this.product.discounts[index].user.personal_data.lastname + ', ' + this.product.discounts[index].user.personal_data.firstname
				}
			},
			discountedType(){

				return (index) => {

					let discountedType = this.product.discounts[index].discountable_type

					if(this.product.discounts[index].discountable_type == 'App\\Branch'){

						return discountedType.replace('App\\', '') + ' (' + this.product.discounts[index].discountable.branch_name + ')';

					}
					return discountedType.replace('App\\', '') + ' (' + this.product.discounts[index].discountable.name + ')';
				}

			},
			product(){

				return this.$store.getters.product
			},
			productableBranchDisc(){

				return (index) => {

					for(var i=0; i < this.product.discounts.length - 1 ; i++){

						if (this.product.discounts[i].discountable_type == 'App\\Branch'){

							if (this.product.discounts[i].discountable_id == this.product.productable_branches[index].id) {

								return this.product.discounts[i].percent;
							}
						}
					}

					return  ''
				}
			},
			productableMerchantDisc(){

				return (index) => {

					for(var i=0; i < this.product.discounts.length - 1 ; i++){

						if (this.product.discounts[i].discountable_type == 'App\\Merchant'){

							if (this.product.discounts[i].discountable_id == this.product.productable_merchants[index].id) {

								return this.product.discounts[i].percent;
							}
						}
					}

					return  ''
				}

			}
		}

	}
</script>