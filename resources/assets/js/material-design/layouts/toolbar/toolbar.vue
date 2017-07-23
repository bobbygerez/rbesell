<template>
	<v-toolbar fixed class="red darken-2 white--text text--darken-2" dense>
      <v-toolbar-side-icon @click.native.stop="drawer = !drawer" class="white--text text--darken-2"></v-toolbar-side-icon>
      <v-toolbar-title>RBeSell</v-toolbar-title>
      <v-spacer></v-spacer>
       <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat class="white--text text--darken-2">Home</v-btn>
        <v-btn flat class="white--text text--darken-2">About Us</v-btn>
        <v-btn flat class="white--text text--darken-2">Services</v-btn>
      </v-toolbar-items>
    </v-toolbar>
</template>

<script type="text/javascript">
	export default {

		data() {

			return {

        		drawer: null

			}
		}
	}
</script>