<template>
	<div class="container">
		<h1>{{ title }}</h1>

		<div class="row">
			<table class="table table-hover">
				<tr>
					<th v-for="column in columns">{{ column }}</th>
				</tr>
				<tr v-for="row in model.data">
					<td>{{ row.id }}</td>
					<td>{{ row.model_number }}</td>
					<td>{{ row.name }}</td>
					<td>{{ row.unit.name }}</td>
					<td>{{ row.desc }}</td>
					<td>{{ row.discount }}</td>
					<td style="padding:20px;">
						<img :src="'../../' + photo.path" v-for="photo in row.photos" v-if="photo.is_primary === 1" width="100">
					</td>
				</tr>
			</table>
		</div>
	</div>
</template>

<script type="text/javascript">

import Vue from 'vue'
import axios from 'axios'

export default{
	props: ['source', 'title'],
	data(){

		return {

			columns: {},
			model: {}
		}
	},
	created(){

		this.fetchProductData()
	},
	methods: {
		fetchProductData(){
			var vm = this
			axios.get(this.source)
			.then(function(response){
				Vue.set(vm.$data, 'columns', response.data.columns)
				Vue.set(vm.$data, 'model', response.data.model)
			})
			.catch(function(response){
				console.log(response)
			})
		}

	}

}

</script>
