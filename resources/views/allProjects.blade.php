@extends('layout.app')
@section('content')
<div id="content">
    <div class="inner" style="min-height: 700px;">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-exchange"></i></div>
                        <h5>Projects</h5>
                    </header>
                    <div class="body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="register__Requests">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Client Name</th>
                                            <th>Start Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach($projects as $project)

                                        <tr class="click-able" style=" cursor: pointer;" 
                                         @if(Auth::user()->role_id=='3')
                                         data-href="{{ url('/hr/ProjectsAllTasks/'.$project->id) }}" 
                                         @else

                                            data-href="{{ url('/admin/ProjectsAllTasks/'.$project->id) }}" 
                                            @endif
                                         >    
                                            @if($project->is_completed==1)
                                            <td class="CompletedProjects">{{ $count++ }}</td>
                                            @else
                                            <td>{{ $count++ }}</td>
                                            @endif
                                            <td>
                                                {{ $project->title }}
                                            </td>
                                            <td>
                                                {{ $project->description }}
                                            </td>
                                            <td>
                                                {{ $project->User->first_name }} {{ $project->User->last_name }}
                                            </td>
                                            <td>@php echo " ".DayandTimeFormat($project->start); @endphp </td>
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