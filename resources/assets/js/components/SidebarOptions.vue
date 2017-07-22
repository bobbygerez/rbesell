<template>
	<div>
		<div class="sidebar-categories">
	        <div class="shop-sidebar">
	            <div class="sidebar-title">Shop By</div>
	            <div class="shop-sidebar-content">
	                <div class="categories-sidebar">
	                    <div class="sidebar-title-section">Sub Categories </div>
	                    <div class="categories-checkbox">
	                        <ul class="categories-list-wrap">
	                            <li v-for="mainCat in mainCategories">
	                            <input type="checkbox" :value="mainCat.merchantCatId" v-model="checkedCategories"  @click="check($event)" id="mainCat.merchantCatId"><label style="color: black">{{ mainCat.merchantCatName }} </label> <span style="color: gray">({{ mainCat.productsCount}})</span></li>

	                        </ul>
	                    </div>
	                </div>
	                <div class="price-sidebar">
	                    <div class="sidebar-title-section">Price</div>
	                    <div class="price-filter">
	                        <div class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
	                            <div class="filter-top">
	                                <span class="amount">$1</span>
	                                <span class="amount2">$150</span>
	                                <a class="button orange" href="#">Search</a>
	                            </div>
	                            <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
	                            <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;">
	                        <span class="amount">$1</span>
	                    </span>
	                            <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;">
	                    <span class="amount2">$150</span>
	                </span>
	                        </div>
	                    </div>
	                </div>
	                <div class="manufacture-sidebar">
	                    <div class="sidebar-title-section">Manufacture</div>
	                    <div class="categories-checkbox">
	                        <ul class="brands">
	                            <li><input type="checkbox" value="Ercol"><label>Ercol</label></li>
	                            <li><input type="checkbox" value="Duresta"><label>Duresta</label></li>
	                            <li><input type="checkbox" value="G Plan"><label>G Plan</label><br>
	                            <li><input type="checkbox" value="Parker Knoll"><label>Parker Knoll</label></li>
	                            <li><input type="checkbox" value="Collins & Hayes"><label>Collins & Hayes</label></li>
	                        </ul>
	                    </div>
	                </div>
	                <div class="color-sidebar">
	                    <div class="sidebar-title-section">Color</div>
	                    <div class="color-sidebar-content">
	                        <div class="box-color box-color-orange"></div>
	                        <span>(3)</span>
	                    </div>
	                    <div class="color-sidebar-content">
	                        <div class="box-color box-color-brown"></div>
	                        <span>(3)</span>
	                    </div>
	                    <div class="color-sidebar-content">
	                        <div class="box-color box-color-red"></div>
	                        <span>(4)</span>
	                    </div>
	                    <div class="color-sidebar-content">
	                        <div class="box-color box-color-black"></div>
	                        <span>(5)</span>
	                    </div>
	                    <div class="color-sidebar-content">
	                        <div class="box-color box-color-white">CYAL</div>
	                        <span>(2)</span>
	                    </div>
	                    <div class="color-sidebar-content">
	                        <div class="box-color box-color-cyan"></div>
	                        <span>(2)</span>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="compare-sidebar">
	            <div class="sidebar-title">Compare Products</div>
	            <div class="compare-sidebar-content">You Have No Item Compare</div>
	        </div>
	        <div class="bestseller-sidebar">
	            <div class="sidebar-title">Bestseller Products</div>
	            <div class="bestseller-sidebar">
	                <ul class="bestseller-list">
	                    <li class="bestseller-item">
	                        <a href="#"><img src="assets/images/sb-cat1.jpg" alt="sb" height="130" width="112"></a>
	                        <div class="bestseller-content">
	                            <a href="#" class="bestseller-text">Washing Machine Pro</a>
	                            <span>$1000.00</span>
	                        </div>
	                    </li>
	                    <li class="bestseller-item">
	                        <a href="#"><img src="assets/images/sb-cat2.jpg" alt="sb" height="130" width="112"></a>
	                        <div class="bestseller-content">
	                            <a href="#" class="bestseller-text">Washing Machine Pro</a>
	                            <span>$1000.00</span>
	                        </div>
	                    </li>
	                    <li class="bestseller-item">
	                        <a href="#"><img src="assets/images/sb-cat3.jpg" alt="sb" height="130" width="112"></a>
	                        <div class="bestseller-content">
	                            <a href="#" class="bestseller-text">Washing Machine Pro</a>
	                            <span>$1000.00</span>
	                        </div>
	                    </li>
	                </ul>
	            </div>
	        </div>
	        <div class="tag-sidebar">
	            <div class="sidebar-title-section">Popular Tags</div>
	            <ul class="tag-list-sidebar">
	                <li class="tag-sidebar-item"><a href="#">Mobile</a></li>
	                <li class="tag-sidebar-item"><a href="#">Adss</a></li>
	                <li class="tag-sidebar-item"><a href="#">Masem</a></li>
	                <li class="tag-sidebar-item"><a href="#">Mudd</a></li>
	                <li class="tag-sidebar-item"><a href="#">Atimo</a></li>
	            </ul>
	            <a href="#" class="view-all-tags">View All Tags<i class="fa fa-caret-right" aria-hidden="true"></i></a>
	        </div>
	    </div>
	</div>
</template>

<script>

	import Vue from 'vue'

	export default{

		data(){

			return {
				checkedCategories: [],
				mainCategories: {},
				id: []
			}
		},

		created(){
			bus.$on('did-something', data => this.mainCategories = data);
		},

		methods: {

			check: function(e){

				bus.$emit('merchant-categories', this.checkedCategories)				
			}
		}
	}

</script>