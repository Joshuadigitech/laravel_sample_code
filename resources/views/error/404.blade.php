@extends('error.layout.app')
@section('content')
<div class="container">
    <div class="col-lg-8 col-lg-offset-2 text-center">
        <div class="logo">
            <h1>Error 404 !</h1>          </div>
        <p class="lead text-muted">Nope, What You Looking is Not here.</p>
        <div class="clearfix"></div>
        {{--<div class="col-lg-6 col-lg-offset-3">--}}
        {{----}}
        {{--</div>--}}
        <div class="clearfix"></div>
        <br />
        <div class="col-lg-6  col-lg-offset-3">
            <div class="btn-group btn-group-justified">
                <a href="#" class="btn btn-primary">Return Dashboard</a>
                <a href="#" class="btn btn-success">Return Website</a>
            </div>

        </div>
    </div>
</div>
@endsection
