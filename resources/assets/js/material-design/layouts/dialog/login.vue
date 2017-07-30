<template>
  <v-layout row justify-center>
    <v-dialog v-model="loginDialog" persistent  width="400px">
      <v-card>
        <v-card-title>
          <span class="headline">Login in RBeSell</span>
        </v-card-title>
        <v-card-text>
          <!-- <alert-success></alert-success> -->
          <v-text-field label="Email" required v-model="email" :rules="rules.email"></v-text-field>
          <v-text-field label="Password" type="password" required v-model="password"  :rules="rules.password"></v-text-field>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="blue--text darken-1" flat @click.native="close()">Close</v-btn>
          <v-btn class="blue--text darken-1" flat @click.native="login()">Login</v-btn>
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
        
        dialog: true,
        password: null,
        validator: null,
        email: null,
         rules: {
          email: [],
          password: [],
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

        loginDialog(){

          return this.$store.getters.loginDialog
        },
         

          
    },
    methods: {

      close(){
        this.$store.commit('loginDialog', false)
      },
      login(){

      }
      
     

    },
    watch: {

      email(){

          this.veeErrors()
      },
      password(){
        this.veeErrors()
      }
    }
  }
</script>