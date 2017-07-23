<template>
	<div>
		<div class="form-group">
			<label>Birth Place</label>
	        <select class="form-control border-input" @change="getStates">
	            <option value="">Select Country </option>
	            <option v-for="country in countries">{{ country.name }}</option>
	        </select>
        </div>

        <div class="form-group" v-show="state">
	        <select class="form-control border-input">
	            <option value="">Select State/Province </option>
	            <option v-for="country in countries">{{ country.name }}</option>
	        </select>
        </div>

        <div class="form-group" v-show="city">
	        <select class="form-control border-input">
	            <option value="">Select City </option>
	            <option v-for="country in countries">{{ country.name }}</option>
	        </select>
        </div>
	</div>
</template>

<script type="text/javascript">
	
import axios from 'axios'

export default{

	data() {

		return {
			state: false,
			city: false,
			location: window.location.origin + '/'
		}
		
	},

	computed: {

		countries(){

			return this.$store.state.countries
		}
	},
	created(){

		var store = this.$store

		axios.get(`${this.location}/api/countries`)
			.then(function(response){

				store.commit('countries', response.data.countries)
			})
			.catch(function(response){

			})

	},
	methods: {

		getStates() {


		}
	}
}
</script>