@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Hiring for {{$client->first_name}} {{$client->last_name}}</h2>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-exchange"></i></div>
                        <h5>Allocate New Manager</h5>
                    </header>
                    <div class="body">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{session()->get('message')}}
                        </div>
                        @endif
                        @if(session()->has('erorr'))
                        <div class="alert alert-danger">
                            {{session()->get('erorr')}}
                        </div>
                        @endif

                         @if(!count($clientManger)>0)
                        <div class="alert alert-danger" role="alert">
                            No Client Manager is Available for this Request
                        </div>
                         @endif
                        <form id="validVal" class="form-inline" action="{{url('/hr/allocate')}}" method="post">
                            @csrf
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <div class="col-lg-5">                                        
                                        <input type="hidden" name="client_id" value="{{$client->id}}">
                                        <input type="hidden" name="services" value="{{$clientRequest->services_type}}">
                                        <input type="hidden" name="requestID" value="{{$clientRequest->id}}">
                                        <label>Select Client Manager</label>
                                        <select class="form-control" name="client_manager">
                                            <option value="">Select Manager</option>
                                            @isset($clientManger)
                                            @foreach($clientManger AS $cm)
                                            @if(showHours($cm->id,$clientRequest->id))
                                             <option value="{{$cm->id}}">{{$cm->first_name}} {{$cm->last_name}}</option>
                                            @endif                                           
                                            @endforeach
                                            @endisset
                                        </select>
                                        @if ($errors->has('client_manager'))
                                        <span class="help-block" style="color: red">
                                            {{ $errors->first('client_manager') }}
                                        </span>
                                        @endif
                                    </div>                            
                                    <div class="col-lg-2 allocate-Btn">
                                        <button type="submit" class="btn btn-success btn-small">Allocate</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-exchange"></i></div>
                        <h5>Already Allocated Manager</h5>
                    </header>
                    <div class="body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="register__Requests">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Services</th>
                                            <th>Hired date #</th>
                                            {{--<th>Action</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach($allocated_managers as $allocated_CM)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>
                                                {{ $allocated_CM->clientManager->first_name }} 
                                                {{ $allocated_CM->clientManager->last_name }}
                                            </td>
                                            <td>{{ $allocated_CM->services->name }}</td>
                                            <td>@php echo "".DateOnly($allocated_CM->allocation_date); @endphp</td>
                                            {{--<td>--}}
                                                {{--<button type="button" class="btn btn-danger btn-circle" title="Delete" onclick="deleteAllocatedCM({{$allocated_CM->id }},1)">--}}
                                                    {{--<i class="icon-remove"></i>--}}
                                                {{--</button>--}}
                                            {{--</td>--}}
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
@endsection
