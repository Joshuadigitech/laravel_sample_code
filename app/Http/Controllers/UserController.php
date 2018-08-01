<?php

namespace App\Http\Controllers;

use App\ClientRequest;
use App\User;
use App\WeeklyHours;
use App\Task_Allocation;
use App\Task;
use App\TaskWorking;
use App\Pricing;
use Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
     * New registered Clients
     */
    public function index()
    {
        $clientRequests = ClientRequest::orderBy('status', 'asc')->get();
        $DeletedUser = User::where([['role_id', '=', 1], ['is_deleted', '=', 1]])->get();
        $allUser = User::where([['role_id', '=', 1], ['is_deleted', '=', 0], ['is_approved', '=', 0]])->get();
        $approvedRequest = User::with("Client_company")->where([['role_id', '=', 1], ['is_approved', '=', 1], ['is_deleted', '=', 0]])->get();
        return view('clients')

        ->with('clientRequests', $clientRequests)
        ->with('approvedUser', $approvedRequest)
        ->with('allUser', $allUser)
        ->with('deletedUser', $DeletedUser);

    }
    public function reqNewResource()
    {
        $exp = DB::table('exp_level')->get();
        // $pricing = DB::table('pricing')->where('is_activate', '=', '1')->get();
        $services = DB::table('services')->get();
        return view('requestForNewResource')->with('exp', $exp)->with('services', $services);

    }
    public function reqNewResourceRegister(Request $data)
    {

        $validatedData = $data->validate([
            'num_of_employee' => 'required_if:services,==,3',
            'numOfWorkingHour' => 'required_if:services,==,2',
            'ch1' => 'sometimes',
            'mondayHours' => 'required_with:ch1,on',
            'ch2' => 'sometimes',
            'tuesdayHours' => 'required_with:ch2,on',
            'ch3' => 'sometimes',
            'wednesdayHour' => 'required_with:ch3,on',
            'ch4' => 'sometimes',
            'thursdayHours' => 'required_with:ch4,on',
            'ch5' => 'sometimes',
            'fridayHours' => 'required_with:ch5,on',
            'ch6' => 'sometimes',
            'saturdayHours' => 'required_with:ch6,on',
            'req_skills' => 'required|string',
            'experience_level' => 'required',
            'services' => 'required',
        ]);
        $user = Auth::user();

        if ($data['services'] == 1) //adHoc
        {

            $WeeklyHours = WeeklyHours::create([
                'Monday' => $data['mondayHours'],
                'Tuesday' => $data['tuesdayHours'],
                'Wednesday' => $data['wednesdayHour'],
                'Thursday' => $data['thursdayHours'],
                'Friday' => $data['fridayHours'],
                'Saturday' => $data['saturdayHours'],
            ]);

            $ClientReq = ClientRequest::create([
                'client_id' => $user->id,
                'exp_level' => $data['experience_level'],
                'services_type' => $data['services'],
                'skills' => $data['req_skills'],
                'status' => 0,
                'WeeklyHours_id' => $WeeklyHours->id,
            ]);

        } elseif ($data['services'] == 2) //partTime
        {
            $ClientReq = ClientRequest::create([
                'client_id' => $user->id,
                'exp_level' => $data['experience_level'],
                'services_type' => $data['services'],
                'number_of' => $data['numOfWorkingHour'],
                'skills' => $data['req_skills'],
                'status' => 0,
            ]);
        } else //fullTime
        {
            $ClientReq = ClientRequest::create([
                'client_id' => $user->id,
                'exp_level' => $data['experience_level'],
                'services_type' => $data['services'],
                'number_of' => $data['num_of_employee'],
                'skills' => $data['req_skills'],
                'status' => 0,
            ]);

        }
        return view('home');
    }
    /*
     *  Show Client Detail
     */
    public function clientDetails($id)
    {
        $client = User::find($id);
        return view('clientDetails')
        ->with('client', $client);
    }
    /*
     * All approved Clients
     */
    public function allApprovedClients()
    {
        $allClients = User::where([['role_id', '=', 1], ['is_approved', '=', 1], ['is_deleted', '=', 0]])->get();
        return view('allClients')
        ->with('all_clients', $allClients);
    }

    /*
     * Delete Client
     */
    public function deleteClient(Request $request)
    {

        $user = new User();
        $isDeleted = $user->deleteClient($request->user_id, $request->role);
        return $isDeleted;
    }

    /*
     * Delete Client Requwst
     */
    public function deleteClientRequest(Request $request)
    {

        $clientRequest = new ClientRequest();
        $isDeleted = $clientRequest->deleteClientRequest($request->id);
        return $isDeleted;
    }

    /*
     * Approve Client Request
     */
    public function approveClientRequest(Request $request)
    {
        $clientRequest = new ClientRequest();
        $isApproved = $clientRequest->approveClientRequest($request->user_id, $request->role);
        return $isApproved;
    }
    /*
     * Restore Client
     */
    public function restoreClient(Request $request)
    {
        $user = new User();
        $isRestore = $user->RestoreClient($request->user_id, $request->role);
        return $isRestore;
    }

    /*
     * Client manager Form
     */
    public function clientManagerForm(Request $request)
    {
         $exp = DB::table('exp_level')->get();
        return view('clientManagerRegistertion')->with('exp',$exp);
    }
    /*
     * Rrgister new client Manager
     */
    public function clientManagerSubmit(Request $request)
    {

        $validatedData = $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required',
        ]);
        $user = new User;
        $isCreated = $user->create_ClientManager($request);
        // Generating Success Message
        session()->flash('message', 'Created Sucessfully');
        // Redirecting back to form page
        return redirect('/hr/cm');
    }
    /*
     * All Clients Manager
     */
    public function allClientsManager()
    {
        $allClientsManager = User::where([['role_id', '=', 2], ['is_approved', '=', 1], ['is_deleted', '=', 0]])->get();
        return view('allClientsManager')->with('all_clientsManager', $allClientsManager);
    }

    public function viewTasksCM()
    {
        $user = Auth::user();
        return view('cmTaskView')
        ->with('user', $user);
    }
    public function viewRequest()
    {
        $clientRequests = ClientRequest::where('client_id', Auth::User()->id)->orderBy('status')->get();
        //$approvedRequest = User::with("Client_company")->where([['role_id', '=', 1], ['is_approved', '=', 1], ['is_deleted', '=', 0]])->get();
        //return $approvedRequest;
        return view('viewRequestClient')
        ->with('clientRequests', $clientRequests);
        //->with('approvedUser', $approvedRequest);
    }
    public function allUser()
    {
        $client = User::where('role_id', 1)->get();
        $cm = User::where('role_id', 2)->get();
        $hr = User::where('role_id', 3)->get();
        return view('adminViewUsers')
        ->with('client', $client)
        ->with('cm', $cm)
        ->with('hr', $hr);
    }
    public function HRform(Request $request)
    {
        return view('HRRegistertion');
    }
    public function HRSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required',
        ]);
        $user = new User;
        $isCreated = $user->create_HR($request);
        // Generating Success Message
        session()->flash('message', 'Created Sucessfully');
        // Redirecting back to form page
        return redirect('/admin/addHR');
    }
    public function viewReport(Request $request)
    {   
        $info = array();;
        $clientManger=User::where('role_id','=', 2)->get();
        //return $request->all();
        if(isset($request))
        {

            $date=explode("-", $request->reportrange1);
            $result=array();
            //$result['data']=array();
            $cm=User::where([['role_id','=', 2],['id','=',$request->client_manager]])->first();
            $result=array();   
            if(isset($cm->Task_Allocation))
            {
                foreach ($cm->Task_Allocation as $task)
                {
                   
                    $start_day=Carbon\Carbon::parse($date[0]);
                    $end_day=Carbon\Carbon::parse($date[1]);
                    $amount=0;
                    $timeforTask=0; 
                    $extra_time=0;               
                    $taskWorking = TaskWorking::
                    where([['task_id', '=', $task->id], ['is_break', '=', 0],['day','>=',$start_day],['day','<=',$end_day]])
                    ->orderBy('task_id', 'asc')->get();                    
                    foreach ($taskWorking as $day) 
                    {
                         $amount=0;
                        if (isset($day->end)) 
                        {
                            $start = $day->start;
                            $end = $day->end;
                            $start_time = strtotime($start);
                            $end_time = strtotime($end);
                            $diff = $end_time - $start_time;                       
                            $breaks = TaskWorking::where([['task_id', '=', $task->id], ['is_break', '=', 1], ['day', '=', $day->day]])->
                            orderBy('id', 'asc')->get();
                            $countHours = 0;
                            foreach ($breaks as $break) 
                            {
                                $start = $break->start;
                                $end = $break->end;
                                $start_time = strtotime($start);
                                $end_time = strtotime($end);
                                $countHours += $end_time - $start_time;
                            }
                            $diff -= $countHours;
                            $timeforTask += $diff;
                            $mints=date('i', $timeforTask);
                            $Hours=date('H', $timeforTask);

                            $price=Pricing::where([['exp_level_id','=',$cm->exp_level],['start_date','<=',$day->day],['end_date','>=',$day->day]])->WhereNotNull('end_date')->first();
                            if(!isset($price))
                            {
                                $price=Pricing::where([['exp_level_id','=',$cm->exp_level],['start_date','<=',$day->day]])->WhereNull('end_date')->first();
                            }
                            if($mints>40)
                            {
                                $amount+=($Hours*$price->price)+($price->price);
                                $timeforTask+=3600;
                                $extra_time=0;                               
                            }
                            elseif($mints>15)
                            {
                                $amount+=($Hours*$price->price)+($price->price/2);
                                $extra_time=5;
                            }
                            else
                            {
                                $amount+=($Hours*$price->price);
                                $extra_time=0;  
                            }
                            

                        }   
                    }
                   
                    $data = array(
                        "name" => $task->Task->title,
                        "project_title"=>$task->Task->Project->title,
                        "amount" => $amount,
                        "timeforTask" =>date('H', $timeforTask).".".$extra_time,
                    );
                    array_push($result, $data);
                }
                $cm_name=User::where('id',$request->client_manager)->first();
                  $info=array('start_date' =>$date[0] ,
                    'end_date' =>$date[1] ,                    
                     'cm_id' =>$request->client_manager,
                     'cm_name' =>$cm_name->first_name." ".$cm_name->last_name,
                  );
       

            } 
           

        }
        return view('reportAdmin')->with('clientManger',$clientManger)->with('result',$result)->with('info',$info);
    }
}
