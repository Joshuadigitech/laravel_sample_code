@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">                
	<div class="inner">
		<div class="row">
			<div class="col-lg-12">
				<h2>All Users</h2>
			</div>
			<div class="col-lg-12">        
				<a href="{{ url('/admin/addHR') }}"><button class="pull-right btn btn-success btn-small">Add New HR</button></a>
			</div>
		</div>
		<div class="row">
			<div class="panel-body">
				<ul class="nav nav-pills">
					<li class="active"><a href="#New" data-toggle="tab">Clients</a></li>					
					<li ><a href="#Approved" data-toggle="tab">Client Manager</a></li>
					<li><a href="#Deleted" data-toggle="tab">HR</a></li>
				</ul>
				<div class="tab-content">
					<div class="col-lg-12 tab-pane fade in active" id="New">
						<div class="table-responsive">
							<table class="table table-bordered table-hover" id="approved__Requests">
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
									@foreach($client as $r_user)
									<tr>
										@if($r_user->is_approved==1)
										<td class="approvedRequest">{{ $count++ }}</td>
										@else
										<td>{{ $count++ }}</td>
										@endif
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
											data-company_name="{{ $r_user->client_company->company_name }}"data-company_phone="{{ $r_user->client_company->company_phone}}" 
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
											<a href="{{ url('chat/'.$r_user->id) }}">
												<button type="button" class="btn btn-info btn-circle" title="Start Chat">
													<i class="icon-envelope-alt"></i>
												</button>
											</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-lg-12 tab-pane fade in " id="Approved">
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
									@foreach($cm as $r_user)
									<tr>
										<td>{{ $count++ }}</td>                                 
										<td>
											{{ ucwords($r_user->first_name) }} 
											{{ $r_user->last_name }}
										</td>
										<td>{{ $r_user->email }}</td>
										<td>{{ $r_user->phone }}</td>
										<td> 
											<a href="{{ url('chat/'.$r_user->id) }}">
												<button type="button" class="btn btn-info btn-circle" title="Start Chat">
													<i class="icon-envelope-alt"></i>
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
							<table class="table table-striped table-bordered table-hover" id="hr">
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
									@foreach($hr as $r_user)
									<tr>
										<td>{{ $count++ }}</td>
										<td>
											{{ ucwords($r_user->first_name) }} 
											{{ $r_user->last_name }}
										</td>
										<td>{{ $r_user->email }}</td>
										<td>{{ $r_user->phone }}</td>
										<td> 
											<a href="{{ url('chat/'.$r_user->id) }}">
												<button type="button" class="btn btn-info btn-circle" title="Start Chat">
													<i class="icon-envelope-alt"></i>
												</button>
											</a>
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
			</div>
		</div>
	</div>
</div>

@endsection
<!-- Data Table SCRIPTS -->