<template>
	<div class="products-categories">
		<div class="product-box" v-for="product in products.data" >
            <div class="product-box-content">
                <figure class="img-product">
                    <img :src="'../../'+ photo.path" alt="product" height="207" width="175" v-for="photo in product.photos" v-if="photo.is_primary === 1">
                        <a href="#" class="flaticon-search"></a>
                </figure>
                <div class="product-box-text">
                    <a href="#" class="product-name">{{ product.name }}</a>
                    <a href="#" class="write">Write Your Review</a>
                    <p class="product-cost">$200.00</p>
                    <p class="desc-product">
                    </p>
                    <div class="product-box-bottom">
                       <a href="#" class="add-to-cart"><i class="flaticon-commerce"></i>Add To Cart</a>
                       <a href="#" class="wishlist"><i class="flaticon-like"></i></a>
                       <a href="#" class="refresh-product"><i class="flaticon-arrows"></i></a>
                    </div>
                 </div>

            </div>
     </div>

    </div>
</template>

<script type="text/javascript">
	import Vue from 'vue'
	import axios from 'axios'
	export default{

		props: ['src'],
		data(){

			return {

				products : {}
			}
		},
		created(){

			this.fetchedProductData()

		},
		methods: {

			fetchedProductData(){
				var vm = this
				var pathArray = window.location.pathname.split( '/' );
					 
					switch (pathArray.length-2){
						case 2:
							this.mainCategoryId = pathArray[pathArray.length - 1]
							break

						case 3:
							this.merchantCategoryId = pathArray[pathArray.length - 1]
							break

						case 4:
							this.merchantSubId = pathArray[pathArray.length - 1]
							break
					}


				axios.get( `${this.src}?mainCategoryId=${this.mainCategoryId}&merchantCategoryId=${this.merchantCategoryId}&merchantSubId=${this.merchantSubId}&provCode=${this.province}&citymunCode=${this.city}&brgyCode=${this.brgy}`)
					.then(function(response){
						
						Vue.set(vm.$data, 'products', response.data.products) 
					})
					.catch(function(response){
						console.log(response)
					})
			}
		}

	}
</script>
