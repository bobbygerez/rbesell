<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="row">
            <div class="header">
              <div class="col-lg-12">
                  <p><a href="/" class="btn btn-success btn-fill" style="border-radius: 5px;"><i class="ti-desktop"> </i> New Product</a></p>
                  <div class="col-lg-6">
                      <div style="margin-top: 25px;">
                          <v-select
                            v-model="selectedProduct"
                            :on-change="onChangeProduct"
                            :debounce="250"
                            :on-search="getOptions"
                            :options="options"
                            placeholder="Search Product..."
                            value="id"
                            label="name"
                          >
                          </v-select>
                      </div>
                  </div>
                   <div class="col-lg-6">
                    <div class="pull-right">
                        <paginate
                        :page-count="products.last_page"
                        :containerClass="'pagination'"
                        :click-handler="clickHandler"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'className'">
                      </paginate>
                    </div>
                  </div>
                  <div class="content table-responsive table-full-width">
                  <table class="table table-hover user-table">
                    <thead>
                      <tr>
                        <th>Owner</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>SKU</th>
                        <th>Date Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody >
                      <tr v-for="(product, index) in products.data" >
                        <td>{{ owner(index)}}</td>
                        <td> {{ product.name }}</td>
                        <td>{{ product.brand.name }}</td>
                        <td> {{ product.SKU }}</td>
                        <td>{{ product.created_at}}</td>
                        <td style="width: 150px;">
                           <a href="/" style="font-size:20px;" class="text-warning" title="Productables and Discounts" @click="showExtLinkModal($event, product.id)"><i class="fa fa-external-link-square" aria-hidden="true"></i></a>

                          <a href="/" style="font-size:20px;" class="text-success" title="Product Edit" @click="editProduct($event, product.id)"><span class="fa fa-edit"></span></a>
                          <a href="/" style="font-size:20px;" class="text-danger" title="Product Delete"><span class="fa fa-trash"></span></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
              </div>
            </div><!--header end -->
          </div>

        </div>
      </div>
    </div>
    <external-link></external-link>
  </div>
</template>

<script type="text/javascript">
	
import axios from 'axios'
import paginate from 'vuejs-paginate'
import vSelect from 'vue-select'
import externalLink from '../product/externalLink.vue'

	export default {

    data(){

      return  {

          selectedProduct: '',
          options: [],
      }
    },
		created(){

			this.$store.commit('title', 'All Products');
      this.$store.commit('page', 1);
      this.$store.commit('per_page', 10);
		},

    components: {
        paginate, vSelect, externalLink
    },

    computed: {

      page(){

          return this.$store.getters.page
      },
      per_page(){

          return this.$store.getters.per_page
      },
      products(){

        return this.$store.getters.products
      },

      owner(){
        return (index) => {

            if (this.$store.getters.products.data[index].productable_type == 'App\\User'){

                return 'JMC Product'
            }

            if (this.$store.getters.products.data[index].productable_type == 'App\\Merchant'){

                return 'Merchant (' + this.$store.getters.products.data[index].productable.name + ')'
            }

            if (this.$store.getters.products.data[index].productable_type == 'App\\Branch'){

                return 'Branch (' + this.$store.getters.products.data[index].productable.branch_name + ')'
            }


        }
      },
      quantities(){

       return (index) => {
            
           return this.$store.getters.products.data[index].quantities.map((q)=>q.qty).reduce(function(total, q) {
                 return total + q}, 0) 
        }
      },
    },
		methods: {

      showExtLinkModal(e, productId){

        e.preventDefault()
        var store = this.$store;
        axios.get(window.location.origin + '/api/product/' + productId + '/edit?page=' + this.page + '&per_page=' + this.per_page)
          .then(res => {
            store.commit('product', res.data.product);
          })
          .catch()


        this.$store.commit('extLinkModal', true);
      },
			index(){
        var store = this.$store
				axios.get(window.location.origin + '/api/product?page=' + this.page +'&per_page=' + this.per_page)
          .then(resp => {

              store.commit('products', resp.data.products);

          })
          .catch()
			},

      clickHandler(val){

        this.$store.commit('page', val);
      },

       getOptions(search, loading) {

        loading(true)
        axios.post( window.location.origin + '/api/product-search', {
           q: search
        }).then(resp => {
           this.options = resp.data.products
           loading(false)
        }).catch( resp => {
            loading(false)
        })


      }, 
      onChangeProduct(value){

        var store = this.$store
        if (value != '' ) {

          if(value != null){

            axios.get( window.location.origin + '/api/product/' + value.id + '?page=1&per_page=1')
            .then(resp => {
              store.commit('products', resp.data.products);
            }).catch( resp => {
                
            })
          }
          else{
            store.commit('page', 1)
            store.commit('per_page', 10)
            this.index()
          }
            
        }

           
      },
      editProduct(e, productId){

      }
		},
    watch: {

      page(){

          this.index()
      }
    }

	}

</script>

<style type="text/css" scoped>
  tr:hover{
    cursor: auto;
  }
</style>