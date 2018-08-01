@extends('layout.app')
@section('content')
<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-6">
                <h2>{{ $project->title }}</h2>
            </div>      
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
                @endif
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-exchange"></i></div>
                        <h5>All Tasks</h5>
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
                                            <th>Assigned To</th>  
                                            <th>Time Spent on Task(H:M:S)</th>                                      
                                            <th>Start Time and Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @foreach($taskdetail as $task)  
                                        <tr>
                                            @if($task['task']->is_completed==1)
                                            <td class="CompletedTasks">{{ $count++ }}</td>
                                            @else
                                            <td>{{ $count++ }}</td>
                                            @endif
                                            <td>{{ $task['task']->title }}</td>
                                            <td>{{ $task['task']->description }}</td>
                                            <td>{{ $task['task']->allocateTo->ManagerDetail->first_name }} {{ $task['task']->allocateTo->ManagerDetail->last_name }}</td>
                                            <td>{{$task['timeforTask']}}</td>
                                            <td>@php echo " ".DayandTimeFormat($task['task']->start); @endphp</td>
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
    <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="H4"> Create New Task</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/client/addTask') }}" class="form-horizontal" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Task Title</label>
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
                                    <label class="control-label">Task Description</label>
                                    <textarea name="description" placeholder="Description..."
                                    class="form-about-yourself form-control" id="form-skills" required></textarea>
                                    @if ($errors->has('description'))
                                    <br>
                                    <span class="alert alert-danger">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label" for="form-email">Client Managers</label>
                                    <select name="cm_id" class="form-control" required>
                                        <option value="">Select Client Manager</option>
                                        @foreach($resources as $resource)
                                        <option value="{{ $resource->clientManager->id }}"> {{ $resource->clientManager->first_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                             
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Files</label>
                                    <input name="file[]" type="file" multiple>
                                </div>
                                <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create!</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection