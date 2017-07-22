<template>
	<modal v-model="extLinkModal" effect="fade" width="80%" :backdrop="false">

				<!-- custom header -->
		  <div slot="modal-header" class="modal-header">
		    <h4 class="modal-title">
		      <code>{{ product.name }}</code>
		      <span class="pull-right"><a href="/" class="btn btn-success btn-fill" style="border-radius: 5px;"><i class="ti-desktop"> </i> New Productable</a></span>
		    </h4>

		  </div>
		   <div class="modal-body">
		    	<productable-tabs></productable-tabs>
		    </div>
		  <!-- custom buttons -->
		  <div slot="modal-footer" class="modal-footer">
		    <button type="button" class="btn btn-default btn-fill" @click="exitModal">Exit</button>
		  </div>
		  <modal v-model="productableModal" effect="fade" width="80%" :backdrop="false">
		  	<div slot="modal-header" class="modal-header">
		    <h4 class="modal-title">
		      <code>Example</code>
		    </h4>
		  </div>
		  </modal>
	</modal>
</template>

<script type="text/javascript">
	import axios from 'axios'
	import modal from 'vue-strap/src/modal'
	import productableTabs from '../product/productableTabs.vue'
	import alert from 'vue-strap/src/alert'


	export default {

		data(){

			return {

				productableModal: false
			}
		},
		components: {
			modal, productableTabs
		},
		computed: {

			extLinkModal(){

				return this.$store.getters.extLinkModal
			},
			product(){

				return this.$store.getters.product
			}
		},
		methods: {

			exitModal(){

				this.$store.commit('extLinkModal', false)
			}
		}
		
	}
</script>

<style type="text/css" scoped>
	
	.panel-primary{

		border-color: white;
	}

	.panel-heading{
		background-color:white;
	}
</style>