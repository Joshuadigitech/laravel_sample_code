@extends('layout.auth')
{{-- Title Of Page --}}
@section('title', 'Client Portal | login')
@section('content')
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Login</strong> to get Solution for your business</h1>
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
                        <form role="form" action="{{ route('login') }}" method="post" class="registration-form">
                            <fieldset>
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Login</h3>
                                        <p></p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-email">Email</label>
                                        <input id="email" type="email" class="form-email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-employeNum">How Many Employee You need</label>
                                        <input id="password" type="password" class="form-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn">Login!</button>
                                    <a href="register" class="btn">Sign Up!</a>
                                </div>
                            </fieldset>
                            @csrf
                             <input type="hidden" name="timeZone" id="timeZone" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript -->
@endsection