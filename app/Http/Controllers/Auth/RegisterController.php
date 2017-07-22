<?php

namespace App\Http\Controllers\Auth;

use App\PersonalData;
use App\User;
use App\Merchant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Traits\CaptchaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use CaptchaTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {



        $data['g-recaptcha-response'] = $this->captchaCheck($data);


        $validator = Validator::make($data,
            [
                'firstname'            => 'required',
                'lastname'             => 'required',
                'email'                 => 'required|email|unique:users',
                'password'              => 'required|min:6|max:20',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => 'required'
            ],
            [
                'firstname.required'   => 'First Name is required',
                'lastname.required'    => 'Last Name is required',
                'email.required'        => 'Email is required',
                'email.email'           => 'Email is invalid',
                'password.required'     => 'Password is required',
                'password.min'          => 'Password needs to have at least 6 characters',
                'password.max'          => 'Password maximum length is 20 characters',
                'g-recaptcha-response.required' => 'Captcha is required'
            ]
        );

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $users = DB::table('users')->count();

        $memberId = sprintf("%'.05d\n", $users);
        $accountNo =  strtoupper(md5(uniqid(rand(), true))) ;
        
        return User::create([
            'personal_data_id' => $data['personal_data_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'member_id' => $memberId,
            'account_no' => $accountNo
        ]);
    }

        /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {

        $validator = $this->validator($request->all());

        if($validator->fails()){

            return $this->getErors($validator->errors()->getMessages());
        }
        
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');

       

        $personalData = PersonalData::create([
                'firstname' => $firstname,
                'lastname' => $lastname
                
            ]);

        $requestAll = $request->all();
        $requestAll['personal_data_id'] = $personalData->id;

        $this->create($requestAll);

        return response()->json([


                'messages' => 'We have send a confirmation link to your email!', 
                'error' => false

            ]);

        //$this->guard()->login($user);

        //return $this->registered($request, $user)
         //   ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user) {
        return response()->json(['SUCCESS' => 'AUTHENTICATED']);
    }

     protected function validatorCompany(array $data)
    {



        $data['g-recaptcha-response'] = $this->captchaCheck($data);

        
        $validator = Validator::make($data,
            [
                'company'              => 'required',
                'firstname'            => 'required',
                'lastname'             => 'required',
                'email'                 => 'required|email|unique:users',
                'password'              => 'required|min:6|max:20',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => 'required'
            ],
            [
                'firstname.required'   => 'First Name is required',
                'lastname.required'    => 'Last Name is required',
                'email.required'        => 'Email is required',
                'email.email'           => 'Email is invalid',
                'password.required'     => 'Password is required',
                'password.min'          => 'Password needs to have at least 6 characters',
                'password.max'          => 'Password maximum length is 20 characters',
                'g-recaptcha-response.required' => 'Captcha is required'
            ]
        );

        return $validator;
    }

     public function userMerchant(){

        $request = app()->make('request');
        
        $validator = $this->validatorCompany($request->all());


        if($validator->fails()){

            return $this->getErors($validator->errors()->getMessages());
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');

       

        $personalData = PersonalData::create([
                'firstname' => $firstname,
                'lastname' => $lastname
                
            ]);


        $requestAll = $request->all();
        $requestAll['personal_data_id'] = $personalData->id;

        $user = $this->create($requestAll);

        $merchant = Merchant::create([

                'created_by' => $user->id,
                'name' => $request->company

            ]);

        $merchantFind = Merchant::find($merchant->id);

        $merchantFind->users()->attach([
                'merchant_id' => $merchant->id,
                'user_id' => $user->id
            ]);


        return response()->json([

                'messages' => 'We have send a confirmation link to your email!', 
                'error' => false
            ]);

    }

    public function emailUnique(){

        $request = app()->make('request');

        $validator =  Validator::make($request->all(), [
                'email' => 'unique:users'
            ]);

        if($validator->fails()){

            return response()->json($validator->messages());
        }

        return response()->json([
                'success' => true
            ]);
    }

    public function getErors($messages){

      
            $errors = collect($messages)->map(function($item){

                return $item[0];
            });

            $newErrors = '';

            foreach ($errors as $value) {
                
                $newErrors .= ' ' . $value;
            }

            return response()->json(['messages' => $newErrors, 'error' => true]);
    }

     
}
