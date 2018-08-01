<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class ClientRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'exp_level', 'services_type', 'number_of', 'skills', 'status', 'WeeklyHours_id',
    ];

    protected $table = 'client_request';

    /*
     *   To get some user details
     */
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'client_id');
    }
    public function WeeklyHours()
    {
        return $this->hasOne('App\WeeklyHours', 'id', 'WeeklyHours_id');
    }

    /*
     *   To get service name
     */
    public function services()
    {
        return $this->hasOne('App\Services', 'id', 'services_type');
    }

    /*
     *   To get experience details
     */
    public function experience()
    {
        return $this->hasOne('App\Experience', 'id', 'exp_level');
    }

    /*
     *Delete Client
     */
    public function deleteClientRequest($id)
    {
        $isExist = ClientRequest::find($id);
        $isExist->status = 2;
        $isExist->save();
        return Response::json(array(
            'success' => true,
            'msg' => 'ClientRequest Deleted Successfully.',
        ));

    }

    /*
     *Approve Client Requests
     */
    public function approveClientRequest($userid, $role)
    {
        $isExist = User::find($userid);
        if ($isExist->role_id == $role) {
            $isExist->is_approved = 1;
            $isExist->save();
            return Response::json(array(
                'success' => true,
                'msg' => 'Client Request approved Successfully.',
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'msg' => 'You can not approve this Client Request',
            ));
        }
    }
}
