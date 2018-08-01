{{-- @extends('layout.app')
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
										<div class="col-lg-12 ">											
											<div class="panel panel-info">
												<div class="panel-heading">
													<p>{{ucwords($tasks->title)}}</p>
													<h5></h5>
												</div>
												<div class="panel-body">									
													<p>{{ucwords($tasks->description)}}</p>
												</div>
											</div>											
										</div>
										<div class="col-lg-12 ">
											<div class="panel panel-info" style="overflow: auto ;max-height: 180px">
												<div class="panel-heading">
													<i class="icon-file-text-alt"></i> Files related to tasks
												</div>
												<div class="panel-body">
													<div class="list-group">
														@foreach($taskMedia as $item)
														<a href="#" class="list-group-item">
															<i class=" icon-file-text-alt"></i> {{$item->file}}
															<span class="pull-right text-muted small"><em>@php echo " ".DateFormat($item->created_at); @endphp </em>
															</span>
														</a>
														@endforeach		
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="col-lg-6">
										<div class="chat-panel panel panel-info">
											<div class="panel-heading">
												<i class="icon-comments"></i>Discussion
											</div>
											<div class="panel-body" id="scrollDiv">
											<ul id="chatBody" class="chat">

											<input type="hidden" class="form-control" id="lastRecode"name="lastRecode" value="{{$lastComment}}">
												@if($taskComment->count()>0)
												@foreach($taskComment as $t)
											

												@if($t->user->role_id== 1)
																		
													<li class="left clearfix">					
														<div class="chat-body clearfix">
															<div class="header">
																<strong class="primary-font"> {{ucwords($tasks->project->user->first_name)}} </strong>
																<small class="pull-right text-muted">
																	<i class="icon-time"></i> @php echo " ".DateFormat($t->created_at); @endphp
																</small>
															</div>
															<br>
															<p >
																{{$t->description}}
															</p>
														</div>
													</li>
													@else
													<li class="right clearfix">									
														<div class="chat-body clearfix">
															<div class="header">
																<small class=" text-muted">
																	<i class="icon-time"></i> @php echo " ".DateFormat($t->created_at); @endphp</small>
																	<strong class="pull-right primary-font"> {{ucwords($tasks->allocateTo->ManagerDetail->first_name)}}</strong>
																</div>
																<br>
																<p>{{$t->description}}</p>
															</div>
														</li>
														@endif
														@endforeach
														@else
														<div ">
															No comments found
														</div>
														@endif												
													</ul>
												</div>

												<div class="panel-footer">
													<form id="form-ajax" action="{{ url('/client/Comment') }}" method="Post" enctype="multipart/form-data">
														@csrf

														<div class="row">
															<div class="col-lg-12">
																<div class="col-lg-7" style="width: 70%;padding-right: 0px">
																	<div class="form-group">
																		<input class="form-control" id="description" name="description" type="text" placeholder="Enter comment here" required  />
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
																	<button type="submit" class="btn btn-primary">Send</button>
																</div>
															</div>												
														</div>
														<input type="hidden" class="form-control" name="task_id" id=task_id value="{{$tasks->id}}">
														<input type="hidden" class="form-control" name="comment_by" value="{{$tasks->project->user->id}}">
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
	@endsection
 --}}