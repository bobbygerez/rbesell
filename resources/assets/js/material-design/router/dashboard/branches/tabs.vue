<template>
	<tabs v-model="activeTab" nav-style="pills" :justified="justified" > 
	  <tab header="Company Informations">
	    <br />
              <div class="col-md-6">
               <form class="form-horizontal">
                  <div class="form-group">
                      <label for="branchId" class="col-lg-3 control-label">Branch Id No:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="branchId" >
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="branchName" class="col-lg-3 control-label">Name:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="branchName" v-model="branch.branch_name">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="website" class="col-lg-3 control-label">Website:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="website" v-model="branch.merchant.website" disabled>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="email" class="col-lg-3 control-label">Email:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="email" v-model="branch.email">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-3 control-label">
                        BIR Attachment <a href="#" title="Download BIR Attachment"> <i class="fa fa-download" aria-hidden="true"></i> </a>
                      </label>

                    <div class="col-lg-9">
                       <dropzone ref="birDZType" id="birDZType" 
                            :url="urlUpload" 
                            v-on:vdropzone-sending="dropSendingBIR"
                            v-on:vdropzone-removed-file="removeFileBIR"
                            :useFontAwesome="useFontAwesome"
                            :headers="headers"
                           
                            :maxNumberOfFiles="maxNumberOfFiles"
                            v-bind:preview-template="templateRegBy"
                            :dropzone-options="BIROptions" 
                            :use-custom-dropzone-options="customDropzoneOptions" 

                            >
                            <!-- Optional parameters if any! -->
                        </dropzone>
                     </div>
                  </div>
                 
                </form>
                    
              </div>
              <div class="col-md-6">
                <form class="form-horizontal">
                   <div class="form-group">
                    <label class="col-lg-3 control-label">
                        Business Permit Attachment <a href="#" title="Download Business Permit Attachment"> <i class="fa fa-download" aria-hidden="true"></i> </a>
                      </label>

                    <div class="col-lg-9">
                       <dropzone ref="busPermitDZType" id="busPermitDZType" 
                            :url="urlUpload" 
                            v-on:vdropzone-sending="dropSendingBusPermit"
                            v-on:vdropzone-removed-file="removeFileBusPermit"
                            :useFontAwesome="useFontAwesome"
                            :headers="headers"
                           
                            :maxNumberOfFiles="maxNumberOfFiles"
                            v-bind:preview-template="templateRegBy"
                            :dropzone-options="BusPermitOptions" 
                            :use-custom-dropzone-options="customDropzoneOptions" 

                            >
                            <!-- Optional parameters if any! -->
                        </dropzone>
                     </div>
                  </div>
                  <div class="form-group">
                      <label for="datereg" class="col-lg-3 control-label">Status:</label>
                      <div class="col-lg-9">
                        <select class="form-control border-input" v-model="branch.status">
                            <option value="">Select Status</option>
                            <option v-for="stat in status" :value="stat.value">{{ stat.name }}</option>
                        </select>
                      </div>
                  </div>
                    <div class="form-group">
                      <label for="regno" class="col-lg-3 control-label">Registration No:</label>
                      <div class="col-lg-9">
                        <input type="text" class="form-control border-input" name="regno" v-model="branch.registration_no">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="datereg" class="col-lg-3 control-label">Date Registered:</label>
                      <div class="col-lg-9">
                        <input type="date" class="form-control border-input" name="datereg" v-model="branch.date_registered">
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
                  <input type="text" class="form-control border-input" name="phone" v-model="branch.phone_no">
                </div>
            </div>
            <div class="form-group">
                <label for="mobile" class="col-lg-3 control-label">Mobile:</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control border-input" name="mobile" v-model="branch.mobile_no">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_person" class="col-lg-3 control-label">Contact Person:</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control border-input" name="contact_person" v-model="branch.contact_person">
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
            
          </div>
          <div class="col-lg-7">
              <google-map></google-map>
          </div>

        </form>
	  </tab>
	  
	</tabs>
</template>

<script type="text/javascript">
	import tabs from 'vue-strap/src/tabs'
	import tab from 'vue-strap/src/tab' 
  import vSelect from 'vue-select'
  import axios from 'axios'
  import googleMap from '../../dashboard/branches/branchMap.vue'
  import Dropzone from 'vue2-dropzone'

	export default {

    data(){

      return {
          justified: true,
          countryId: '',
          activeTab: 0,
          vRegionSelected: '',
          status: [

              { name: 'Active', value: 1},
              { name: 'Inactive', value: 0}
          ],
          urlUpload: window.location.origin + '/api/branch-upload-photos',
          headers: {'X-CSRF-TOKEN': Laravel.csrfToken},
          maxNumberOfFiles: 20,
          useFontAwesome: true,
          BIROptions: {
          language : {
                 dictDefaultMessage: '<br>Upload BIR photos.'},

          },
          BusPermitOptions: {
          language : {
                 dictDefaultMessage: '<br>Upload Business Permit photos.'},

          },
          customDropzoneOptions: true,
      }
    },

    created(){

        bus.$on('activeTab', () => {
          this.activeTab = 0;
        });
        bus.$once('dropZoneImages', (branch) => {

            this.getImagesDZ(this.branch.id, 'BIR', this.$refs.birDZType, 'Upload BIR Attachment');
            this.getImagesDZ(this.branch.id, 'Business Permit', this.$refs.busPermitDZType, 'Upload Business Permit Attachment');
        });
    },
    mounted(){
      this.getCountries()
    },
		components: {

			tabs, tab, vSelect, googleMap, Dropzone
		},

		computed: {

      branch: {
        get(){
          return this.$store.getters.branch
        }
        
      },
			
      vCountries(){

        return this.$store.getters.countries
      },
      vRegions(){

        return this.$store.getters.regions
      },
      vProvinces(){

        return this.$store.getters.provinces
      },
      vCities(){

        return this.$store.getters.cities
      },
      vCountrySelected(){

        if(this.branch.address != null){

            if(this.branch.address.country != null){

              return this.branch.address.country.name
            }
        }

        return ''
      },
      vProvinceSelected(){
        if(this.branch.address != null){

          if( this.branch.address.province != null) {

            return this.branch.address.province.name
          }
        }
        return ''
      },
      vCitySelected(){
        if(this.branch.address != null){
          if( this.branch.address.city != null){
            return this.branch.address.city.name
          }
        }
        return ''
      }
		},
    methods: {

       getImagesDZ(branchId, desc, refDZ, dictName){

          var vm = this
          refDZ.$el.innerHTML='<center><i class="fa fa-cloud-upload" aria-hidden="true"></i><br>' + dictName + '<br /></center>'


          axios.post(window.location.origin + '/api/branch-get-images-dz',{
              id: branchId,
              desc: desc
          }).then(function(response){


            for(let i=0; i <= response.data.images.length - 1; i++){
              console.log(i)
              var img = new Image();
              img.onload = function() {}
              img.src = window.location.origin + '/' + response.data.images[i].path;

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
      dropSendingBusPermit(file, xhr, formData){
        formData.append('id', this.branch.id);
        formData.append('size', file.size);
        formData.append('desc', 'Business Permit');
      },
      dropSendingBIR(file, xhr, formData){
        formData.append('id', this.branch.id);
        formData.append('size', file.size);
        formData.append('desc', 'BIR');
      },
      removeFileBusPermit(file){
        axios.post( window.location.origin + '/api/branch-remove-photos',{
          id: this.branch.id,
          name: file.name,
          desc: 'Business Permit'
        })
      },
       removeFileBIR(file){
        axios.post( window.location.origin + '/api/branch-remove-photos',{
          id: this.branch.id,
          name: file.name,
          desc: 'BIR'
        })
      },
      getCountries(){
        var store = this.$store
        var vm = this
        axios.get(window.location.origin + '/api/countries')
        .then(function(response){
          store.commit('countries', response.data.countries);
        })
        .catch(function(response){

        })

      },
      countryCallback(val){

        this.countryId = val.id
        var store = this.$store

        axios.get(window.location.origin + '/api/provinces?country_id=' + val.id)
         .then(function(response){

            store.commit('provinces', response.data.provinces);
           
         })
         .catch(function(){

         });



        axios.get(window.location.origin + '/api/regions')
         .then(function(response){

            store.commit('regions', response.data.regions);

         })
         .catch(function(){

         })

          this.$store.dispatch('countryId', val.id);
         //GMAP
         this.$store.commit('placeCountry', val.sortname)
         this.$store.commit('placeCity', undefined)
         bus.$emit('updateMarkerByPlaces')
      },
      regionCallback(val){
         this.$store.commit('placeAddress', val.description)
         bus.$emit('updateMarkerByPlaces')
          this.$store.dispatch('regionId', val.id);
      },
      provinceCallback(val){
        var store = this.$store
          var vm = this
          axios.get(window.location.origin + '/api/cities?province_id=' + val.id)
          .then(function(response){
              store.commit('cities', response.data.cities);
          })
          .catch(function(response){

          })
          this.$store.commit('placeAddress', val.name)
         bus.$emit('updateMarkerByPlaces')
          this.$store.dispatch('provinceId', val.id);
      },
      cityCallback(val){
        this.$store.commit('placeCity', val.name)
        bus.$emit('updateMarkerByPlaces')
        this.$store.dispatch('cityId', val.id);
      },
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
    },
    watch: {
      branch: {
        handler(after, before){

          var store = this.$store
          store.commit('branch', after);

        },
        deep: true
      },
      activeTab(val){

        if(val == 0){
          this.$store.commit('branchUrlSave', window.location.origin + '/api/branch-company-info-update')
        }
        else {
          this.$store.commit('branchUrlSave', window.location.origin + '/api/branch-contact-info-update')
          bus.$emit('updateBus');
        }
      }

    }
	}
</script>