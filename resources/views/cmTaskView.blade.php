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
											<th>Start Date</th>
											<th>End Date</th>
											<th>Client</th>											
										</tr>
									</thead>
									@php $count = 1; @endphp
									<tbody>
										@foreach(Auth::User()->Task_Allocation  as $item)
										<tr class="click-able" style=" cursor: pointer;" data-href="{{ url('/cm/tasksDetails/'.$item->Task->id) }}" >
											<td>{{ $count++ }}</td>
											<td>{{ $item->Task->title }}</td>
											<td>{{ $item->Task->description }}</td>											
											<td>@php echo " ".DayandTimeFormat($item->Task->start); @endphp</td>
											@if($item->Task->end)
												<td>@php echo " ".DayandTimeFormat($item->Task->end); @endphp</td>
											@else
												<td></td>
											@endif
											<td>{{ $item->Task->project->user->first_name }} {{ $item->Task->project->user->last_name }}</td>
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


