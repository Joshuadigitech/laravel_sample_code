<?php
namespace App\Http\Controllers;

use App\Allocation;
use App\ClientRequest;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    public function allcoateResource($requestId)
    {
        
        $clientRequest = ClientRequest::find($requestId);
        $client = User::find($clientRequest->client_id);
        if ($client->hasRole('client')) 
        {
            // $getFreeCM = Allocation::getFreeCM($client->id);
            // $getCM = json_decode($getFreeCM->getContent());
            if ($clientRequest->services_type == 3) 
            {

            $allocation = Allocation::Select('cm_id')->where('client_id', $client->id)->get();
            $roleId = Role::where('name', 'CM')->first();
            $getCM = User::where([['role_id', '=', $roleId->id], ['is_deleted', '=', 0],['exp_level','=',$clientRequest->exp_level]])->WhereNotIn('id', $allocation)->whereDoesntHave('Resource_Allocation')->get();
            
            } 
            else 
            {

            $allocation = Allocation::Select('cm_id')->where('client_id', $client->id)->get();
            $roleId = Role::where('name', 'CM')->first();
            $getCM = User::where([['role_id', '=', $roleId->id], ['is_deleted', '=', 0],['exp_level','=',$clientRequest->exp_level]])->WhereNotIn('id', $allocation)->whereDoesntHave('Resource_Allocation', function ($query) 
                {
                   $query->where('services_id', '=', '3');
                })->get();

               
            }
            $allocated_managers = Allocation::where([['client_id', '=', $clientRequest->client_id], ['is_activated', '=', 1]])->get();

            //Return to view
            return view('resourceAllocation')
                ->with('clientRequest', $clientRequest)
                ->with('clientManger', $getCM)
                ->with('client', $client)
               
                ->with('allocated_managers', $allocated_managers);
        } else {
            return redirect('/hr/clients');
        }
    }
    public function viewAllocation($client_id)
    {
        $allocation = Allocation::where('client_id', $client_id)->get();
        return view('clientResources')->with('allocation',$allocation);
    }

    /*
     * save allocation
     */
    public function saveAllocation(Request $request)
    {

        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'client_manager' => 'required|integer',
        ]);
        $client = User::find($request->client_id);
        if ($client->hasRole('client')) {
            $clientRequest = ClientRequest::find($request->requestID);
            $clientRequest->status = 1;
            $clientRequest->save();
            $allocation = new Allocation;
            $saveAllocation = $allocation->saveAllocation($request);
            $isSaved = json_decode($saveAllocation->getContent());
            if ($isSaved->success) {
                session()->flash('message', $isSaved->msg);
                return redirect('/hr/allocation/' . $request->requestID);
            } else {
                session()->flash('erorr', ' Client not be allocated ');
                return redirect('/hr/allocation/' . $request->requestID);
            }
        }
    }

    /*
     * Delete Allocated CM
     */
    public function deleteAllocatedCM(Request $request)
    {
        $user = new Allocation();
        $isDeleted = $user->deleteAllocatedCM($request->id);
        return $isDeleted;
    }
}
