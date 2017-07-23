<template>
	<div>
	<form id="register-form"  method="post" role="form" @submit.prevent="validateBeforeSubmit">

        <div class="form-group" v-if="companyShow">
			<input name="company" v-model="company" v-validate:name.initial="'required|alpha_spaces'" :class="{'input': true, 'is-danger': errors.has('company') }" type="text" placeholder="Company Name" class="form-control" >
			<i v-show="errors.has('company')" class="fa fa-warning text-danger"></i>
			<span v-cloak v-show="errors.has('company')" class="help text-danger">{{ errors.first('company') }}</span>
		</div>
		<div class="form-group">
			<input name="firstname" v-model="firstname" v-validate:name.initial="'required|alpha_spaces'" :class="{'input': true, 'is-danger': errors.has('firstname') }" type="text" placeholder="Firstname" class="form-control" >
			<i v-show="errors.has('firstname')" class="fa fa-warning text-danger"></i>
			<span v-cloak v-show="errors.has('firstname')" class="help text-danger">{{ errors.first('firstname') }}</span>
		</div>
		<div class="form-group">
			<p class="control has-icon has-icon-right">
				<input name="lastname" v-model="lastname" v-validate:name.initial="'required|alpha_spaces'" :class="{'input': true, 'is-danger': errors.has('lastname') }" type="text" placeholder="lastname" class="form-control" >
				<i v-show="errors.has('lastname')" class="fa fa-warning text-danger"></i>
				<span v-cloak v-show="errors.has('lastname')" class="help text-danger">{{ errors.first('lastname') }}</span>
			</p>
		</div>
		<div class="form-group">
			<p class="control has-icon has-icon-right">
				<input name="email" v-model="email" v-validate:name.initial="'required|email'" :class="{'input': true, 'is-danger': errors.has('email') }" type="text" placeholder="Email" class="form-control" @blur="checkEmail()">
				<i v-show="errors.has('email')" class="fa fa-warning text-danger"></i>
				<span v-cloak v-show="errors.has('email')" class="help text-danger">{{ errors.first('email') }}</span>
			</p>
		</div>
									  

		<div class="form-group">
			<input v-validate:name.initial="'required|min:6|confirmed:confirm_password'" name="password" type="password" class="form-control" placeholder="Password" v-model="password">
		</div>
		<div class="form-group">
			<input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" v-model="confirm_password">
			<i v-show="errors.has('password')" class="fa fa-warning text-danger"></i>
			<span v-cloak v-show="errors.has('password')" class="help text-danger">{{ errors.first('password') }}</span>
		</div>
									

		<div class="g-recaptcha" :data-sitekey="sitekey"></div> 
	</form>
	<alert v-model="alertSuccess" placement="top" duration="5000" type="success" width="400px" dismissable>
    <span class="icon-info-circled alert-icon-float-left"></span>
    <strong><i class="fa fa-check-circle"> </i> Registration Success!</strong>
    <p>{{ alertMessage }}</p>
  </alert>
   <alert v-model="alertDanger" placement="top" type="danger" duration="5000" width="400px" dismissable>
    <span class="icon-info-circled alert-icon-float-left"></span>
    <strong><i class="fa fa-warning"> </i> Registration Failed!</strong>
    <p>{{ alertMessage }}</p>
  </alert>
	</div>
</template>

<script>

	import Vue from 'vue'
	import VeeValidate from 'vee-validate';
	import axios from 'axios'
	import alert from 'vue-strap/src/alert'
	import lodash from 'lodash'

	Vue.use(VeeValidate);

	export default{

		props: ['sitekey', 'source', 'companyShow'],
		components:{

			alert
		},
		data() {

			return {

				company: '',
				email: '',
		        firstname: '',
		        lastname: '',
		        password: '',
		        confirm_password: '',
		        rcapt_id: 0,
		        g_recaptcha_response: '',
		        alertSuccess: false,
		        alertDanger: false,
		        responseHeader: '',
		        responseClass: '',
		        responsetype: '',
		        location: window.location.origin + '/'
			}
			
		},

		created(){
			bus.$on('check-register-form', data => { this.validateBeforeSubmit() })
			if (window.grecaptcha) {
		    this.rcapt_id = grecaptcha.render( $('.g-recaptcha')[0], { sitekey : this.sitekey });
		  }
		},
		computed: {
			alertMessage(){

				return this.$store.getters.alertMessage
			},
			regMessage(){

				return this.$store.getters.regMessage
			}
		},
		  methods: {
	        validateBeforeSubmit() {
	        	var vm = this
	        	var store = this.$store
	        	var validator = this.$validator;
	        	this.g_recaptcha_response = grecaptcha.getResponse(this.rcapt_id);
				 vm.checkEmail();
	            this.$validator.validateAll().then(() => {
	                 // document.querySelector('#register-form').submit();
	                 axios.post(`${this.source}`, {
	                 	company: this.company,
	                 	email: this.email,
	                 	firstname: this.firstname,
	                 	lastname: this.lastname,
	                 	password: this.password,
	                 	password_confirmation: this.password,
	                 	gRecaptchReponse: this.g_recaptcha_response
	                 })
	                 .then(function(response){
	                 	
	                 	if ( response.data.error ) {
	                 		store.commit('alertMessage', response.data.messages );
	                 		vm.alertDanger = true
	                 		vm.alertSuccess = false
	                 		
	                 	}
	                 	else {
	                 		 store.commit('alertMessage', response.data.messages);
	           				 vm.alertDanger = false
		                 	 vm.alertSuccess = true
		                 	 vm.company = ''
			                 vm.email = ''
			                 vm.firstname = ''
			                 vm.lastname = ''
			                 vm.password = ''
			                 vm.confirm_password = ''
		                 	
	                 	}

	                 })
	                 .catch(function(response){

	                 })
	                


	            }).catch(() => {
	                
	                store.commit('alertMessage', "Please correct the error fields.");
	                vm.alertDanger = true
	                
	            });
	        },
            checkEmail(){

                var validator = this.$validator;

                axios.post(this.location + 'api/email/unique',{
                	email : this.email
                })
                .then(function(response){
                    validator.errorBag.add('email', response.data.email[0], 'server');
                })
                .catch()
                
                
            }
	    }
	}
</script>