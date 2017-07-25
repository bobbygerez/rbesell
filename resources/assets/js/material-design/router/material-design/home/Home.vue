<template>
	<div>
		<bread-crumb></bread-crumb>
		<products-view></products-view>
		<products-view></products-view>
		<products-view></products-view>
		<bread-crumb></bread-crumb>
	</div>
</template>
<script type="text/javascript">
	import ProductsView from '../../../layouts/cards/products.vue'
	import BreadCrumb from '../../../layouts/breadcrumbs/location.vue'
	export default {

		components: {

			ProductsView, BreadCrumb
		}
	}
</script>