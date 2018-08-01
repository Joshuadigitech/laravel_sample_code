@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2> All Clients Manager</h2>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="register__Requests">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone #</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($allocation as $r_user)
                                    <tr>
                                        <td>{{ $count++ }}</td>                                        
                                        <td>
                                           
                                            {{ ucwords($r_user->clientManager->first_name) }} 
                                            {{ $r_user->clientManager->last_name }}
                                        </td>
                                        <td>{{ $r_user->clientManager->email }}</td>
                                        <td>{{ $r_user->clientManager->phone }}</td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-danger btn-circle" title="Delete" onclick="deleteClient({{$r_user->clientManager->id }} , {{$r_user->clientManager->role_id }})">
                                                <i class="icon-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="clientDetails" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-body">
                 <form role="form">
                    <div class="panel panel-info " style="margin-bottom: 0px;">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            Client Details 
                        </div>
                        <div class="panel-body" ">
                            <div class="row  ">
                                <div class="form-group col-lg-12">
                                    <label>Name :</label>
                                    <label style="font-weight: normal;  margin-left: 40px;" id=fname></label>
                                </div>
                            </div>
                            <div class="row  ">
                                <div class="form-group col-lg-12">
                                    <label>Email :</label>
                                    <label style="font-weight: normal;  margin-left: 40px;" id=email></label>
                                </div>
                            </div>
                            <div class="row  ">
                                <div class="form-group col-lg-12">
                                    <label>Phone :</label>
                                    <label style="font-weight: normal;  margin-left: 35px;" id=phone></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
