@extends('layout.app') 
@section('content')
<div id="content">
	<div class="inner" style="min-height: 700px;">
		<div class="row">
			<div class="col-lg-6">
				<h2></h2>
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
					<div class="body">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<b>{{ucwords($tasks->project->title)}}</b>
								</div>
								<div class="panel-body">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-12 ">
												<div class="panel panel-info">
													<div class="panel-heading">
														<p>{{ucwords($tasks->title)}}</p>
													</div>
													<div class="panel-body">
														<p>{{ucwords($tasks->description)}}</p>
													</div>
													<div class="panel-footer" style="background-color: #d9edf7;">
														<button class="btn btn-primary" data-toggle="modal" data-target="#notificationModal">
															Spent Time Detail
														</button>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 ">
												<div class="panel panel-info" style="">
													<div class="panel-heading">
														<i class="icon-file-text-alt"></i> Files related to tasks
													</div>
													<div class="panel-body" style="overflow: auto; max-height: 150px">
														<div class="list-group">
															@foreach($taskMedia as $item)															
															<a href="" onclick="openInNewTab('{{route('getFile', ['id' => $item->file,'taskId'=>$tasks->id])}}')" class="list-group-item">
																<i class=" icon-file-text-alt"></i>
																@php
																$userName= explode("-", $item->file);
																for($i=1;$i<count($userName);$i++)
																{
																	echo $userName[$i];
																	if($i<count($userName)-1)
																	{
																		echo "-";
																	}
																}																
																@endphp
																<span class="pull-right text-muted small"><em> 
																	@php echo " ". DayandTimeFormat($item->created_at); 
																	@endphp
																</em>
															</span>
														</a> @endforeach
													</div>
												</div>
											</div>
										</div>
									</div>
									@if($user->role_id==2)
									<div class="row">
										<div class="=col-lg-12" style="
										text-align: center;">
										<a id="play" class="btn btn-success btn-lg">Clock In</a>
										<a id="pause" class="btn btn-warning btn-lg">Break</a>
										<a id="stop" class="btn btn-danger btn-lg">Clock out</a>
									</div>
									@isset ($timeOntask)
									<div class="row">
										<div class="col-lg-12" style="text-align: center">
											<h4>@php echo "Task Started ".timeInterval($timeOntask->day.' '.$timeOntask->start); 
											@endphp</h4>
										</div>
									</div>
									@endisset
									<h4 id="info" style="text-align: center"></h4>
									<div class="row">
										<div class="col-lg-12" style="text-align: center">

											<h5 style="color: red" id="warning"></h5>
										</div>
									</div>
								</div>
								@endif
							</div>
							<div class="col-lg-6">
								<div class="chat-panel panel panel-info">
									<div class="panel-heading">
										<i class="icon-comments"></i> Discussion
									</div>
									<div class="panel-body" style="padding: 0px;  height: 0px;  overflow-y: visible">
										<div id="frame">
											<div class="content" style="width: 100%;height: 500px">
												<div class="messages" id="scrollDiv" style="width: 100%;    min-height: calc(100% - 20px);
												max-height: calc(100% - 33px);">
												<input type="hidden" class="form-control" id="lastRecode" name="lastRecode" value="{{$lastComment}}">
												<ul id="chatBody" class="chat">
													@if($taskComment->count()>0)
													@foreach($taskComment as $t) {{-- expr --}} 
													@if($t->user->role_id== 1) {{-- means client --}}
													<li class="sent">
														@if(isset($t->project->user->avtar))
														<img src="{{$t->project->user->avtar}}" alt="" /> @else
														<img src="{{ asset('public/img/avatar.png') }}" alt="" /> @endif @if($t->description != '')
														<p>{{$t->description}}</p>
														@endif
														<small>
															<i class="icon-time"></i>
															@php echo " ".timeInterval($t->created_at); 
															@endphp
														</small>
														@foreach ($taskMediaComment as $element) 
														@if($element->comment_id==$t->id)
														<a href="" style="margin-top: 12px;" onclick="openInNewTab('{{route('getFile', ['id' => $element->file,'taskId'=>$tasks->id])}}')" class="list-group-item">
															<i class=" icon-file-text-alt"></i> 
															@php
															$userName= explode("-", $element->file);
															for($i=1;$i<count($userName);$i++)
															{
																echo $userName[$i];
																if($i<count($userName)-1)
																{
																	echo "-";
																}
															}																
															@endphp 
															<span class="pull-right text-muted small"><em>
																@php echo " ". DayandTimeFormat($element->created_at); 
																@endphp
															</em>
														</span>
													</a> @endif @endforeach
												</li>
												@else
												<li class="replies">
													@if(isset($t->project->user->avtar))
													<img src="{{$t->ManagerDetail->user->avtar}}" alt="" /> @else
													<img src="{{ asset('public/img/avatar.png') }}" alt="" /> @endif @if($t->description != '')
													<p>{{$t->description}}</p>
													@endif
													<small style="float: right; text-align: center;"><i class="icon-time" style=";"></i>@php echo " ".timeInterval($t->created_at); 
													@endphp</small>	
													@foreach ($taskMediaComment as $element) 
													@if($element->comment_id==$t->id)
													<a href="" style="margin-top: 40px;" onclick="openInNewTab('{{route('getFile', ['id' => $element->file,'taskId'=>$tasks->id])}}')" class="list-group-item">
														<i class="icon-file-text-alt"></i> 
														@php
														$userName= explode("-", $element->file);
														for($i=1;$i<count($userName);$i++)
														{
															echo $userName[$i];
															if($i<count($userName)-1)
															{
																echo "-";
															}
														}																
														@endphp 
														<span class="pull-right text-muted small"><em>
															@php echo " ". DayandTimeFormat($element->created_at); 
															@endphp
														</em>
													</span>
												</a> @endif @endforeach
											</li>
											@endif @endforeach @else
											<h4>No Comments History</h4>
											@endif
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<form id="form-ajax" method="Post" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-lg-12">
										<div class="col-lg-7" style="width: 70%;padding-right: 0px">
											<div class="form-group">
												<input class="form-control" id="description" name="description" type="text" placeholder="Enter comment here" />
											</div>
										</div>
										<div class="col-lg-3" style="width: 10%;padding-right: 0px">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<span class="btn btn-file btn-default">
													<i class=" icon-file-text-alt"></i>
													<input name="file[]" type="file" multiple>
												</span>
												<span class="fileupload-preview"></span>
												<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
											</div>
										</div>
										<div class="col-lg-2" style="width: 20%">
											<button type="submit" id="submitComment" class="btn btn-primary">Send</button>
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control" id="task_id" name="task_id" value="{{$tasks->id}}">
								<input type="hidden" class="form-control" name="comment_by" value="{{$user->id}}">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-12">
	<div class="modal" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Task Report</h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="register__Requests">
							<thead>
								<tr>
									<th>#</th>
									<th>Day</th>
									<th>Current Status</th>
									<th>Time Spend On Task</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 1; 
								@endphp @foreach ($result['day'] as $elemen)
								<tr>
									<td>{{ $count++ }}</td>
									<td> 
										@php echo " ". DateOnly($elemen['date']); 
									@endphp</td>
									@if($elemen['status'])
									<td>Close</td>
									<td>{{$elemen['workingHour']}}</td>
									@else
									<td>Open</td>
									<td>{{timeInterval($timeOntask->day.' '.$timeOntask->start)}}</td>
									@endif
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
@endsection