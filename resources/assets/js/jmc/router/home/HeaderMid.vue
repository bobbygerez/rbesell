<template>
	<div class="header-mid">
            <div class="container">
                <div class="header-mid-left">
                    <p class="wellcome-to">Welcome to Juan Merkado</p>
                    <p class="register-or-login" v-show="register">
                        <a href="#" class="register" @click="registerUser('Register as User', 1)">Register as User</a>
                        or
                        <a href="#" class="login" @click="registerUser('Sell on Juan Merkado', 2)">Sell on Juan Merkado</a>
                    </p>
                    <p class="register-or-login" v-show="register == false">
                        <a :href="loginHref" class="register" >{{ myAccount }}!</a>
                    </p>
                    
                </div>
                <div class="header-mid-right">
                    <div class="header-mid-right-content" v-if="register">
                        <a href="/" @click="login($event)">
                            <i class="flaticon-user-outline"></i>
                            My Account
                        </a>
                    </div>
                    <div class="header-mid-right-content" v-else>
                        <a :href="loginHref" @click="login()">
                            <i class="flaticon-user-outline"></i>
                            Dashboard
                        </a>
                    </div>
                    <div class="header-mid-right-content" v-if="register == false">
                        <a href="/" @click="logout($event)">
                            <i class="fa fa-power-off" style="margin-top: 5px;"></i>
                            Logout
                        </a>
                    </div>
                    <div class="header-mid-right-content">
                        <a href="#">
                            <i class="flaticon-like"></i>
                            My Wishlist
                        </a>
                    </div>
                    <div class="header-mid-right-content">
                        <a href="#">
                            <i class="flaticon-check-square"></i>
                            Check Out
                        </a>
                    </div>
                    <div class="header-mid-right-content country-select-menu">
                        <div class="country-select">
                            <div class="country select">
                                <img src="assets/images/flag.jpg" alt="flag" width="24" height="17">
                                English
                            </div>
                            <div class="country-dropdown">
                                <div class="country">
                                    <img src="assets/images/flag2.jpg" alt="flag" width="24" height="17">
                                    Hungary
                                </div>
                                <div class="country">
                                    <img src="assets/images/flag3.jpg" alt="flag" width="24" height="17">
                                    German
                                </div>
                                <div class="country">
                                    <img src="assets/images/flag4.jpg" alt="flag" width="24" height="17">
                                    French
                                </div>
                                <div class="country">
                                    <img src="assets/images/flag5.jpg" alt="flag" width="24" height="17">
                                    Canada
                                </div>
                                <div class="country">
                                    <img src="assets/images/flag6.jpg" alt="flag" width="24" height="17">
                                    Australia
                                </div>
                            </div>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>

                    </div>
                    <div class="header-mid-right-content money-select-menu">
                        <div class="money-select">
                            <div class="money select">
                                USD
                            </div>
                            <div class="money-dropdown">
                                <div class="money">
                                    EGP
                                </div>
                                <div class="money">
                                    EURO
                                </div>
                                <div class="money">
                                    USD
                                </div>

                            </div>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <modal v-model="registerModal" effect="fade" large width="40%" :backdrop="backdrop">
            	<!-- custom header -->
            	<div slot="modal-header" class="modal-header">
            		<h2 class="modal-title text-center"> {{ title }}</h2>

            	</div>

            	<div class="modal-body"> 

            		<user-register :sitekey="sitekey" :source="windowLocation + registerIn" :company-show="companyShow"></user-register>
            	</div>

            	<div slot="modal-footer" class="modal-footer">
            		<div class="pull-right" style="margin-right: 50px;">
            			<button type="button" class="btn btn-default btn-fill" @click="registerModal = false">Exit</button>
            			<button type="button" class="btn btn-info btn-fill" @click="validateBeforeSubmit">Register Now</button>
            		</div>
            	</div>
            </modal>

            <modal v-model="loginModal" effect="fade" large width="40%" :backdrop="backdrop">
                <!-- custom header -->
                <div slot="modal-header" class="modal-header">
                    <h2 class="modal-title text-center">Login to Juan Merkado </h2>

                </div>
                
                <div class="modal-body"> 


                    <div class="form-group">
                    <p class="control has-icon has-icon-right">
                        <input name="email" v-model="email" type="text" placeholder="Email" class="form-control">
                    </p>
                </div>
                   <div class="form-group">
                        <input  name="password" type="password" class="form-control" placeholder="Password" v-model="password">
                    </div>
                </div>

                <div slot="modal-footer" class="modal-footer">
                    <div class="pull-right" style="margin-right: 50px;">
                        <button type="button" class="btn btn-default btn-fill" @click="loginModal = false">Exit</button>
                        <button type="button" class="btn btn-info btn-fill" @click="LoginMethod()">Log-in</button>
                    </div>
                </div>
            </modal>

            <alert v-model="alertSuccess" placement="top" duration="4000" type="success" width="400px" dismissable>
                <span class="fa fa-check-circle alert-icon-float-left-success"></span>
                <strong>Login Success!</strong>
                <p>{{ alertMessage }}</p>
            </alert>

            <alert v-model="alertLogout" placement="top" duration="4000" type="success" width="400px" dismissable>
                <span class="fa fa-check-circle alert-icon-float-left-success"></span>
                <strong>Logout Success!</strong>
                <p>{{ alertMessage }}</p>
            </alert>

            <alert v-model="alertDanger" placement="top" type="danger" duration="4000" width="400px" dismissable>
                <span class="fa fa-warning alert-icon-float-left"> </span>
                <strong> Authentication Failed!</strong>
                <ul>
                    <li v-for="msg in alertMessage">{{ msg }}</li>
                </ul>
            </alert>

        </div>
        
</template>

<script type="text/javascript">

	import Vue from 'vue'
	import axios from 'axios'
	import modal from 'vue-strap/src/modal'
	import UserRegister from '../../components/UserRegister'
	import VeeValidate from 'vee-validate'
    import alert from 'vue-strap/src/alertlogin'

	Vue.use(VeeValidate)

	export default{

		data(){

			return {
                alertLogout: false,
				windowLocation: window.location.origin + '/',
                registerIn: '',
				register: true,
				showUser: false,
				registerModal: false,
				title: '',
				sitekey: '',
                companyShow: false,
                backdrop: false,
                loginModal: false,
                password: '',
                email: '',
                alertSuccess: false,
                alertDanger: false,
                loginHref: '#',
			}
		},
        computed: {

            alertMessage(){

                return this.$store.getters.alertMessage
            },
            myAccount(){

                return this.$store.getters.myAccount
            }
        },
		components: {
			modal,
			UserRegister,
            alert
		},
		created(){

			this.sitekey = SiteKey.googleSiteKey
            this.authenticated()


		},
		methods: {

			authenticated(){

                var store = this.$store;
                var vm = this;
				axios.post(this.windowLocation + 'api/authenticated')
				.then(function(response){

					if(response.data.authenticated){

                        store.commit('myAccount', response.data.user);
                        vm.register = false
                        vm.loginHref = 'dashboard'
					}
				})
				.catch(function(response){

				})
			},
			registerUser(title, id){

				this.title = title;
				this.registerModal = true

				if (id === 1) {
					
                    this.companyShow = false
                    this.registerIn = 'register'

				}
				else {
					
                    this.companyShow = true
                    this.registerIn = 'api/register-user-merchant'
				}

			},
            validateBeforeSubmit: function(){
              bus.$emit('check-register-form')
            },
            login(e){

                e.preventDefault()
                this.loginModal = true
       

            },
            logout(e){
                e.preventDefault();
                var vm = this
                var store = this.$store
                axios.get(window.location.origin + '/logout')
                    .then(resp => {

                        store.commit('alertMessage', resp.data.message);
                        vm.alertLogout = true
                        vm.register = true
                    })

                    .catch(resp => {

                    })
            },
            LoginMethod: function(){

                  var store = this.$store
                  var vm = this
                  axios.post('login',{
                      email: this.email,
                      password: this.password


                  })
                    .then(function(response){

                        if (response.data.success) {

                            store.commit('alertMessage',response.data.messages);
                            store.commit('myAccount', response.data.user);
                            vm.loginHref = 'dashboard';
                            vm.alertSuccess = true
                            vm.alertDanger = false
                            vm.password = ''
                            vm.email = ''
                            setTimeout(function() {
                                vm.loginModal = false
                            }, 4500);
                            vm.register = false

                           
                        }
                        else {
                            store.commit('alertMessage', response.data.messages);
                            vm.alertDanger = true
                            vm.alertSuccess = false

                        }
                        
                    })
                    .catch(function(response){
                      
                    });


                }
		}
	}
</script>

<style type="text/css" scoped>

     .alert-icon-float-left {
      font-size:40px;
      float:left;
      margin: 5px;
      margin-right:20px;
      color: #a94442;
      
    }

     .alert-icon-float-left-success {
      font-size:40px;
      float:left;
      margin: 5px;
      margin-right:20px;
      color: #3c763d;
      
    }
    ul li{
        list-style: square;
    }
</style>