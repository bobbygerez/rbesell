<template>
	<div>
		<div class="sidebar-title-section">{{ title }}</div>
	            <select class="form-control" v-model="province" style="margin-bottom: 5px;">
	                <option value="">Select Province </option>
	                <option :value="province.provCode" v-for="province in provinces">{{ province.provDesc }}</option>
	            </select>
	            <select class="form-control" v-model="city" :class="{ hideVisible : cityInvisible }" style="margin-bottom: 5px;">
	                <option value="">Select Municipality </option>
	                <option :value="city.citymunCode" v-for="city in cities">{{ city.citymunDesc }}</option>
	            </select>
	            <select class="form-control" v-model="brgy" :class="{ hideVisible : brgyInvisible }">
	                <option value="">Select Barangay </option>
	                <option :value="brgy.brgyCode" v-for="brgy in barangays">{{ brgy.brgyDesc }}</option>
	            </select>
    </div>
</template>

<script type="text/javascript">
	
 import Vue from 'vue'
 import axios from 'axios'

	export default{

		props: ['source', 'title'],
		data(){

			return {

				provinces : {},
				province : '',
				cities: {},
				city: '',
				barangays: {},
				brgy: '',
				cityInvisible: true,
				brgyInvisible: true,
				mainCategoryId: '',
				merchantCategoryId: '',
				merchantSubId: '',
				products: {}

			}
		},
		created(){

			this.fetchedProvinceData()
		},
		methods: {

			fetchedProvinceData(){
				var vm = this
				axios.get(this.source+'/provinces')
				.then(function(response){

					Vue.set(vm.$data, 'provinces', response.data.provinces)
				})
				.catch( function(response){

					console.log(response)
				})


			},

			
		},

		watch: {

			province: function(){

				var vm = this

				if(this.province != '')
					this.cityInvisible = false

				else
					this.cityInvisible = true
					this.brgyInvisible = true

				if(this.province != '')
					axios.get(this.source + '/cities/' + this.province)
					.then(function(response){

						Vue.set(vm.$data, 'cities', response.data.cities);
					})
					.catch( function(response){

						console.log(response)
					})

				
			},

			city: function(){

				if(this.city != '')
					this.brgyInvisible = false
				else
					this.brgyInvisible = true
				var vm = this
				axios.get(this.source + '/barangays/' + this.city)
				.then(function(response){

					Vue.set(vm.$data, 'barangays', response.data.barangays)
				})
				.catch( function(response){

					console.log(response)
				})

				this.fetchedProductData()
			},

			brgy: function(){

				this.fetchedProductData()
			}


		}


	}
</script>