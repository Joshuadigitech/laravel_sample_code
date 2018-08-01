@extends('layout.app')
@section('content')
<div id="content">                
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $client->first_name }} {{ $client->last_name }}</h2>
            </div>
        </div>
        <div class="row">            
        </div>
    </div>
</div>
@endsection
