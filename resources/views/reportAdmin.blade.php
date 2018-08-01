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
               <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons">
                                <i class="icon-calendar"></i>
                            </div>
                            <h5>Report</h5>
                            <div class="toolbar">
                                <ul class="nav pull-right">
                                    <li>
                                        <a href="#dateRangePickerBlock" data-toggle="collapse"
                                        class="accordion-toggle minimize-box">
                                        <i class="icon-chevron-up"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="close-box">
                                        <i class="icon-remove"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="dateRangePickerBlock" class="body collapse in">
                        <form  class="form-horizontal" method="GET">                    
                            <div class="form-group">                             
                                <div class="form-group ">
                                    <label class="control-label col-lg-4" for="reservation">Select Client Manager</label>
                                    <div class="col-lg-4">

                                        <div class="input-group">
                                            <select class="form-control" name="client_manager">                                               
                                                <option value="">Select Manager</option>
                                                @foreach($clientManger as $cm)
                                                <option value="{{$cm->id}}">{{$cm->first_name}} {{$cm->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label col-lg-4" for="reportrange1">Select Date</label>
                                <div class="col-lg-4">                                   
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        @if(isset($info['start_date']))
                                        <input type="text" name="reportrange1"class="form-control" value="{{$info['start_date']}}-{{$info['end_date']}}" required="true" id="reportrange1" autocomplete="off"/>
                                        @else
                                        <input type="text" name="reportrange1"class="form-control" value="" required="true" id="reportrange1" autocomplete="off"/>
                                        @endif
                                    </div>
                                </div>
                                <input type="submit" value="Filter" class="btn btn-primary btn-md " />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="icon-exchange"></i></div>
                <h5>Details</h5>
            </header>
            <div class="body">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="register__Requests">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Task Name</th>
                                    <th>Time Spent</th>
                                    <th>Amount</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach($result as $key)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$key['project_title']}}</td>  
                                    <td>{{$key['name']}}</td>                                   
                                    <td>{{$key['timeforTask']+0}}</td>  
                                    
                                    <td>@php echo Currency($key['amount']) @endphp</td>                                                    
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
@section('js')
{{--  $('#reportrange1').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                start:'10-03-17',
                end:'11-03-17',
            },
    function (start, end) {
        $('#reportrange1 span').html(start.format('MMMM D, YYYY') + '-' + end.format('MMMM D, YYYY'));
    }
    ); --}}
    <script type="text/javascript"> 

        $(document).ready(function() {
         $("#reportrange1").daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            forceUpdate: true,
            @if(isset($info['start_date']))
            startDate :' {{$info['start_date']}}',
            endDate : '{{$info['end_date']}}',
            @endif
            callback: function(startDate, endDate, period)
            {
                var title = startDate.format('MMMM D, YYYY') + ' – ' + endDate.format('MMMM D, YYYY');
                $("#reportrange1").val(title);
                $('#reportrange1 span').html(start.format('MMMM D, YYYY') + '-' + end.format('MMMM D, YYYY'));
            }

        },
        function (start, end) 
        {
            $('#reportrange1 span').html(start.format('MMMM D, YYYY') + '-' + end.format('MMMM D, YYYY'));
        }
        );

     });
        @if(isset($info['cm_id']))
        $('[name=client_manager]').val({{$info['cm_id']}} );   
        @endif

    </script>
    @endsection