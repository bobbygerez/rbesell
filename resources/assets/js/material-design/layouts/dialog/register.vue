<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent  width="400px">
      <v-card>
        <v-card-title>
          <span class="headline">New RBeSell User</span>
        </v-card-title>
        <v-card-text>
          <alert-success></alert-success>
          <v-text-field label="Email" required></v-text-field>
          <v-text-field label="Password" type="password" required></v-text-field>
          <v-text-field label="Legal first name" required></v-text-field>
          <v-text-field label="Legal middle name" hint="example of helper text only on focus"></v-text-field>
          <v-text-field label="Legal last name" hint="example of persistent helper text"
            persistent-hint
            required
          ></v-text-field>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Close</v-btn>
          <v-btn class="blue--text darken-1" flat @click.native="dialog = false">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>

import AlertSuccess from '../alerts/success.vue'

  export default {
    data () {
      return {
        dialog: false
      }
    },
    components: {
      AlertSuccess
    }
  }
</script>