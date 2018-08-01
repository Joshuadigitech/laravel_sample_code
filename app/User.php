<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'gender', 'role_id', 'avatar', 'phone', 'address', 'city', 'state', 'zip', 'country',
        'is_deleted', 'is_approved', 'bio', 'joining_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }
    public function exp_level()
    {
        return $this->hasOne('App\Experience', 'id', 'exp_level');
    }

    public function pricing()
    {
        return $this->hasOne('App\Pricing', 'exp_level_id', 'exp_level');
    }
    public function userRequest()
    {
        return $this->hasMany('App\ClientRequest', 'client_id', 'id');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();
        return $this->checkIfUserHasRole($roles);
    }

    public function hasRequest()
    {
        $this->have_request = $this->getUserRequest();
    }

    public function getAllUserWithRole($role)
    {
        $roleId = Role::where('name', $role)->first();
        $userByRole = User::where([['role_id', '=', $roleId->id], ['is_deleted', '=', 0]])->get();
        return Response::json(array(
            'success' => true,
            'data' => $userByRole,
        ));
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function getUserRequest()
    {
        return $this->userRequest()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }
    /*
     *Delete Client
     */
    public function deleteClient($userid, $role)
    {
        $isExist = User::find($userid);
        if ($isExist->role_id == $role) {
            $isExist->is_deleted = 1;
            $isExist->save();
            return Response::json(array(
                'success' => true,
                'msg' => 'Client Deleted Successfully.',
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'msg' => 'You can not delete this Client.',
            ));
        }
    }
    /*
     *Approve Client
     */
    public function approveClient($userid, $role)
    {
        $isExist = User::find($userid);
        if ($isExist->role_id == $role) {
            $isExist->is_approved = 1;
            $isExist->save();
            return Response::json(array(
                'success' => true,
                'msg' => 'Client approved Successfully.',
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'msg' => 'You can not approve this Client.',
            ));
        }
    }
    /*
     *Restore Client
     */
    public function RestoreClient($userid, $role)
    {
        $isExist = User::find($userid);
        if ($isExist->role_id == $role) {
            $isExist->is_approved = 1;
            $isExist->is_deleted = 0;
            $isExist->save();

            return Response::json(array(
                'success' => true,
                'msg' => 'Client Restore Successfully.',
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'msg' => 'You can not restore this Client.',
            ));
        }
    }

    /*
     *Create Client Manager
     */
    public function create_ClientManager($request)
    {
        //Creating Client Manager
        $this->first_name = $request->f_name;
        $this->last_name = $request->l_name;
        $this->email = $request->email;
        $this->exp_level = $request->exp_level;
        $this->password = Hash::make($request->password);
        $this->gender = $request->gender;
        $this->phone = 0;
        $this->role_id = 2;
        $this->is_approved = 1;
        $this->joining_date = date("Y-m-d");
        $this->save();
        // $Room = Room::create([
        //     'user1' => 1,
        //     'user2' => $this->id
        // ]);
        return Response::json(array(
            'success' => true,
            'msg' => 'Client Manager Created Successfully.',
        ));
    }
    public function create_HR($request)
    {
        //Creating Client Manager
        $this->first_name = $request->f_name;
        $this->last_name = $request->l_name;
        $this->email = $request->email;
        $this->password = Hash::make($request->password);
        $this->gender = $request->gender;
        $this->phone = 0;
        $this->role_id = 3;
        $this->is_approved = 1;
        $this->joining_date = date("Y-m-d");
        $this->save();

    }
    public function Task_Allocation()
    {
        return $this->hasMany('App\Task_Allocation', 'cm_id', 'id');
    }
    public function Resource_Allocation()
    {
        return $this->hasMany('App\Allocation', 'cm_id', 'id');
    }

    public function Client_company()
    {
        return $this->hasOne('App\Client_company', 'client_id', 'id');
    }

    public function ClientRequest()
    {
        return $this->hasOne('App\ClientRequest', 'client_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function RecentChat1()
    {
        return $this->hasMany('App\Room', 'user1', 'id');
    }
    public function RecentChat2()
    {
        return $this->hasMany('App\Room', 'user2', 'id');
    }

}
