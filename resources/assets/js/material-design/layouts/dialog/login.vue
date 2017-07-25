<template>
  <v-layout row justify-center>
    <v-dialog v-model="loginDialog" persistent  width="400px">
      <v-card>
        <v-card-title>
          <span class="headline">Login in RBeSell</span>
        </v-card-title>
        <v-card-text>
          <!-- <alert-success></alert-success> -->
          <v-text-field label="Email" required v-model="email" :rules="errors.email"></v-text-field>
          <v-text-field label="Password" type="password" required v-model="password"></v-text-field>
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
        password: '',
        validator: null,
        validationRules: {
            name: 'required|alpha|min:3',
            email: 'required|email'
         },
        name: null,
        email: null
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
         errors() {
          let errors = {}
          Object.keys(this.validationRules).forEach(key => {
            if (!errors[key]) {
              errors[key] = []
            }
            this.validator.validate(key, this[key]).catch(() => {})
          })

          this.validator.getErrors().errors.forEach(error => {
            errors[error.field].push(error.msg)
          })
          return errors
        }
    },
    methods: {

      close(){
        this.$store.commit('loginDialog', false)
      },
      login(){

      }
    }
  }
</script>