<template>
  <div>
     <div class="panel-categories">
        <div class="row">
            <div class="col-lg-3">
                <div class="view-categories" style="padding: 25px">
                    <div class="click-grid color-active">
                        <i class="flaticon-four-grid-layout-design-interface-symbol"></i>
                    </div>
                    <div class="click-list">
                        <i class="flaticon-squares-gallery-grid-layout-interface-symbol"></i>
                    </div>
                     
                </div>
            </div>
            <div class="col-lg-3" style="padding: 25px">
                <strong>Showing {{ products.from }}  - {{ products.to }} from {{ products.total }}</strong>
            </div>
            
            <div class="col-log-6">
               
                <div class="page-nav">
                    <paginate
                        :page-count="products.last_page"
                        :page-range="2"
                        :margin-pages="2"
                        :click-handler="clickCallback"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'"
                        :page-class="'page-item'">
                      </paginate>
                  </div>
            </div>
        </div>
    </div>
     <div class="products-categories">
        <span v-for="product in products.data">
            <div class="product-box">
                <div class="product-box-content">
                    <figure class="img-product">
                        <img :src="windowLocation +  product.photo" alt="product" height="207" width="175">
                        <a href="#" class="flaticon-search"></a>
                    </figure>
                    <div class="product-box-text">
                        <a href="#" class="product-name">{{ product.productName }} </a>
                        <a href="#" class="write">Write Your Review</a>
                        <p class="product-cost" v-html="'&#8369; ' + product.price"></p>
                        <p class="desc-product">{{ product.desc }}
                        </p>
                        <div class="product-box-bottom">
                            <a href="#" class="add-to-cart" style="width: 100%">{{ product.merchantName }}</a>
                        </div>
                    </div>

                </div>
            </div>
            
        </span>
        <spinner ref="spinner" global v-model="spinner" size="lg" fixed text="Loading Products..."></spinner>
        
    </div>
  </div>  

</template>

<script>
    
    import Vue from 'vue'
    import axios from 'axios'
    import Paginate from 'vuejs-paginate'
    import Spinner from 'vue-strap/src/Spinner'
    import lodash from 'lodash'

    Vue.component('paginate', Paginate)

    export default{
        props: ['source'],

        data() {
            
            return {

                spinner: true,
                products: {

                    last_page: 3
                },
                query: {
                    page: 1,
                    from: '',
                    to: '',
                    per_page: 20,
                    direction: 'asc'
                },
                mainCategoryId: '',
                merchantCategoryId: '',
                merchantSubId: '',
                windowLocation: window.location.origin + '/',
                checkedCategories: []

            }

        },
        components: {
            Spinner
        },
        created(){

            this.fetchedProduct()
            bus.$on('merchant-categories', data => this.checkedCategories = data)
            
        },
        methods: {

            fetchedProduct: _.debounce(function(){

                this.$root.$emit('spinner::show')

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

                axios.get(`${this.source}?&mainCategoryId=${this.mainCategoryId}&per_page=${this.query.per_page}&page=${this.query.page}&checkedMerchantCat=${this.checkedCategories}`)
                    .then(function(response){

                        var data = response.data.merchantCategories 
                        
                        Vue.set(vm.$data, 'products', response.data.products)

                        bus.$emit('did-something', data);


                    })
                    .catch(function(response){

                        console.log(response)
                    })

                this.hideSpinner()
            }, 500),

            clickCallback: function(pageNum) {
              
              this.query.page = pageNum
              this.fetchedProduct()
            },

            hideSpinner: _.debounce( function(){
                this.$root.$emit('spinner::hide')
            }, 1000)
        },

        watch: {

            checkedCategories: function(){

                this.fetchedProduct()
            }
        }
    }
</script>



