<template>
	<div class="container-fluid">
		 <div class="row">
            <div class="col-lg-12">
                <div class="card">
                  <div class="row">
                      <div class="header">
                        <div class="form-group">
                            <div class="col-lg-4">
                             <input type="text" class="form-control border-input" placeholder="Search Product Name" v-model="productName">
                             </div>
                             <div class="col-lg-4 ">
                              <select class="form-control border-input" v-model="branchName">
                                  <option value="">Select Branch</option>
                                  <option v-for="branch in branches">{{ branch.branch_name }}</option>
                              </select>
                             </div>
                             
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <p class="resultSummary">Display {{ products.from }} to {{ products.to }} from {{ products.total }}</p>
                    </div>
                    <div class="col-lg-6">
                      <div class="pull-right">
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
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="divTable">
                          <div class="divTableBody">
                            <div class="divTableRow" >
                              <div class="divTableCell"><strong>Branch</strong></div>
                              <div class="divTableCell"><strong>Product Name</strong></div>
                              <div class="divTableCell"><strong>Price</strong></div>
                              <div class="divTableCell"><strong>Discounts</strong></div>
                              <div class="divTableCell"><strong>Quantity</strong></div>
                              <div class="divTableCell"><strong>Created At</strong></div>
                               <div class="divTableCell"><strong>Action</strong></div>
                            </div>
                            <div class="divTableRow" v-for="(product, index) in products.data">
                              <div class="divTableCell">{{ product.branch}}</div>
                              <div class="divTableCell">{{ product.name }} </div>
                              <div class="divTableCell" v-html=" '&#8369; ' + product.price">
                              </div>
                              <div class="divTableCell">{{ product.discount2 }}%</div>
                              <div class="divTableCell">{{ quantities(index) }}</div>
                              <div class="divTableCell">{{ product.date }}</div>
                               <div class="divTableCell action">
                                 <a href="/" @click="editProduct($event, product.id)"><span class="fa fa-edit" ></span></a>
                                 <a href="/" class="text-danger" @click="confirmDelete($event, product.id)"><span class="ti-trash"></span></a>
                               </div>
                            </div>
                          </div>
                        </div>
                        <!-- DivTable.com -->
                    </div>
                   </div>
                </div>
            </div>


        </div>

        <modal v-model="show" effect="fade" large >
          <!-- custom header -->
          <div slot="modal-header" class="modal-header">
            <h4 class="modal-title">{{ product.name }} </h4>
            
          </div>

          <div class="modal-body"> 
            
            <tabs v-model="activeTab" nav-style="tabs" justified>
              <tab header="Product Information">
                <br />
                <div class="row">
                  <div class="col-lg-12">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Branch Name: </label>
                        <select class="form-control border-input">
                          <option v-for="(branch, key) in product.branches" disabled v-if="key==0" selected>{{ branch.branch_name }}</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Model Number: </label>
                        <input type="text" class="form-control border-input" v-model="product.model_number" >
                      </div>
                      <div class="form-group">
                        <label>Product Name: </label>
                        <input type="text" class="form-control border-input" v-model="product.name">
                      </div>
                      <div class="form-group">
                        <label>Description:</label>
                        <textarea class="form-control border-input" v-model="product.desc">

                        </textarea>
                      </div>
                      
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Discount:</label>
                        <input type="number" class="form-control border-input" v-model="productDiscount" max="2">
                      </div>
                      <div class="form-group">
                      <label>Unit:</label>
                        <select class="form-control border-input" v-model="product.unit_id">
                           <option>Select Unit</option>
                           <option v-for="unit in units" :value="unit.id">{{ unit.name }} </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Created By:</label>
                        <input type="text" class="form-control border-input" v-model="name" disabled>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
              </tab>
              <tab header="Prices and Quantities">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="col-lg-6">
                   
                     <div class="divTable">
                        <div class="divTableBody">
                          <div class="divTableRow">
                            <div class="divTableCell"><strong>Price</strong></div>
                            <div class="divTableCell"><strong>Date Added</strong></div>
                          </div>
                          <div class="divTableRow"  v-for="price in product.prices">
                            <div class="divTableCell">
                                <div class="radio radio-success" v-if="price.is_primary == 1">
                                 <input :id="price.id" type="radio" :value="price.id" name="productPrice" checked>
                                 <label :for="price.id">
                                  <strong>&#8369; {{ price.price }} </strong>
                                </label>
                              </div>
                              <div v-else>
                               {{ price.price }}
                              <a href="/" @click="deletePrice($event, price.id)" class="text-danger"><span class="fa fa-trash"></span></a>
                            </div>
                          </div>
                          <div class="divTableCell">{{ price.created_at }}</div>
                          
                          </div>
                        </div>
                      </div>
                     
                     <div class="form-group">
                        <label>New Price:</label>
                        <input type="number" step="0.01" class="form-control border-input input-sm" style="height: 28px; width: 150px;" v-model="newPrice">
                        <button type="button" class="btn btn-danger btn-xs" style="margin-top: 5px;" @click="addNewPrice($event)">Add New Price</button>
                      </div>
                     
                    </div>
                    <div class="col-lg-6">
                      <div class="row">
                       <div class="pull-left">
                        <div class="divTable">
                          <div class="divTableBody">
                            <div class="divTableRow">
                              <div class="divTableCell"><strong>Quantity</strong></div>
                              <div class="divTableCell"><strong>Date Added</strong></div>
                            </div>
                            <div class="divTableRow" v-for="quantity in product.quantities">
                              <div class="divTableCell" style="text-align: center;">
                              {{ quantity.qty }}
                                 <a href="/" class="text-danger" @click="deleteProductQuantity($event, quantity.id)"><span class="fa fa-trash"></span></a>
                              </div>
                              <div class="divTableCell">{{ quantity.created_at }}</div>
                            </div>
                            <div class="divTableRow">
                              <div class="divTableCell" style="text-align: center;">
                                <div class="radio radio-success" >
                                 <input type="radio" name="totalQuantity" checked>
                                 <label>
                                  <strong>{{ productQuantity }}</strong>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- DivTable.com -->
                    </div>

                  </div>

                     <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label>New Quantity:</label>
                          <input type="number" class="form-control border-input input-sm" style="height: 28px; width: 150px;" v-model="newQuantity">
                          <button type="button" class="btn btn-default btn-xs" style="margin-top: 5px;" @click="addNewQuantity($event)">Add New Quantity</button>
                        </div>
                      </div>
                    </div>

                  </div>
                  </div>
                </div>
               
              </tab>

              <tab header="Photos">

                

              </tab>
           
          </tabs>
           </div>
          <div slot="modal-footer" class="modal-footer">
              <div class="pull-right" style="margin-right: 50px;">
                <button type="button" class="btn btn-default" @click="exitModal">Exit</button>
                <button type="button" class="btn btn-success" @click="saveMethod">Save</button>
              </div>
                    
          </div>

          <alert v-model="showAlert" placement="top" duration="4000" type="success" width="400px" dismissable>
            <span class="icon-info-circled alert-icon-float-left"></span>
            <strong>Success!</strong>
            <p>{{ alertMessage }}</p>
          </alert>
       </modal>

        <modal v-model="productDelete" effect="fade" large width="40%">
            <!-- custom header -->
            <div slot="modal-header" class="modal-header">
              <h4 class="modal-title text-center" >Are you sure you want to delete {{ product.name }}? </h4>
              
            </div>

             <div class="modal-body"> 
               <div class="text-center">
                <button type="button" class="btn btn-default" @click="productDelete = false">Exit</button>
                <button type="button" class="btn btn-danger" @click="deleteProduct($event)">Confirm Delete</button>
                </div>
              </div>

             <div slot="modal-footer" class="modal-footer">
                    
          </div>
        </modal>

        <alert v-model="alertDelete" placement="top" duration="4000" type="success" width="400px" dismissable>
            <span class="icon-info-circled alert-icon-float-left"></span>
            <strong>Success!</strong>
            <p>{{ alertMessage }}</p>
        </alert>

	</div>
</template>

<script type="text/javascript">

import axios from 'axios'
import modal from 'vue-strap/src/modal' 
import Paginate from 'vuejs-paginate'
import lodash from 'lodash'
import tabs from 'vue-strap/src/tabs'
import tab from 'vue-strap/src/tab'
import alert from 'vue-strap/src/alert'

export default{
  components: {
    modal,
    Paginate,
    tabs,
    tab,
    alert,
  },
  data() {

      return {

          show: false,
          windowLocation: window.location.origin + '/',
          currentPage: 1,
          productName: '',
          branchName: '',
          productId: '',
          activeTab: 0,
          newPrice: '',
          showAlert: false,
          priceId: '',
          newQuantity: '',
          quantityId: '',
          csrf: '',
          productDelete: false,
          alertDelete: false,
         
      }
  },

  computed: {
    
    branches(){
      return this.$store.getters.branches
    },
    products(){
      return this.$store.getters.products
    },
    product(){
      return this.$store.getters.product
    },

    productDiscount: {
        get: function(){

          return this.product.discount2
        },
        set: function(value){

          length = value.length
          if (length > 2) {
            return false
          }
          this.product.discount2 = value
        }
    },
    quantities(){

       return (index) => {
            
           return this.$store.getters.products.data[index].quantities.map((q)=>q.qty).reduce(function(total, q) {
                 return total + q}, 0) 
      }
    },

    productQuantity(){
       return this.$store.getters.product.quantities.map((q)=>q.qty).reduce(function(total, q) {
                 return total + q}, 0)
    },
    
    name(){

     return this.$store.getters.product.user.personal_data.firstname + ' ' + this.$store.getters.product.user.personal_data.firstname
    },
    units(){

      return this.$store.getters.units
    },
    alertMessage(){

      return this.$store.getters.alertMessage
    }
  },

  created(){

      this.$store.commit('title', 'All Products')
      this.fetchProducts()


  },

  methods: {
    fetchProducts(){

      var store = this.$store
      axios.get(`${this.windowLocation}api/product?&current_page=${this.currentPage}&productName=${this.productName}&branchName=${this.branchName}`)
          .then( function(response){

              store.commit('branches', response.data.branches)
              store.commit('products', response.data.products);
          })
          .catch(function(response){

            console.log(response)
          })
      
    },
     clickCallback: function(pageNum) {
              
         this.currentPage = pageNum    
    },

    editProduct: function($event, $productId){
        $event.preventDefault()
        this.productId = $productId
        var store = this.$store
        axios.get(`${this.windowLocation}api/product/${this.productId}/edit`)
          .then( function(response){
              store.commit('product', response.data.product)
              store.commit('units', response.data.units)
          })
          .catch( function(){

          })
        this.show = true
    },
    confirmDelete: function($event, $productId){
      $event.preventDefault()
        this.productId = $productId
        var store = this.$store
        axios.get(`${this.windowLocation}api/product/${this.productId}/edit`)
          .then( function(response){
              store.commit('product', response.data.product)
              store.commit('units', response.data.units)
          })
          .catch( function(){

          })

        this.productDelete = true
    },
    deleteProduct($event){

      var store = this.$store
      axios.delete(`${this.windowLocation}api/product/${this.productId}`)
      .then(function(response){

          store.commit('alertMessage', response.data.message);

      }).catch( function(response){

      });

      this.alertDelete = true
      this.productDelete = false
      this.fetchProducts()
    },
    addNewPrice: function(event){

      var store = this.$store

      axios.put(`${this.windowLocation}api/price/${this.productId}`,{

          price: this.newPrice
      }).then(function(response){

          store.commit('alertMessage', response.data.message);

      }).catch( function(response){

      });

      this.newPrice = ''
      this.editProduct(event, this.productId)
      this.showAlert = true

    },
    deletePrice: function(e, priceId){
      e.preventDefault()
      this.priceId = priceId
      var store = this.$store
      axios.delete(`${this.windowLocation}api/price/${this.priceId}`)
        .then( function(response){

          store.commit('alertMessage', response.data.message)

        })
        .catch( function(response){

        })

      this.editProduct(event, this.productId)
      this.showAlert = true
    },
    addNewQuantity: function(e){

      var store = this.$store;

      axios.post(`${this.windowLocation}api/quantity`, {

          quantity: this.newQuantity,
          productId: this.productId

      }).then( function(response){

          store.commit('alertMessage', response.data.message);

      })

      .catch( function(response){

      })
      this.editProduct(e, this.productId)
      this.newQuantity = ''
      this.showAlert = true
    },
    deleteProductQuantity: function(e, quantityId){
      e.preventDefault()
      this.quantityId = quantityId
      var store = this.$store
      axios.delete(`${this.windowLocation}api/quantity/${this.quantityId}`)
      .then( function(response){

          store.commit('alertMessage', response.data.message)
      })

      .catch( function(response){


      })
      this.editProduct(e, this.productId)
      this.showAlert = true
    },

    saveMethod(){

      let store = this.$store

      axios.put(`${this.windowLocation}api/product/${this.productId}`,{

          model_number : this.product.model_number,
          name: this.product.name,
          desc: this.product.desc,
          unit_id: this.product.unit_id,
          discount2: this.productDiscount

      }).then(function(response){

          store.commit('alertMessage', response.data.message)

      })

      .catch(function(response){

      })

      this.showAlert = true
    },
    exitModal(){

      this.show = false
      this.fetchProducts()
    }
  },
  watch: {

    currentPage(){

      this.fetchProducts()
    },

    productName: _.debounce( function(){

      this.fetchProducts()
    }, 500),

    branchName: _.debounce( function(){

      this.fetchProducts()
    }, 500)
  }
  
}

</script>

<style type="text/css" scope>
  /* DivTable.com */
  .divTable{
    margin: 10px;
    display: table;
    width: 98%;
  }
  .divTableRow {
    display: table-row;
  }
  .divTableHeading {
    background-color: #EEE;
    display: table-header-group;
  }
  .divTableCell, .divTableHead {
    border: 1px solid #999999;
    display: table-cell;
    padding: 3px 10px;
  }
  .divTableHeading {
    background-color: #EEE;
    display: table-header-group;
    font-weight: bold;
  }
  .divTableFoot {
    background-color: #EEE;
    display: table-footer-group;
    font-weight: bold;
  }
  .divTableBody {
    display: table-row-group;
  }

/* Pagination Bootstrap */
  .pagination{

    margin-right: 20px;
  }

  .action{

    font-size: 20px;
  }
  p.resultSummary{

    padding: 25px;
    text-align: center;
  }
  i{
    color: green;
  }


  
  .modal {
      text-align: center;
    }
    @media screen and (min-device-width: 768px) {
      .modal:before {
        display: inline-block;
        vertical-align: middle;
        content: " ";
        height: 80%;
      }
    }

    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }
</style>

