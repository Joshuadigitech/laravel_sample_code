<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class Allocation extends Model
{
    protected $fillable = [
        'client_id', 'cm_id', 'services_id','resource_allocation_id', 'is_activated',
    ];

    protected $table = 'resource_allocation';

    /*
     * save allocation
     */
    public function saveAllocation($request)
    {
        $this->client_id = $request->client_id;
        $this->cm_id = $request->client_manager;
        $this->services_id = $request->services;
         $this->resource_allocation_id = $request->requestID;

        $this->allocation_date = date("Y-m-d");
        $this->save();
        return Response::json(array(
            'success' => true,
            'msg' => ' Resource Allocated Successfully.',
        ));
    }

    /*
     *  To Get Manager Name and other details
     */
    public function clientManager()
    {
        return $this->hasOne('App\User', 'id', 'cm_id');
    }

    /*
     *  To Get service Name
     */
    public function services()
    {
        return $this->hasOne('App\Services', 'id', 'services_id');
    }
    public function ClientRequest()
    {
        return $this->hasMany('App\ClientRequest', 'client_id', 'client_id');
    }
    
     public function Request()
    {
        return $this->hasOne('App\ClientRequest', 'id', 'resource_allocation_id');
    }


    /*
     *Delete Allocated CM
     */
    public function deleteAllocatedCM($id)
    {
        $isExist = Allocation::find($id);
        $isExist->is_activated = 0;
        $isExist->save();
        return Response::json(array(
            'success' => true,
            'msg' => 'Client Manager Deleted Successfully.',
        ));
    }

    public static function getFreeCM($client_id)
    {
        $allocation = Allocation::Select('cm_id')->where('client_id', $client_id)->get();
        $roleId = Role::where('name', 'CM')->first();
        $getCM = User::where([['role_id', '=', $roleId->id], ['is_deleted', '=', 0]])->WhereNotIn('id', $allocation)->get();
        return Response::json(array(
            'success' => true,
            'data' => $getCM,
        ));
    }
}
