
@if($taskComment->count()>0)
@foreach($taskComment as $t)
{{-- expr --}}
@if($t->user->role_id== 1) {{-- means client --}}
<li class="sent">
	@if(isset($t->project->user->avtar))
	<img src="{{$t->project->user->avtar}}" alt="" />
	@else
	<img src="{{ asset('public/img/avatar.png') }}" alt="" />
	@endif
	@if($t->description != '')
	<p>{{$t->description}}</p>
	@endif
	<small ><i class="icon-time"></i>
		@php echo " ".timeInterval($t->created_at);
		@endphp
	</small>
	@foreach ($taskMediaComment as $element)
	@if($element->comment_id==$t->id)
	<a href="" style="    margin-top: 12px;" onclick="openInNewTab('{{route('getFile', ['id' => $element->file,'taskId'=>$tasks])}}')" class="list-group-item">
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
			@php echo " ". DayandTimeFormat($element->created_at); @endphp
		</em>
	</span>
</a>
@endif
@endforeach
</li>
@else
<li class="replies">
	@if(isset($t->project->user->avtar))
	<img src="{{$t->ManagerDetail->user->avtar}}" alt="" />
	@else
	<img src="{{ asset('public/img/avatar.png') }}" alt="" />
	@endif
	@if($t->description != '')
	<p>{{$t->description}}</p>
	@endif
	<small style="float: right; text-align: center;">
		<i class="icon-time" style=";"></i>
		@php echo " ".timeInterval($t->created_at); 
		@endphp
	</small>
	@foreach ($taskMediaComment as $element)
	@if($element->comment_id==$t->id)
	<a href="" style="margin-top: 38px;" onclick="openInNewTab('{{route('getFile', ['id' => $element->file,'taskId'=>$tasks])}}')" class="list-group-item">
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
			@php echo " ". DayandTimeFormat($element->created_at); @endphp
		</em>
	</span>
</a>
@endif
@endforeach
</li>
@endif
@endforeach
@else
<h4>No Comments History</h4>
@endif