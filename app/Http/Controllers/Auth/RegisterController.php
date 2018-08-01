<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\ClientRequest;
use App\Client_company;
use App\WeeklyHours;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Room;

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

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/RegisterdMessage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()    {
        $exp =  DB::table('exp_level')->get();
        // $pricing =  DB::table('pricing')->where('is_activate' , '=' , '1')->get();
        $services =  DB::table('services')->get();
        return view('auth.register')->with('exp' , $exp)->with('services', $services);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required',
            'req_skills' => 'required|string',
            'experience_level' => 'required',
            'services' => 'required',
            'company_name' => 'required|string|max:255',
            'company_phone_number' => 'required',
            'company_address' => 'required',
            'company_zip'=>'required',
            'country'=>'required',
            'Cnum_of_employee' => 'required',
             'num_of_employee'=>'required_if:services,==,3',
              'numOfWorkingHour'=>'required_if:services,==,2',
             'ch1' => 'sometimes',
            'mondayHours' => 'required_with:ch1,on',
            'ch2' => 'sometimes',
            'tuesdayHours' => 'required_with:ch2,on',
            'ch3' => 'sometimes',
            'wednesdayHour' => 'required_with:ch3,on',
            'ch4' => 'sometimes',
            'thursdayHours'=> 'required_with:ch4,on',
            'ch5' => 'sometimes',
            'fridayHours'=> 'required_with:ch5,on',
            'ch6' => 'sometimes',
            'saturdayHours'=> 'required_with:ch6,on',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){

        $user = User::create([
            'first_name' => $data['f_name'],
            'last_name' => $data['l_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone_number'],
            'role_id' => 1,
            'joining_date'=>date("Y-m-d")
        ]);
        // $Room = Room::create([
        //     'user1' => 1,
        //     'user2' => $user->id            
        // ]);
         $Client_company = Client_company::create([
            'client_id' => $user->id,
            'company_name' => $data['company_name'],
            'company_phone' => $data['company_phone_number'],
            'company_address' => $data['company_address'],
            'company_zip' => $data['company_zip'],
            'company_country' => $data['country'],
            'no_of_employees' => $data['Cnum_of_employee'],
        ]);
        if($data['services']==1) //adHoc
        {

            $WeeklyHours = WeeklyHours::create([
            'Monday' => $data['mondayHours'],
            'Tuesday' => $data['tuesdayHours'],
            'Wednesday' => $data['wednesdayHour'],
            'Thursday' => $data['thursdayHours'],
            'Friday' => $data['fridayHours'],            
            'Saturday' => $data['saturdayHours'],
        ]);
            
        return ClientRequest::create([
            'client_id' => $user->id,
            'exp_level' => $data['experience_level'],
            'services_type' => $data['services'],           
            'skills' => $data['req_skills'],
            'status'=>0,
            'WeeklyHours_id'=>$WeeklyHours->id,
        ]);

        }
        elseif($data['services']==2) //partTime
        {
         return ClientRequest::create([
            'client_id' => $user->id,
            'exp_level' => $data['experience_level'],
            'services_type' => $data['services'],
            'number_of' => $data['numOfWorkingHour'],
            'skills' => $data['req_skills'],
            'status'=>0,
        ]);
        }
        else      //fullTime
        {
        return ClientRequest::create([
            'client_id' => $user->id,
            'exp_level' => $data['experience_level'],
            'services_type' => $data['services'],
            'number_of' => $data['num_of_employee'],
            'skills' => $data['req_skills'],
            'status'=>0,
        ]);
         
        }
       
    }
}
