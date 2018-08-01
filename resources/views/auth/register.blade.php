@extends('layout.auth')
{{-- Title Of Page --}}
@section('title', 'Client Portal | Registration')
@section('content')
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Register</strong> to get Solution for your business</h1>
                    {{--<div class="description">--}}
                        {{--<p>--}}
                            {{--This is a free responsive multi-step registration form made with Bootstrap.--}}
                            {{--Download it on <a href="http://azmind.com"><strong>AZMIND</strong></a>, customize and use it as you like!--}}
                        {{--</p>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <form role="form" action="{{ route('register') }}" method="post" id="signupForm" class="registration-form">
                        <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Step 1 / 3</h3>
                                    <p>Tell us who you are:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-first-name">First name</label>
                                            <input id="f_name" type="text" placeholder="First name..."  class="form-first-name form-control{{ $errors->has('f_name') ? ' is-invalid' : '' }}" name="f_name" value="{{ old('f_name') }}" >

                                            @if ($errors->has('f_name'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('f_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-last-name">Last name</label>
                                            <input id="l_name" type="text" placeholder="Last name..." class="form-last-name form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}" name="l_name" value="{{ old('l_name') }}" >

                                            @if ($errors->has('l_name'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('l_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input id="email" type="text" placeholder="Email..." data-validation="email" class="form-email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" >

                                            @if ($errors->has('email'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Password</label>
                                            <input id="password" placeholder="Password..." type="password" class="form-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                                            @if ($errors->has('password'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-repeat-password">Repeat password</label>
                                            <input type="password" name="password_confirmation" placeholder="Repeat password..."
                                            class="form-repeat-password form-control" id="form-repeat-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-phone">Phone</label>
                                            <input id="phone_number" placeholder="Phone Number..." type="text" class="form-email form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" >

                                            @if ($errors->has('phone_number'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <center><button type="button" class="btn btn-next">Next</button></center>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Step 2 / 3</h3>
                                    <p>Tell us about your company:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-cogs"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-company-name">Company name</label>
                                            <input id="company_name" type="text" placeholder="Company name..." class="form-company-name form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" >

                                            @if ($errors->has('company_name'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-phone">Address</label>
                                            <input id="company_address" placeholder="Company Address..." type="text" class="form-email form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" name="company_address" value="{{ old('company_address') }}" >

                                            @if ($errors->has('company_address'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('company_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-phone">Postal Code</label>
                                            <input id="comapny_zip" placeholder="Postal Code..." type="text" class="form-email form-control{{ $errors->has('comapny_zip') ? ' is-invalid' : '' }}" name="company_zip" value="{{ old('comapny_zip') }}" >

                                            @if ($errors->has('comapny_zip'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('comapny_zip') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-phone">Country</label>
                                            <input id="country" placeholder="Country..." type="text" class="form-email form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}" >

                                            @if ($errors->has('country'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-phone">Company Phone</label>
                                            <input id="company_phone_number" placeholder="Company Phone Number..." type="text" class="form-email form-control{{ $errors->has('company_phone_number') ? ' is-invalid' : '' }}" name="company_phone_number" value="{{ old('company_phone_number') }}" >

                                            @if ($errors->has('company_phone_number'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('company_phone_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-phone">No. of Employes</label>
                                            <input id="Cnum_of_employee" placeholder="No. Of Employes..." type="text" class="form-email form-control{{ $errors->has('Cnum_of_employee') ? ' is-invalid' : '' }}" name="Cnum_of_employee" value="{{ old('Cnum_of_employee') }}" >

                                            @if ($errors->has('Cnum_of_employee'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong>{{ $errors->first('Cnum_of_employee') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <center>
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </center>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Step 3 / 3</h3>
                                    <p>Select Services:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                            </div>

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
                                                {{-- @foreach($pricing AS $price) --}}
                                               {{--  @if($expe->id == $price->level_id) --}}
                                                <option value="{{ $expe->id }}">{{ $expe->name }} experience </option>
                                              {{--   @endif --}}
                                                {{-- @endforeach --}}
                                                @endforeach
                                            </select>
                                            @if ($errors->has('experience_level'))
                                            <br>
                                            <span class="alert alert-danger">
                                                <strong style="font-weight: 100;">{{ $errors->first('experience_level') }}</strong>
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
                                            <div class="box">

                                                <div class="body">

                                                    <div class="checkbox anim-checkbox">
                                                        <input type="checkbox" name="" id="ch1" class="form-facebook form-control">
                                                        <label for="ch1">Monday</label>


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
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="box">
                                              <div class="body">
                                                <div style="visibility: hidden;" id="mon">
                                                    <label class="sr-only"  for="mondayHours">No Of Hours</label>
                                                    <input type="number" name="mondayHours" id="mondayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control" min="0" max="8">
                                                    @if ($errors->has('mondayHours'))
                                                    <br>
                                                    <span class="alert alert-danger">
                                                        <strong>{{ $errors->first('mondayHours') }}</strong>
                                                    </span>                                                    
                                                    @endif
                                                </div>
                                                <div div style="visibility: hidden;" id="tue">
                                                    <label class="sr-only" for="tuesdayHours">No Of Hours</label  >
                                                    <input type="number" name="tuesdayHours" id="tuesdayHours" style=tuesdayHours"height: 27px;" placeholder="enter number of hours" class="form-facebook form-control" min="0" max="8">
                                                    @if ($errors->has('tuesdayHours'))
                                                    <br>
                                                    <span class="alert alert-danger">
                                                        <strong>{{ $errors->first('tuesdayHours') }}</strong>
                                                    </span>
                                                    @endif                                                    
                                                </div>
                                                <div style="visibility: hidden;" id="wed">
                                                    <label class="sr-only" for="wednesdayHour">No Of Hours</label>
                                                    <input type="number" name="wednesdayHour" id="wednesdayHour" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control" min="0" max="8">
                                                    @if ($errors->has('wednesdayHour'))
                                                    <br>
                                                    <span class="alert alert-danger">
                                                        <strong>{{ $errors->first('wednesdayHour') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div style="visibility: hidden;" id="thu">
                                                    <label class="sr-only" for="thursdayHours">No Of Hours</label>
                                                    <input type="number" name="thursdayHours" id="thursdayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control" min="0" max="8">
                                                    @if ($errors->has('thursdayHours'))
                                                    <br>
                                                    <span class="alert alert-danger">
                                                        <strong>{{ $errors->first('thursdayHours') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div style="visibility: hidden;" id="fri">  
                                                    <label class="sr-only" for="fridayHours">No Of Hours</label>
                                                    <input type="number" name="fridayHours" id="fridayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control" min="0" max="8">
                                                    @if ($errors->has('fridayHours'))
                                                    <br>
                                                    <span class="alert alert-danger">
                                                        <strong>{{ $errors->first('fridayHours') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div style="visibility: hidden;" id="sat">
                                                    <label class="sr-only" for="saturdayHours">No Of Hours</label>
                                                    <input type="number" name="saturdayHours" id="saturdayHours" style="height: 27px;" placeholder="enter number of hours" class="form-facebook form-control" min="0" max="8">
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
                            </div>


                            <center>
                                <button type="button" class="btn btn-previous">Previous</button>
                                <button type="submit" class="btn">Sign me up!</button>
                            </center>
                        </fieldset>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="col-lg-6">
    <div class="modal fade" id="AdHoc" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" >Modal title</h4>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Javascript -->
@endsection