<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="row">
            <div class="header">
              <div class="col-lg-12">
                <div class="col-lg-6">
                 <div style="margin-top: 25px;">
                      <autocomplete
                      placeholder="Search merchant name..."
                      :url="merchantUrl"
                      anchor="name"
                      :on-select="getData"
                      :on-input="onInput"
                      
                      >
                    </autocomplete>
                  </div>
                </div>
                 <div class="col-lg-6">
                    <div class="pull-right">
                      <paginate
                      :page-count="merchants.last_page"
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
                    <caption>
                      <p class="text-center">Page {{ merchants.current_page }} of {{ merchants.last_page }} <br /> Display {{ merchants.from }} to {{ merchants.to }} out of {{ merchants.total }}</p>
                    </caption>
                    <thead>
                      <tr>
                        <th>Merchant Name</th>
                        <th>Telephone</th>
                        <th>Mobile</th>
                        <th>Website</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th style="width: 100px;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="mer in merchants.data">
                          <td>
                          {{ mer.name }}</td>
                          <td>{{ mer.phone_no }}</td>
                          <td>{{ mer.mobile_no }}</td>
                          <td>{{ mer.website }}</td>
                          <td>{{ mer.email }}</td>
                          <td v-if="mer.status"><span class="label label-success"> <i class="fa fa-check"> </i></span></td>
                          <td v-else><span class="label label-danger"> <i class="fa fa-times"> </i></span></td>
                          <td>
                            <!-- <a href="/" style="font-size:20px;" class="text-info" @click="viewBranches($event, mer.id)" title="Branches"><i class="fa fa-list-ul" aria-hidden="true"></i></a> -->
                            <a href="/" style="font-size:20px;" class="text-success" title="Edit" @click="editMerchant($event, mer.id)"><span class="fa fa-edit"></span></a>
                            <a href="/" style="font-size:20px;" class="text-danger" title="Delete"><span class="fa fa-trash"></span></a>
                          </td>
                        </tr>
                    </tbody>
                  </table>
                  <!-- <sidebar :show="showSidebar" placement="right" header="All Branches" :width="width" @close="showSidebar = false" @open="showSidebar = true">
                    <table class="table table-hover user-table">
                      <thead>
                        <tr>
                            <th>Name</th>
                            <th>Telephone</th>
                            <th>Email</th>
                        </tr>
                      </thead>
                      <tbody v-if="branches != null">
                        <tr v-for="branch in branches">
                            <td>{{ branch.name }}</td>
                            <td>{{ branch.phone_no }}</td>
                            <td>{{ branch.email }}</td>
                            
                        </tr>
                      </tbody>
                    </table>
                  </sidebar> -->
                  </div>
              </div>
            </div><!--header end -->
          </div>


        </div>
      </div>
    </div>
  <modal v-model="editMerchantModal" effect="fade" large :backdrop="backdrop" width="90%">
      <!-- custom header -->
      <div slot="modal-header" class="modal-header">
        <h4 class="modal-title text-center">{{ merchant.name }}</h4>

      </div>

      <div class="modal-body"> 
        <div class="row">
          <tabs v-model="activeTab" nav-style="pills" :justified="justified" >
            <tab header="Company Informations">
             <br />
              <div class="col-md-6">
               <form class="form-horizontal">
                  <div class="form-group">
                      <label for="merchantId" class="col-lg-3 control-label">Merchant Id No:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="merchantId" v-model="merchant.merchant_id">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="merchantName" class="col-lg-3 control-label">Name:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="merchantName" v-model="merchant.name">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="website" class="col-lg-3 control-label">Website:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="website" v-model="merchant.website">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="email" class="col-lg-3 control-label">Email:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" v-model="merchant.email">
                      </div>
                  </div>
                    <div class="form-group">

                      <label for="tradeName" class="col-lg-3 control-label">Trade Name:</label>
                          <div class="col-lg-9">
                      <input type="text" class="form-control border-input"  placeholder="Enter Trade Name" v-model="merchantTradeName" ref="franchisorName"> 
                      </div>

                     <transition name="fade">
                        <p class="spanError" v-if="tradeNameError"><i class="fa fa-warning"></i>{{ alertMessage }}</p>
                      </transition>
                      
                  </div>

                    <div class="form-group">
                         <label class="col-lg-3 control-label">Trade Type:</label>
                         <div class="col-lg-9">
                           <label class="radio-inline">
                                <input type="radio"  v-model="merchant.for_franchise" value="1" @click="checkTradeName()" @blur="checkTradeName()"> Franchisor
                            </label>
                             <label class="radio-inline">
                                 <input type="radio" v-model="merchant.for_franchise" value="0" @click="removeError()"> Franchisee
                            </label>
                            <transition name="fade">
                              <v-select :on-change="consoleCallback" value="id" label="name" v-model="vSelected" :options="vOptions" v-if="merchant.for_franchise == '0'"></v-select>
                            </transition>
                         </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">
                          <a href="#"><i class="fa fa-download" aria-hidden="true"></i></a>
                        </label>

                        <div class="col-lg-9">

                            <div style="margin-top: 5px;">
                              <dropzone ref="tradeNameDZ" id="tradeNameDZ" 
                                  :url="urlUpload" 
                                  v-on:vdropzone-sending="dropSendingTN"
                                  v-on:vdropzone-removed-file="removeFileTN"
                                  :useFontAwesome="useFontAwesome"
                                  :headers="headers"
                                 
                                  :maxNumberOfFiles="maxNumberOfFiles"
                                  v-bind:preview-template="templateRegBy"
                                  :dropzone-options="tradeNameOptions" 
                                  :use-custom-dropzone-options="customDropzoneOptions" 

                                  >
                                  <!-- Optional parameters if any! -->
                              </dropzone>
                            </div>

                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-3 control-label">Registered By:</label>
                        <div class="col-lg-9">
                            <select class="form-control border-input margin-bottom" v-model="merchant.registered_by_id" >
                                <option value="">Select Agency</option>
                                <option v-for="reg in registeredBy" :value="reg.id"> {{ reg.name }}</option>
                            </select>
                        </div>
                       </div>
                      <div class="form-group">
                           <label class="col-lg-3 control-label">
                              <a href="#"><i class="fa fa-download" aria-hidden="true"></i></a>
                          </label>

                          <div class="col-lg-9">
                            <div style="margin-top: 5px;">
                              <dropzone ref="myVueDropzone" id="myVueDropzone" 
                                :url="urlUpload" 
                                v-on:vdropzone-sending="dropSending"
                                v-on:vdropzone-removed-file="removeFile"
                                :useFontAwesome="useFontAwesome"
                                :headers="headers"
                               
                                :maxNumberOfFiles="maxNumberOfFiles"
                                v-bind:preview-template="templateRegBy"

                                >
                              </dropzone>
                            </div>
                        </div>

                      </div>

                 
                </form>
                    
              </div>
              <div class="col-md-6">
                  <form class="form-horizontal">
                    
                   <div class="form-group">
                      <label class="col-lg-3 control-label">Ownership Type:</label>
                      <div class="col-lg-9">
                        <select class="form-control border-input" v-model="merchant.ownership_type_id" style="margin-bottom: 5px;">
                            <option value="">Select Ownership Type</option>
                            <option v-for="ownership in getOwnershipType" :value="ownership.id"> {{ ownership.name }}</option>
                        </select>
                      </div>

                     

                  </div>

                  <div class="form-group">
                    <label class="col-lg-3 control-label">
                        <a href="#"><i class="fa fa-download" aria-hidden="true"></i></a>
                      </label>

                    <div class="col-lg-9">
                       <dropzone ref="dzOwnershipType" id="dzOwnershipType" 
                            :url="urlUpload" 
                            v-on:vdropzone-sending="dropSendingOT"
                            v-on:vdropzone-removed-file="removeFileOT"
                            :useFontAwesome="useFontAwesome"
                            :headers="headers"
                           
                            :maxNumberOfFiles="maxNumberOfFiles"
                            v-bind:preview-template="templateRegBy"

                            >
                            <!-- Optional parameters if any! -->
                        </dropzone>
                     </div>
                  </div>
                   <div class="form-group">
                      <label class="col-lg-3 control-label">Business/Industry Type:</label>
                      <div class="col-lg-9">
                        <select class="form-control border-input">
                            <option value="">Select Type</option>
                            <option> To Be filled up</option>
                        </select>
                      </div>

                  </div>
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Registration No:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" v-model="merchant.registration_no">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-lg-3 control-label">Date Registered:</label>
                      <div class="col-lg-9">
                        <input type="date" class="form-control border-input" v-model="merchant.date_registered">
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label">&nbsp;</label>
                    <div class="col-lg-9">
                      <button type="button" class="btn btn-default btn-fill" @click="closeMerchantModal()">Exit</button>
                      <button type="button" class="btn btn-danger btn-fill" @click="saveMerchant">Save</button>
                    </div>
                  </div>

                  </form>

              </div>
              
          
              
            </tab>
            <tab header="Contact Informations">
            <br />
              <form class="form-horizontal">
              <div class="col-lg-5">
                 <div class="form-group">
                      <label for="phone" class="col-lg-3 control-label">Phone:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="phone" v-model="merchant.phone_no">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="mobile" class="col-lg-3 control-label">Mobile:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="mobile" v-model="merchant.mobile_no">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="contact_person" class="col-lg-3 control-label">Contact Person:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="contact_person" v-model="merchant.contact_person">
                      </div>
                  </div>
                 <div class="form-group">
                      <label for="country" class="col-lg-3 control-label">Country:</label>
                      <div class="col-lg-9">
                          <v-select :on-change="countryCallback" name="country" value="id" label="name" v-model="vCountrySelected" :options="vCountries"></v-select>
                       </div>
                  </div>

                  <transition name="slide-fade">
                    <div class="form-group" v-if="countryId === 173">
                        <label for="region" class="col-lg-3 control-label">Region:</label>
                        <div class="col-lg-9">
                         <v-select :on-change="regionCallback"  value="id" label="description" v-model="vRegionSelected" :options="vRegions"></v-select>
                        </div>
                    </div>
                  </transition>

                  <div class="form-group">
                      <label for="province" class="col-lg-3 control-label">Province:</label>
                      <div class="col-lg-9">
                       <v-select :on-change="provinceCallback" value="id" label="name" v-model="vProvinceSelected" :options="vProvinces"></v-select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="city" class="col-lg-3 control-label">City:</label>
                      <div class="col-lg-9">
                        <v-select :on-change="cityCallback" value="id" label="name" v-model="vCitySelected" :options="vCities"></v-select>
                       </div>
                  </div>
                   <div class="form-group">
                      <label for="brgy" class="col-lg-3 control-label">Select Barangay:</label>
                      <div class="col-lg-9">
                          <v-select :on-change="countryCallback" value="id" label="name"  :options="vCountries"></v-select>
                      </div>
                  </div>
                   <div class="form-group">
                      <label for="street" class="col-lg-3 control-label">Street No./Lot No.</label>
                      <div class="col-lg-9">
                        <textarea class="form-control  border-input" v-model="street"></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="street" class="col-lg-3 control-label">Building Photo</label>
                      <div class="col-lg-9">
                        <textarea class="form-control  border-input" v-model="street"></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                     <label for="street" class="col-lg-3 control-label">&nbsp;</label>
                     <div class="col-lg-9">
                        <button type="button" class="btn btn-default btn-fill" @click="closeMerchantModal()">Exit</button>
                        <button type="button" class="btn btn-danger btn-fill" @click="saveContactInfo">Save</button>
                     </div>
                    
                  </div>

                  
              </div>
              <div class="col-lg-7">
               
                  <google-map ></google-map>
                 
              </div>
              
              </form>
            </tab>
            <tab header="Branches" >
              
            </tab>
            <tab header="Settings" >
              
            </tab>
    
          </tabs>
        </div>
        <alert v-model="alertDanger" placement="top" type="danger" width="70%" dismissable  duration="4000">
          <span class="fa fa-warning alert-icon-float-left"></span>
          <div style="margin-left: 40px;">
            <strong>&nbsp; &nbsp;Please correct the errors! </strong>
            <ul>
              <li v-for="val in alertMessage">{{ val[0] }}</li>
            </ul>
          </div>
        </alert>
        <alert v-model="alertSuccess" placement="top" type="success" width="70%" dismissable  duration="4000">
          <span class="fa fa-check-circle alert-icon-float-left"></span>
          <div style="margin-left: 40px;">
          <strong>Updated Successfully! </strong>
          <p>Merchant {{ merchant.name }} was successfully updated.</p>
          </div>
        </alert>

        <alert v-model="alertContactInfo" placement="top" type="success" width="70%" dismissable  duration="4000">
          <span class="fa fa-check-circle alert-icon-float-left"></span>
          <div style="margin-left: 40px;">
          <strong>Contact informations updated successfully </strong>
          <p>{{ alertMessage }}</p>
          </div>
        </alert>
      </div>

      <div slot="modal-footer" class="modal-footer">
        
      </div>
  </modal>
    
  </div>
</template>

<script type="text/javascript">
import Vue from 'vue'
import axios from 'axios'
import modal from 'vue-strap/src/modal'
import sidebar from 'vue-strap/src/aside'
import Autocomplete from 'vue2-autocomplete-js'
import Paginate from 'vuejs-paginate'
import tabs from 'vue-strap/src/tabs'
import tab from 'vue-strap/src/tab' 
import vSelect from 'vue-select'
import alert from 'vue-strap/src/alert'
import googleMap from '../google-map/map.vue'
import Dropzone from 'vue2-dropzone'

export default{

  data(){

    return {
        justified: true,
        customDropzoneOptions: true,
        tradeNameOptions: {
          language : {
                 dictDefaultMessage: '<br>Upload Trade Name photos.'},

        },
        franchisorName: '',
        thumbnailWidth: 100,
        thumbnailHeight: 100,
        maxNumberOfFiles: 20,
        ownershipTypeNumber: '',
        urlUpload: window.location.origin + '/api/merchant-upload-photos',
        showRegUpload: false,
        useFontAwesome: true,
        backdrop: false,
        windowLocation: window.location.origin + '/',
        showViewBranch: false,
        showSidebar: false,
        width: 500,
        merchantUrl:  window.location.origin + '/api/merchant-search',
        page: 1,
        per_page: 20,
        editMerchantModal: false,
        activeTab: 0,
        vFranchisor: '',
        vOptions:[],
        updatedTradeName: '',
        tradeNameError: false,
        alertDanger: false,
        alertSuccess: false,
        vCountries: [],
        countryId: '',
        vRegions: [],
        regionId: '',
        vProvinces: [],
        provinceId: '',
        vCities:[],
        cityId: '',
        alertContactInfo: false,
        headers: {'X-CSRF-TOKEN': Laravel.csrfToken}
    }
  },
  components: {
    modal,
    sidebar,
    Autocomplete, Dropzone,
    Paginate, tabs, tab, vSelect, alert, googleMap
  },
  created(){

    this.$store.commit('title', 'All Merchants');
    this.index();
    this.getRegisteredBy();
    this.ownershipType();
    this.getFranchisor();
    this.getCountries();

  },
  mounted(){
    
    

  },
  computed: {
      merchantTradeName: {

        get(){
            if(this.merchant.trade != null){

              return this.merchant.trade.name
            }

            if(this.merchant.franchisee != null){

              if(this.merchant.franchisee.trade != null){

                return this.merchant.franchisee.trade.name
                
              }
              
            }

            return ''
        }

          
      },
      vSelected(){
        if(this.merchant.for_franchise == 0){

              if(this.merchant.franchisee != null){

                if(this.merchant.franchisee.trade != null){

                  return this.merchant.franchisee.trade.name
                }
              }
                  

        }

        return ''
      },
      
      street(){
        if(this.merchant.address == null){

          return ''
        }
        return this.merchant.address.street
      },
      vCitySelected(){
        if(this.merchant.address == null){

          return ''
        }
        if (this.merchant.address.city != null) {
          return this.merchant.address.city.name
        }
        return ''
        
      },
      vProvinceSelected(){

         if(this.merchant.address == null){

          return ''
        }

        if (this.merchant.address.province != null) {
          return this.merchant.address.province.name
        }

        return ''
        
      },
      vRegionSelected(){
        if(this.merchant.address == null){

          return ''
        }
        if(this.merchant.address.region != null){
          return this.merchant.address.region.name
        }

        return ''
      },
      vCountrySelected: {

        get(){
          
          if(this.merchant.address == null){

          return ''
          }

          if(this.merchant.address.country != null){
            return this.merchant.address.country.name
          }

          return ''
        }
        
        
      },
      coordinates(){

          return this.$store.getters.coordinates
      },
      countries(){
         return this.$store.getters.countries
      },
      alertMessage(){
        return this.$store.getters.alertMessage
      },
      // forFranchise: {
      //   get(){

      //     if (this.merchant.for_franchise != null){

      //       return this.merchant.for_franchise
      //     }
      //     else{

      //       return 2
      //     }

      //   }
      // },
      tradeName: {

        get(){
          if (this.merchant.trade != null){

            return this.merchant.trade.name
         }
         else {

            return ''
         }
       },
        set(value){

          this.$store.commit('tradeName', value)
        }
         

      },
      tradeId(){
        if (this.merchant.trade != null){

            return this.merchant.trade.id
         }
      },

      merchant: {
        get(){
          return this.$store.getters.merchant
        },
        set(value){

          this.$store.commit('merchant', value);
        }
        
        
      },
      merchants(){
        return this.$store.getters.merchants
      },
      branches(){

        return this.$store.getters.branches
      },
      getOwnershipType(){
        return this.$store.getters.ownershipType
      },
      registeredBy(){

        return this.$store.getters.registeredBy
      }
  },

  methods: {
    
      templateRegBy(){
        return `
                  <div class="dz-preview dz-file-preview" style='margin: 5px;'>
                      <div class="dz-image" style="width: 100px;height: 100px">
                          <img style="max-width: 100%; max-height: 100%" data-dz-thumbnail /></div>
                      <div class="dz-details">
                        <div class="dz-size"><span data-dz-size></span></div>
                        <div class="dz-filename"><span data-dz-name></span></div>
                      </div>
                      <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                      <div class="dz-error-message"><span data-dz-errormessage></span></div>
                      <div class="dz-success-mark"><i class="fa fa-check"></i></div>
                      <div class="dz-error-mark"><i class="fa fa-close"></i></div>

                  </div>
              `;
      },
      getImagesDZ(merchantId, desc, refDZ, dictName){
          var vm = this
          refDZ.$el.innerHTML='<center><i class="fa fa-cloud-upload" aria-hidden="true"></i><br>' + dictName + '<br /></center>'


          axios.post(this.windowLocation + 'api/merchant-get-images-dz',{
              merchant_id: merchantId,
              desc: desc
          }).then(function(response){


            for(let i=0; i <= response.data.images.length - 1; i++){
              
              var img = new Image();
              img.onload = function() {}
              img.src = vm.windowLocation + response.data.images[i].path;

               var mockFile = {
                  id: response.data.images[i].id,
                  name: response.data.images[i].name,
                  size: response.data.images[i].size
                };

              var fileUrl = img.src
              refDZ.manuallyAddFile(mockFile, fileUrl)
            }

          }).catch(function(){

          })

       
          
      },
      removeFileTN(file){
        axios.post(this.windowLocation + 'api/merchant-remove-photos',{
          merchant_id: this.merchant.id,
          name: file.name,
          desc: 'Trade Name'
        })
      },
      removeFileOT(file){
        axios.post(this.windowLocation + 'api/merchant-remove-photos',{
          merchant_id: this.merchant.id,
          name: file.name,
          desc: 'Ownership Type'
        })
      },
      removeFile(file){
        axios.post(this.windowLocation + 'api/merchant-remove-photos',{
          merchant_id: this.merchant.id,
          name: file.name,
          desc: 'Regulatory Agency'
        })
      },
      dropSendingTN(file, xhr, formData){
        formData.append('merchant_id', this.merchant.id);
        formData.append('size', file.size);
        formData.append('desc', 'Trade Name');
      },
      dropSendingOT(file, xhr, formData){
        formData.append('merchant_id', this.merchant.id);
        formData.append('size', file.size);
        formData.append('desc', 'Ownership Type');
      },
      dropSending(file, xhr, formData){

        formData.append('merchant_id', this.merchant.id);
        formData.append('size', file.size);
        formData.append('desc', 'Regulatory Agency');
      },
      closeMerchantModal(){
        this.editMerchantModal = false
        this.activeTab = 0

      },
      saveContactInfo(){
        var store = this.$store
        var vm = this
        axios.post(this.windowLocation + 'api/merchant-contact-info',{

          id: this.merchant.id,
          contactInfo: {
            address_id: this.merchant.id,
            country_id: this.countryId,
            province_id: this.provinceId,
            municipality_id: this.cityId,
            lat: this.coordinates.lat,
            long: this.coordinates.long,
            street: this.street
          },
          companyInfo: {
            phone_no: this.merchant.phone_no,
            contact_person: this.merchant.contact_person,
            mobile_no: this.merchant.mobile_no
          } 
          
         

        }).then(function(response){
            store.commit('alertMessage', response.data.message);
            vm.alertContactInfo = true
        })

        .catch(function(response){

        })
      },
      cityCallback(val){
        this.cityId = val.id
        this.$store.commit('placeCity', val.name)
        bus.$emit('updateMarkerByPlaces')

        
      },
      provinceCallback(val){
          var store = this.$store
          var vm = this
          axios.get(this.windowLocation + 'api/cities?province_id=' + val.id)
          .then(function(response){
              store.commit('cities', response.data.cities);
              vm.vCities = response.data.cities;
              vm.provinceId = val.id
          })
          .catch(function(response){

          })
        this.$store.commit('placeAddress', val.name)
         bus.$emit('updateMarkerByPlaces')
      },
      regionCallback(val){
         this.$store.commit('placeAddress', val.description)
         bus.$emit('updateMarkerByPlaces')
      },
      countryCallback(val){
         var store = this.$store
         var vm = this
         this.$store.commit('placeCountry', val.sortname)
         this.$store.commit('placeCity', undefined)
         
         axios.get(this.windowLocation + 'api/provinces?country_id=' + val.id)
         .then(function(response){

            store.commit('provinces', response.data.provinces);
            vm.vProvinces = response.data.provinces
           
         })
         .catch(function(){

         });

         axios.get(this.windowLocation + 'api/regions')
         .then(function(response){

            store.commit('regions', response.data.regions);
            vm.vRegions = response.data.regions;

         })
         .catch(function(){

         })

         bus.$emit('updateMarkerByPlaces')
         this.countryId = val.id
      },
      getCountries(){
        var store = this.$store
        var vm = this
        axios.get(this.windowLocation + 'api/countries')
        .then(function(response){
          store.commit('countries', response.data.countries);
          vm.vCountries = response.data.countries
        })
        .catch(function(response){

        })

      },
      ownershipType(){

        var store = this.$store
          axios.get(this.windowLocation + 'api/ownership_type')
            .then(function(response){
                store.commit('ownershipType', response.data.ownershipType);
            })
            .catch(function(response){

            })
      },
      getRegisteredBy(){

          var store = this.$store
          axios.get(this.windowLocation + 'api/registered_by')
            .then(function(response){
                store.commit('registeredBy', response.data.registeredBy);
            })
            .catch(function(response){

            })

      },
      getData(obj){
        var store = this.$store;
        this.page = 1
        this.per_page = 1
        axios.post(this.windowLocation + 'api/merchants-search', {

          id: obj.id,
          page: 1,
          per_page: 1
          
        })
        .then(function(response){

            store.commit('merchants', response.data.merchants);

          })
          .catch(function(response){

          })

      },
      onInput(data){
          this.page = 1
          this.per_page = 40
          if (data==='') {

            this.index()
          }
          
      },
      index(){
        var store = this.$store;
        axios.get(this.windowLocation + 'api/merchant?page=' + this.page + '&per_page=' + this.per_page)
        .then(function(response){
            store.commit('merchants', response.data.merchants);
        })
        .catch()
      },
      viewBranches(e, merchantId){

        e.preventDefault()
        var store = this.$store
        axios.post(this.windowLocation + 'api/merchant-branches',{

            merchantId: merchantId
        }).then(function(response){

            store.commit('branches', response.data.branches);
        })

        .catch(function(response){

        })
        this.showSidebar = true

      },
      clickHandler(pageNum){

       this.page = pageNum
      },
      editMerchant(e, merchantId){
         e.preventDefault();

        this.getImagesDZ(merchantId, 'Regulatory Agency', this.$refs.myVueDropzone, 'Upload Regulatory Agency Image Attachment');
        this.getImagesDZ(merchantId, 'Trade Name', this.$refs.tradeNameDZ, 'Upload Trade Name Image Attachment');
        this.getImagesDZ(merchantId, 'Ownership Type', this.$refs.dzOwnershipType, 'Upload Ownership Type Image Attachment');
        
        var store = this.$store;
        var vm = this;
        this.forFranchise = [];
       
        axios.get(this.windowLocation + 'api/merchant/' + merchantId + '/edit')
        .then(function(response){
            store.commit('merchant', response.data.merchant);

           
        })
        .catch(function(response){

        })
        this.editMerchantModal = true
        
      },
      checkTradeName(){

          var store = this.$store;
          var vm = this;
          axios.post(this.windowLocation + 'api/trade-check-unique-name',{
              id: this.tradeId,
              name: this.tradeName
          }).then(function(response){
              
          }).catch(function(error){

            store.commit('alertMessage', error.response.data.name[0]);
            vm.tradeNameError = true
              
          })
      },
      removeError(){
        this.tradeNameError = false
      },
      checkForFranchise(){

        axios.post(this.windowLocation + 'api/merchant-check-for-franchise',{
            id: this.merchant.id,
            forFranchise: this.forFranchise
        });
      },
      getFranchisor(){
        var vm = this

        axios.post(this.windowLocation + 'api/merchant-franchisor')
        .then(function(response){
            vm.vOptions = response.data
        })
        .catch(function(response){

        })
      },
      consoleCallback(val) {

        if( typeof val == 'string'){
          this.vFranchisor = ''
        }
        else{
          this.vFranchisor = val.id
          this.$store.commit('merchantTradeName', { name: val.name})
        }
        
      },
      saveMerchant(){


        var store = this.$store;
        var vm = this;
        axios.put(this.windowLocation + 'api/merchant/' + this.merchant.id,{
          id: this.merchant.id,
          merchant_id: this.merchant.merchant_id,
          name: this.merchant.name,
          website: this.merchant.website,
          email: this.merchant.email,
          franchise_id: this.vFranchisor,
          for_franchise: this.merchant.for_franchise,
          franchisor_name: this.merchant.trade.name,
          registered_by_id: this.merchant.registered_by_id,
          ownership_type_id: this.merchant.ownership_type_id,
          registration_no: this.merchant.registration_no,
          date_registered: this.merchant.date_registered,
          franchisee: this.vFranchisor

        }).then(function(response){

            store.commit('merchant', response.data.merchant);
            vm.alertSuccess = true
        })
        .catch(function(error){

            store.commit('alertMessage', error.response.data);
            vm.alertDanger = true;
        });

      }
  },
  watch: {

      page(){

          this.index()
      },
      // merchant: {
      //   handler(after, before){

      //     var store = this.$store
      //     store.commit('merchant', after);

      //   },
      //   deep: true
      // },
      activeTab(){

          if(this.activeTab === 1){
            bus.$emit('updateBus');
          }
      },
      'merchant.registered_by_id': function(value){

        if(typeof value == 'string'){
            this.showRegUpload = false
          }
          else{
            this.showRegUpload = true
          }
        

      },
      'merchant.ownership_type_id': function(value){
        
          if(typeof value == 'string'){
            this.ownershipTypeNumber = false
          }
          else{
            this.ownershipTypeNumber = true
          }
      },
      'merchant.for_franchise': function(value){

          if(this.merchant.for_franchise == 1){
            this.franchisorName = ''
            this.$refs.franchisorName.focus()
            this.merchant.vFranchisor = ''

          } 
      }


  }
}

</script>
<style type="text/css" scoped>
  tr:hover{
    cursor: auto;
  }
  .error {

      border: 2px solid #a94442;
  }
  .spanError{

     color: #a94442;
  }
 .alert-icon-float-left {
  font-size:40px;
  float:left;
  margin: 5px;
  margin-right:20px;
  color: #403D39;
  
}
.margin-bottom {
  margin-bottom: 5px;
}

</style>

