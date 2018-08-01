@extends('layout.app')
@section('content')
<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Hired Resources</h2>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-exchange"></i></div>
                        <h5>Allocated Manager</h5>
                    </header>
                    <div class="body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="register__Requests">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Emal</th>
                                            <th>Services</th>
                                            <th>Hired date #</th>
                                            <th>Action</th>
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
                                            <td>
                                                {{ $allocated_CM->clientManager->email }}
                                            </td>
                                            <td>{{ $allocated_CM->services->name }}</td>
                                            <td>@php echo "".DateOnly($allocated_CM->allocation_date); @endphp</td>
                                            <td>
                                            <a href="{{ url('chat/'. $allocated_CM->clientManager->id) }}">
                                                <button type="button" class="btn btn-info btn-circle" title="Start Chat">
                                                    <i class="icon-envelope-alt"></i>
                                                </button>
                                            </a>
                                            </td>
                                            {{--<td>--}}
                                                {{--<button type="button" class="btn btn-danger btn-circle" title="Delete" onclick="deleteAllocatedCM({{$allocated_CM->id }},0)">--}}
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
<!-- Data Table SCRIPTS -->