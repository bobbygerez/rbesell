<template>
<div class="google-maps">
  <gmap-map
    :center="center"
    :zoom="mapZoom"
    style="width: 700px; height: 600px"
    :resize-bus="customBus"
    ref="gmap"
  >
    <gmap-marker
      :position="markers.position"
      :title="merchant.name"
      :clickable="true"
      :draggable="true"
      @dragend="dragend($event.latLng)"
      :center="center"
      @click="gmapMakerClick"
    >
        <gmap-info-window 
      
      :content="merhcantInfo"
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

  VueGoogleMaps.loaded.then(function(){
    
  })

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
        merhcantInfo(){

            return "<div style='float: left'><img src='https://iak.olx.ph/images_olxph/839817820_1_644x461.jpg?bucket=10' width='100'/></div><div style='float:right; margin-left: 15px;'> <strong>" + this.merchant.name + "</strong><br /><a href='"+ this.merchant.website +"'>" + this.merchant.website + "</a><br />" + this.merchant.phone_no + "<br />" + this.merchant.mobile_no + "</div>"

        },
        merchant(){

            return this.$store.getters.merchant
        },
        lat(){

          if(this.merchant.address != null){

            if(isNaN(this.merchant.address.lat)){

              return parseFloat(14.115286)

            }
            return parseFloat(this.merchant.address.lat)
          }
          return parseFloat(14.115286)
        },
        lng(){

          if(this.merchant.address != null){

              if(isNaN(this.merchant.address.long)){

                return parseFloat(120.962112)
              }
              
            return parseFloat(this.merchant.address.long)
          }
          return parseFloat(120.962112)
        }
    },
    created(){
      bus.$on('updateBus', () => {

          
          this.updateMarker()
          this.updateBus()

      });
      bus.$on('updateMarkerByPlaces', () => {

          this.markerByPlaces();
          this.updateBus()
      });
    },

    mounted(){

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

      

        if(typeof this.$refs.gmap != 'undefined'){

            this.$refs.gmap.$mapCreated.then(() => {
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
