@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2> New Resource Request</h2>
            </div>
        </div>
        <hr />
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-8 container col-lg-offset-2">
                <form action="{{ url('/client/reqNewResourceRegister') }}" class="form-horizontal"  id="reqNewResourceRegister" method="post">
                  <fieldset>
                    <div class="form-bottom">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="sr-only" for="req_skills">Skills Require</label>
                                    <textarea name="req_skills" placeholder="Skills require..."
                                    class="form-about-yourself form-control" id="req_skills"></textarea>

                                    @if ($errors->has('req_skills'))
                                    <br>
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('req_skills') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Experience & Pricing</label>
                                    <select name="experience_level" id="experience_level"class="form-control">
                                        <option value="">Select Resource Experience level</option>
                                        @foreach($exp as $expe)
                                        {{-- @foreach($pricing AS $price)
                                        @if($expe->id == $price->level_id) --}}
                                        <option value="{{ $expe->id }}">{{ $expe->name }} experience </option>
                                    {{--     @endif
                                        @endforeach --}}
                                        @endforeach
                                    </select>
                                    @if ($errors->has('experience_level'))
                                    <br>
                                    <span class="alert alert-danger">
                                        <strong style="">{{ $errors->first('experience_level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Services Type</label>
                                    <select name="services" id="services" class="form-control">
                                        <option value="">Select Working Model</option>
                                        @foreach($services as $service)
                                        <option value="{{ $service->id }}"> {{ $service->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('services'))
                                    <br>
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('services') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" id="FullTime" style="display: none;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="sr-only" for="num_of_employee">How Many Employee You need</label>
                                    <input type="text" name="num_of_employee" placeholder="How Many Employee You need..." class="form-facebook form-control" id="num_of_employee" ">
                                </div>
                            </div>
                            @if ($errors->has('num_of_employee'))
                            <br>
                            <span class="alert alert-danger">
                                <strong>{{ $errors->first('num_of_employee') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row" id="PartTime" style="display: none;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="sr-only" for="numOfWorkingHour"></label>
                                    <input type="text" name="numOfWorkingHour" placeholder="Enter Number of Working hours" class="form-facebook form-control" id="numOfWorkingHour" >
                                </div>
                                @if ($errors->has('numOfWorkingHour'))
                                <br>
                                <span class="alert alert-danger">
                                    <strong>{{ $errors->first('numOfWorkingHour') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row" id="AdHoc" style="display: none;">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                 <div class="body">
                                    <div class="checkbox anim-checkbox">
                                            <input type="checkbox" name="" id="ch1" class="form-facebook form-control">
                                            <label for="ch1">Monday
                                            </label>
                                        </div>

                                        <div class="checkbox anim-checkbox">
                                            <input type="checkbox" id="ch2" class="primary" class="form-facebook form-control">
                                            <label for="ch2">Tuesday</label>
                                        </div>
                                        <div class="checkbox anim-checkbox">
                                            <input type="checkbox" id="ch3" class="success" class="form-facebook form-control">
                                            <label for="ch3">Wednesday</label>
                                        </div>
                                        <div class="checkbox anim-checkbox">
                                            <input type="checkbox" id="ch4" class="warning" class="form-facebook form-control">
                                            <label for="ch4">Thuesday</label>
                                        </div>
                                        <div class="checkbox anim-checkbox">
                                            <input type="checkbox" id="ch5" class="danger" class="form-facebook form-control">
                                            <label for="ch5">Friday</label>
                                        </div>
                                        <div class="checkbox anim-checkbox">
                                            <input type="checkbox" id="ch6" class="info" class="form-facebook form-control">
                                            <label for="ch6">Saturday</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">

                                  <div class="body">
                                    <div style="visibility: hidden;" id="mon">
                                        <label class="sr-only"  for="mondayHours">No Of Hours</label>
                                        <input type="number" name="mondayHours" id="mondayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control">
                                        @if ($errors->has('mondayHours'))
                                        <br>
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('mondayHours') }}</strong>
                                        </span>                                                    
                                        @endif
                                    </div>
                                    <div div style="visibility: hidden;" id="tue">
                                        <label class="sr-only" for="tuesdayHours">No Of Hours</label  >
                                        <input type="number" name="tuesdayHours" id="tuesdayHours" style=tuesdayHours"height: 27px;" placeholder="enter number of hours" class="form-facebook form-control">
                                        @if ($errors->has('tuesdayHours'))
                                        <br>
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('tuesdayHours') }}</strong>
                                        </span>
                                        @endif                                                    
                                    </div>
                                    <div style="visibility: hidden;" id="wed">
                                        <label class="sr-only" for="wednesdayHour">No Of Hours</label>
                                        <input type="number" name="wednesdayHour" id="wednesdayHour" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control">
                                        @if ($errors->has('wednesdayHour'))
                                        <br>
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('wednesdayHour') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div style="visibility: hidden;" id="thu">
                                        <label class="sr-only" for="thursdayHours">No Of Hours</label>
                                        <input type="number" name="thursdayHours" id="thursdayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control">
                                        @if ($errors->has('thursdayHours'))
                                        <br>
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('thursdayHours') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div style="visibility: hidden;" id="fri">  
                                        <label class="sr-only" for="fridayHours">No Of Hours</label>
                                        <input type="number" name="fridayHours" id="fridayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control">
                                        @if ($errors->has('fridayHours'))
                                        <br>
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('fridayHours') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div style="visibility: hidden;" id="sat">
                                        <label class="sr-only" for="saturdayHours">No Of Hours</label>
                                        <input type="number" name="saturdayHours" id="saturdayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control">
                                        @if ($errors->has('saturdayHours'))
                                        <br>
                                        <span class="alert alert-danger">
                                            <strong>{{ $errors->first('saturdayHours') }}</strong>
                                        </span>
                                        @endif
                                    </div>  
                                </div>


                            </div>
                        </div>
                    </div>
                    <center>  
                        <button type="submit" class="btn btn-primary">Proceed to request!</button>
                    </center>
                </fieldset>
                @csrf
            </form>

        </div>
    </div>
</div>
</div>
@endsection
<!-- Data Table SCRIPTS -->