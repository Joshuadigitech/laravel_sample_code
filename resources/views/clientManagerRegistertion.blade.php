@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2> Client Manager Registration </h2>
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
                <form action="{{ url('/hr/cmSubmit') }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">First Name</label>
                                    <input id="f_name" type="text" class="form-control{{ $errors->has('f_name') ? ' is-invalid' : '' }}" name="f_name" value="{{ old('f_name') }}" required>

                                    @if ($errors->has('f_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Last Name</label>
                                    <input id="l_name" type="text" class="form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}" name="l_name" value="{{ old('l_name') }}" required>

                                    @if ($errors->has('l_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Email</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label class="control-label">Experience & Pricing</label>
                                <select name="exp_level" id="exp_level"class="form-control">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Password</label>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label class="control-label">Gender</label>
                                        <select class="form-control" required="" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-lg-offset-4 form-actions no-margin-bottom" style="text-align:center;">
                            <input type="submit" value="Register" class="btn btn-primary btn-lg " />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
<!-- Data Table SCRIPTS -->