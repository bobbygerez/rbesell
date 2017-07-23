<template>
<div class="google-maps">
  <gmap-map
    :center="center"
    :zoom="mapZoom"
    style="width: 700px; height: 600px"
    :resize-bus="customBus"
    ref="gmapBranch"
  >
    <gmap-marker
      :position="markers.position"
      :title="branch.name"
      :clickable="true"
      :draggable="true"
      @dragend="dragend($event.latLng)"
      :center="center"
      @click="gmapMakerClick"
    >
        <gmap-info-window 
      
      :content="branchInfo"
      :opened="infoWinOpen"
      @closeclick="infoWinOpen=false"
      >
       
      </gmap-info-window>


    </gmap-marker>
  
  </gmap-map>
</div>
</template>

<script>
  /////////////////////////////////////////
  // New in 0.4.0
  import * as VueGoogleMaps from 'vue2-google-maps';
  import Vue from 'vue';
  import alert from 'vue-strap/src/alert'
  import axios from 'axios'

  Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyBVrbXla_-auHKFSjrpcbp1STuQ18JFb78',
      v: '3.28',
      libraries: 'https://maps.googleapis.com/maps/api/geocode/json?'
    }
  });


  export default {
    data () {
      return {
        center: {lat: 14.115286, lng: 120.962112},
        markers: {
          position: {lat: 14.115286, lng: 120.962112},
          title: "<a href='" + window.location.origin +"/dashboard/458047219#/'>Sample 1</a>"
        }
        ,
         customBus: new Vue(),
        infoWinOpen: true

      }
    },
    computed: {
        mapZoom(){
          return this.$store.getters.mapZoom
        },
        placeCountry(){

          return this.$store.getters.placeCountry
        },
        placeCity(){

          return this.$store.getters.placeCity
        },
        placeAddress(){
            return this.$store.getters.placeAddress
        },
        branchInfo(){

            return "<div style='float: left'><img src='https://iak.olx.ph/images_olxph/839817820_1_644x461.jpg?bucket=10' width='100'/></div><div style='float:right; margin-left: 15px;'> <strong>" + this.branch.branch_name + "</strong><br /><a href='"+ this.branch.merchant.website +"'>" + this.branch.merchant.website + "</a><br />" + this.branch.phone_no + "<br />" + this.branch.mobile_no + "</div>"

        },
        branch(){

            return this.$store.getters.branch
        },
        lat(){

          if(this.branch.address != null){

            if(isNaN(this.branch.address.lat)){

              return parseFloat(14.115286)

            }
            return parseFloat(this.branch.address.lat)
          }
          return parseFloat(14.115286)
        },
        lng(){

          if(this.branch.address != null){

              if(isNaN(this.branch.address.long)){

                return parseFloat(120.962112)
              }
              
            return parseFloat(this.branch.address.long)
          }
          return parseFloat(120.962112)
        }
    },
    created(){
      
    },

    mounted(){

      bus.$on('updateBus', () => {
          
          this.updateMarker()
          this.updateBus()

      });

      bus.$on('updateMarkerByPlaces', () => {

          this.markerByPlaces();
          this.updateBus()
      });
    },

    methods: {
      updateMarker(){

        var latLng = {lat: this.lat, lng: this.lng}

         this.markers.position = latLng
         this.center = latLng
         this.$store.commit('coordinates', latLng)


      },
      markerByPlaces(){

        var store = this.$store
        var vm = this
        
        if(typeof this.$refs.gmapBranch != 'undefined'){

           this.$refs.gmapBranch.$mapCreated.then(() => {
            var geocoder = new google.maps.Geocoder();

             if(typeof vm.placeCity !='undefined'){

                var  componentRestrictions = {
                    country: vm.placeCountry,
                    locality: vm.placeCity
                   
                  }
             }
             else{
                var  componentRestrictions = {
                    country: vm.placeCountry,
                   
                  }
             }
             
              geocoder.geocode({ 

                'address': vm.placeAddress, 
                'componentRestrictions': componentRestrictions,

              }, function(results, status) {
                  
                    if (status == google.maps.GeocoderStatus.OK) {

                      var latitude = results[0].geometry.location.lat();
                      var longitude = results[0].geometry.location.lng();
                      var latLng = { lat: parseFloat(latitude), lng: parseFloat(longitude)};
                      vm.markers.position =  latLng
                      vm.center =latLng
                      store.commit('coordinates', { lat: parseFloat(latitude), long: parseFloat(longitude)})
                      console.log(latitude + 'Long' + longitude)
                      

                      } 

               });
          })
          
        }

         
      },
      gmapMakerClick(){
        this.infoWinOpen = true
      },
      dragend(latLng){
        this.$store.commit('coordinates', { lat: latLng.lat(), long: latLng.lng() });
      },
      updateBus() {
        this.customBus.$emit('resize');
      }
    }
  }
</script>

<style type="text/css">
  
    .google-maps {
        position: relative;
        padding-bottom: 5%; // This is the aspect ratio
        height: 0;
        overflow: hidden;
    }
    .google-maps iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
    }
</style>
