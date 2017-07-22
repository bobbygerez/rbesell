<template>
  <div>
    <p>Welcome to your Vue.js app!</p>

    <dropzone id="myVueDropzone" url="../api/photo/product/upload" v-on:vdropzone-success="showSuccess"   v-on:vdropzone-sending="sample">
        
    </dropzone>

  </div>
</template>

<script>
  import Dropzone from 'vue2-dropzone'

  export default {
    name: 'MainApp',
    components: {
      Dropzone
    },
    data(){

    	return {

    	}
    },
    methods: {
      'showSuccess': function (file) {
        console.log('A file was successfully uploaded')
      },
      sample: function(file, xhr, formData){
      	console.log('asdf')
      }
    }
  }
</script>