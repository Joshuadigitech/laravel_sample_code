@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2> All Approved Clients </h2>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
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
                                    @foreach($all_clients as $r_user)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $r_user->first_name }} {{ $r_user->last_name }}</td>
                                        <td>{{ $r_user->email }}</td>
                                        <td>{{ $r_user->phone }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-circle" title="Start Chat">
                                                <i class="icon-envelope-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-circle" title="Delete" onclick="deleteClient({{$r_user->id }} , {{$r_user->role_id }})">
                                                <i class="icon-remove"></i>
                                            </button>
                                            <a href="allocation/{{$r_user->id}}" class="btn btn-success btn-circle" title="Assign Resource">
                                                <i class="icon-tags"></i>
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
@endsection