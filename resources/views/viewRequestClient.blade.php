@extends('layout.app') 
@section('content')
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-6">
                <h2></h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
                @endif
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-exchange"></i></div>
                        <h5>All Requests</h5>
                    </header>
                    <div class="body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover" id="register__Requests">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;"># </th>
                                            <th>Required Exp</th>
                                            <th>Required Services</th>
                                            <th># Required Resoureces</th>
                                            <th>Hours/week</th>
                                            <th>Skills</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; 
                                        @endphp @foreach($clientRequests as $req)
                                        <tr>
                                            @if($req->status==2)
                                            <td class="deletedRequest">{{ $count++ }}</td>
                                            @elseif($req->status==1)
                                            <td class="approvedRequest">{{ $count++ }}</td>
                                            @else
                                            <td>{{ $count++ }}</td>
                                            @endif
                                            
                                            
                                            <td>{{ $req->experience->name}}</td>
                                            @if ($req->services->name=="Ad Hoc")
                                            <td>
                                                <a style=" cursor: pointer;" onclick="AdHocDetails(this)" data-monday="{{ $req->WeeklyHours->Monday }}" data-tuesday="{{ $req->WeeklyHours->Tuesday }}"
                                                    data-wednesday="{{ $req->WeeklyHours->Wednesday}}" data-thursday="{{ $req->WeeklyHours->Thursday}}"
                                                    data-friday="{{ $req->WeeklyHours->Friday}}" data-saturday="{{ $req->WeeklyHours->Saturday}}">
                                                    {{ $req->services->name}}
                                                </a>
                                            </td>
                                            @else
                                            <td>{{ $req->services->name}}</td>
                                            @endif @if ($req->services->name=="Part Time")
                                            <td>1</td>
                                            @else
                                            <td>{{ $req->number_of }}</td>
                                            @endif @if ($req->services->name=="Part Time")
                                            <td>{{ $req->number_of }}</td>
                                            @elseif($req->services->name=="Ad Hoc")
                                            <td>{{$req->WeeklyHours->Monday+$req->WeeklyHours->Tuesday+$req->WeeklyHours->Wednesday+
                                                $req->WeeklyHours->Thursday + $req->WeeklyHours->Friday+ $req->WeeklyHours->Saturday
                                            }} </td>
                                            @else
                                            <td>40 </td>
                                            @endif
                                            <td>{{ $req->skills }}</td>                    
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
@endsection