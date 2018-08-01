@extends('layout.app')
@section('content')
<div id="content">
  <div class="inner" style="min-height: 700px;">
   <div class="row">
    <div class="col-lg-6">
        <h2>All Projects</h2>
    </div>
    <div class="col-lg-6">
        <br>
        @if(!$isAllocated)
            <button class="pull-right btn btn-success btn-small" data-toggle="modal"  data-target="#newProject">Create New Project!</button>
        @endif
    </div>

</div>
<hr>
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
                @if($isAllocated)
                    <div class="alert alert-danger" role="alert">
                        You did not hire any Resource yet. Please contact to HR Manager.
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="register__Requests">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach($projects as $project)

                                    <tr class="click-able" style=" cursor: pointer;" data-href="{{ url('/client/all_Tasks/'.$project->id) }}" >    
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

<div class="col-lg-12">
    <div class="modal fade" id="newProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="H4">Create New Project</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/client/addProject') }}" class="form-horizontal" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Title</label>
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>

                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Type Of Company</label>
                                    <textarea name="description" placeholder=""
                                    class="form-about-yourself form-control" id="form-skills" required></textarea >

                                    @if ($errors->has('description'))
                                    <br>
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection