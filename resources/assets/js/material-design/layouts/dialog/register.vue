<template>
  <v-layout row justify-center>
    <v-dialog v-model="registerDialog" persistent  width="400px">
      <v-card>
        <v-card-title>
          <span class="headline">New RBeSell User</span>
        </v-card-title>
        <v-card-text>
          <alert-success></alert-success>
          
          <v-text-field label="Firstname" v-model="firstname" :rules="rules.firstname"></v-text-field>
          <v-text-field label="Lastname" v-model="lastname" :rules="rules.lastname"></v-text-field>
          <v-text-field label="Email" v-model="email" :rules="rules.email"></v-text-field>
          <v-text-field label="Password" type="password" v-model="password" :rules="rules.password"></v-text-field>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="blue--text darken-1" flat @click.native="close()">Close</v-btn>
          <v-btn class="blue--text darken-1" flat @click.native="register()">Register</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>

import { Validator } from 'vee-validate';
import AlertSuccess from '../alerts/success.vue'

  export default {
    data () {
      return {
        validator: null,
        email: null,
        password: null,
        firstname: null,
        lastname: null,
         rules: {
          email: [],
          password: [],
          firstname: [],
          lastname: []
        },

      }
    },
    created () {
      this.validator = new Validator(this.validationRules)
    },
    components: {
      AlertSuccess
    },
    computed: {

        registerDialog(){

          return this.$store.getters.registerDialog
        }
    },
    methods: {

      close(){
        this.$store.commit('registerDialog', false)
      }
    },
    watch: {

      email(){

          this.veeErrors()
      },
      password(){
        this.veeErrors()
      },
      firstname(){

        this.veeErrors()
      },
      lastname(){
        this.veeErrors()
      }
    }
  }
</script>