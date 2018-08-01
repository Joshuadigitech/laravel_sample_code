@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">                
	<div class="inner">
		<div class="row">
			<div class="col-lg-12">
				<h2>Clients</h2>
			</div>
		</div>
		<div class="row">
			<div class="panel-body">
				<ul class="nav nav-pills">
					<li class="active"><a href="#New" data-toggle="tab">Client Requests</a></li>
					{{--<li><a href="#newUser" data-toggle="tab">New Clients</a></li>--}}
					<li ><a href="#Approved" data-toggle="tab">Approved</a></li>
					<li><a href="#Deleted" data-toggle="tab">Deleted</a></li>
				</ul>
				<div class="tab-content">
					<div class="col-lg-12 tab-pane fade in active" id="New">
						<div class="table-responsive">
							<table class="table  table-bordered table-hover" id="register__Requests">
								<thead>
									<tr >
										<th>#</th>
										<th>Client Name</th>
										<th>Email</th>
										<th>Phone #</th>
										<th>Required Exp</th>
										<th>Required Services</th>
										<th># Required Resoureces</th>
										<th>Hours/week</th>
										<th>Skills</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $count = 1; @endphp
									@foreach($clientRequests as $req)
									<tr>
										@if($req->status==2)
										<td class="deletedRequest">{{ $count++ }}</td>
										@elseif($req->status==1)
										<td class="approvedRequest">{{ $count++ }}</td>
										@else
										<td>{{ $count++ }}</td>
										@endif
										<td>
											<a style=" cursor: pointer;" onclick="clientDetails(this)"
											data-fname=" {{ $req->user->first_name }}"
											data-lname="{{ $req->user->last_name }}"
											data-email="{{ $req->user->email }}"
											data-gender="{{ $req->user->gender }}"
											data-phone="{{ $req->user->phone }}"
											data-address="{{ $req->user->address }}"
											data-city="{{ $req->user->city }}"
											data-state="{{ $req->user->state }}"
											data-zip="{{ $req->user->zip}}"
											data-country="{{ $req->user->country }}"
											data-joining_date="{{ $req->user->joining_date }}"
											data-company_name="{{ $req->user->client_company->company_name }}"
											data-company_phone="{{ $req->user->client_company->company_phone}}"
											data-company_address="{{ $req->user->client_company->company_address}}"
											data-company_zip="{{ $req->user->client_company->company_zip }}"
											data-company_country="{{ $req->user->client_company->company_country }}"
											data-no_of_employees="{{ $req->user->client_company->no_of_employees }}"
											>{{ $req->user->first_name }} {{ $req->user->last_name }}</a>
										</td>
										<td>{{ $req->user->email }}</td>
										<td>{{ $req->user->phone }}</td>
										<td>{{ $req->experience->name}}</td>
										@if ($req->services->name=="Ad Hoc")
										<td>
											<a style=" cursor: pointer;" onclick="AdHocDetails(this)"
											data-monday="{{ $req->WeeklyHours->Monday }}"
											data-tuesday="{{ $req->WeeklyHours->Tuesday }}"
											data-wednesday="{{ $req->WeeklyHours->Wednesday}}"
											data-thursday="{{ $req->WeeklyHours->Thursday}}"
											data-friday="{{ $req->WeeklyHours->Friday}}"
											data-saturday="{{ $req->WeeklyHours->Saturday}}"
											>
											{{ $req->services->name}}</a>
										</td>
										@else
										<td>{{ $req->services->name}}</td>
										@endif
										@if ($req->services->name=="Part Time")
										<td>1</td>
										@else
										<td>{{ $req->number_of }}</td>
										@endif
										@if ($req->services->name=="Part Time")
										<td>{{ $req->number_of }}</td>
										@elseif($req->services->name=="Ad Hoc")
										<td>{{$req->WeeklyHours->Monday+$req->WeeklyHours->Tuesday+$req->WeeklyHours->Wednesday+ $req->WeeklyHours->Thursday
											+ $req->WeeklyHours->Friday+ $req->WeeklyHours->Saturday }} 
										</td>
										@else
										<td>40 </td>
										@endif
										<td>{{ $req->skills }}</td>
										<td>
											<a href="{{ url('chat/'.$req->user->id) }}">
												<button type="button" class="btn btn-info btn-circle" title="Start Chat">
													<i class="icon-envelope-alt"></i>
												</button>
											</a>
											@if($req->status==0)
											<button type="button" class="btn btn-success btn-circle" onclick="approveClientRequest({{$req->user->id }} , {{$req->user->role_id }},{{$req->id }})" title="Approve & allocate Resources">
												<i class="icon-ok"></i>
											</button>
											<button type="button" class="btn btn-danger btn-circle" title="Delete" onclick="deleteClientRequest({{$req->id }})">
												<i class="icon-remove"></i>
											</button>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-lg-12 tab-pane fade in " id="Approved">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="approved__Requests">
								<thead>
									<tr>
										<th>#</th>
										<th>Client Name</th>
										<th>Email</th>
										<th>Phone #</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $count = 1; @endphp
									@foreach($approvedUser as $r_user)
									<tr>
										<td>{{ $count++ }}</td>
										<td>
											<a style=" cursor: pointer;" onclick="clientDetails(this)"  
											data-fname=" {{ $r_user->first_name }}" 
											data-lname="{{ $r_user->last_name }}" 
											data-email="{{ $r_user->email }}" 
											data-gender="{{ $r_user->gender }}" 
											data-phone="{{ $r_user->phone }}"
											data-address="{{ $r_user->address }}" 
											data-city="{{ $r_user->city }}" 
											data-state="{{ $r_user->state }}" 
											data-zip="{{ $r_user->zip}}" 
											data-country="{{ $r_user->country }}"
											data-joining_date="{{ $r_user->joining_date }}"
											data-company_name="{{ $r_user->client_company->company_name }}"                                     
											data-company_phone="{{ $r_user->client_company->company_phone}}" 
											data-company_address="{{ $r_user->client_company->company_address}}"
											data-company_zip="{{ $r_user->client_company->company_zip }}" 
											data-company_country="{{ $r_user->client_company->company_country }}" 
											data-no_of_employees="{{ $r_user->client_company->no_of_employees }}"    
											>
											{{ $r_user->first_name }} 
											{{ $r_user->last_name }}</a>
										</td>
										<td>{{ $r_user->email }}</td>
										<td>{{ $r_user->phone }}</td>
										<td>
											<a href="{{ url('chat/'.$req->user->id) }}">
												<button type="button" class="btn btn-info btn-circle" title="Start Chat">
													<i class="icon-envelope-alt"></i>
												</button>
											</a>
											<button type="button" class="btn btn-danger btn-circle" title="Delete" onclick="deleteClient({{$r_user->id }} , {{$r_user->role_id }})">
												<i class="icon-remove"></i>
											</button>

											<a href="{{ url('/hr/viewAllocation'.$r_user->id) }}">
												<button type="button" class="btn btn-success btn-circle" title="Start Chat">
													<i class="icon-info"></i>
												</button>
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-lg-12 tab-pane fade" id="Deleted">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover" id="Deleted__User">
								<thead>
									<tr>
										<th>#</th>
										<th>Client Name</th>
										<th>Email</th>
										<th>Phone #</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $count = 1; @endphp
									@foreach($deletedUser as $r_user)
									<tr>
										<td>{{ $count++ }}</td>
										<td>
											<a style=" cursor: pointer;" onclick="clientDetails(this)"  
											data-fname=" {{ $r_user->first_name }}" 
											data-lname="{{ $r_user->last_name }}" 
											data-email="{{ $r_user->email }}" 
											data-gender="{{ $r_user->gender }}" 
											data-phone="{{ $r_user->phone }}"
											data-address="{{ $r_user->address }}" 
											data-city="{{ $r_user->city }}" 
											data-state="{{ $r_user->state }}" 
											data-zip="{{ $r_user->zip}}" 
											data-country="{{ $r_user->country }}"
											data-joining_date="{{ $r_user->joining_date }}"
											data-company_name="{{ $r_user->client_company->company_name }}"                                     
											data-company_phone="{{ $r_user->client_company->company_phone}}" 
											data-company_address="{{ $r_user->client_company->company_address}}"
											data-company_zip="{{ $r_user->client_company->company_zip }}" 
											data-company_country="{{ $r_user->client_company->company_country }}" 
											data-no_of_employees="{{ $r_user->client_company->no_of_employees }}">
											{{ $r_user->first_name }} 
											{{ $r_user->last_name }}</a>
										</td>
										<td>{{ $r_user->email }}</td>
										<td>{{ $r_user->phone }}</td>
										<td>
											<button type="button" class="btn btn-warning btn-circle" onclick="restoreClient({{$r_user->id }} , {{$r_user->role_id }})" title="Activate">
												<i class="icon-undo"></i>
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
		<div class="modal fade" id="clientDetails" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body">
						<form role="form">
							<div class="panel panel-info" style="padding-bottom: 0px">
								<div class="panel-heading">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									Client Details 
								</div>
								<div class="panel-body">
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
									<hr>
									<div class="row  ">
										<div class="form-group col-lg-12">
											<label>Company Name :</label>
											<label style="font-weight: normal;  margin-left: 60px;" id=company_name></label>
										</div>
									</div>
									<div class="row  ">
										<div class="form-group col-lg-12">
											<label>Company Phone No :</label>
											<label style="font-weight: normal;  margin-left: 30px;" id=company_phone></label>
										</div>
									</div>
									<div class="row  ">
										<div class="form-group col-lg-12">
											<label>Company Address :</label>
											<label style="font-weight: normal;  margin-left: 42px;" id=company_address></label>
										</div>
									</div>
									<div class="row  ">
										<div class="form-group col-lg-12">
											<label>No of employess :</label>
											<label style="font-weight: normal;  margin-left: 53px;" id=no_of_employees></label>
										</div>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modal2" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body">
						<form role="form">
							<div class="panel panel-info" style="padding-bottom: 0px">
								<div class="panel-heading">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									Ad Hoc Details
								</div>
								<div class="panel-body">
									<div class="row" style="display: none;" id="1">
										<div class="form-group col-lg-12"" > 
											<label >Monday :</label>
											<label style="font-weight: normal;  margin-left: 43px;" id=Monday></label>
										</div>

									</div>
									<div class="row" style="display: none;" id="2" >
										<div class="form-group col-lg-12" >
											<label >Tuesday :</label>
											<label style="font-weight: normal;  margin-left: 40px;" id=Tuesday></label>
										</div>

									</div>
									<div class="row" style="display: none;" id="3" > 
										<div class="form-group col-lg-12" >
											<label >Wednesday :</label>
											<label style="font-weight: normal;  margin-left: 20px;" id=Wednesday></label>
										</div>

									</div>
									<div class="row" style="display: none;" id="4" > 
										<div class="form-group col-lg-12" >
											<label >Thurshday:</label>
											<label style="font-weight: normal;  margin-left: 30px;" id=Thursday></label>
										</div>

									</div>
									<div class="row" style="display: none;" id="5">
										<div class="form-group col-lg-12"  >
											<label >Friday :</label>
											<label style="font-weight: normal;  margin-left: 55px;" id=Friday></label>
										</div>

									</div>
									<div class="row" style="display: none;" id="6">
										<div class="form-group col-lg-12"  >
											<label >Saturday :</label>
											<label style="font-weight: normal;  margin-left: 38px;" id=Saturday></label>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
