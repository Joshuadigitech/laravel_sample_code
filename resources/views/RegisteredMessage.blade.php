@extends('layout.auth')
@section('title', 'Client Portal | Registeration Sucessfull')
@section('content')
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Registered Successfully </strong></h1>          
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <form role="form" action="{{ route('login') }}" method="post" class="registration-form">
                        <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Success</h3>
                                    <p></p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <h1 >You Are Registered Sucessfully.</h1>
                                <h1>Managers Will Contact You Soon.</h1>
                            </div>
                        </fieldset>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection