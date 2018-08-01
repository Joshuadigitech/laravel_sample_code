<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title>{{ config('app.name', 'Laravel') }} </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <link rel="shortcut icon" type="image/png" href="{{ asset('public/auth/ico/favicon.png') }}../">

    <!-- GLOBAL STYLES -->
  
    <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/MoneAdmin.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/plugins/Font-Awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/plugins/datepicker/css/datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-fileupload.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/chat.css') }}" />
    <!--END GLOBAL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    @if(Route::current()->uri == 'hr/home')
    <link href="{{ asset('public/css/layout2.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/plugins/flot/examples/examples.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/plugins/timeline/timeline.css') }}" />
    @endif
    @if(Route::current()->uri == 'admin/viewreport')

    <link href="{{ asset('public/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" />

    @endif
    <!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- DATA TABLE STYLES -->
    <!--[if lt IE 9]>
        @if(Route::current()->uri == 'hr/registerRequests' || Route::current()->uri == 'admin/registerRequests')
        <link href="{{ asset('public/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet" />
        @endif
        <!-- END DATA TABLE  STYLES -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

        @if(Route::current()->uri == 'chat/{id}')
            
            <script type="text/javascript">
                var path="{!! url('/') !!}"
            </script>
            <!-- Styles -->
            {{-- <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> --}}
            <script>
                window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                    'pusherKey' => config('broadcasting.connections.pusher.key'),
                    'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
                ]) !!};
            </script>
        @endif
    </head>

    <body class="padTop53 " >
        <div id="wrap" style="overflow-x: hidden;">
            <!-- HEADER SECTION -->
            @include('layout.includes.topnav')
            <!-- END HEADER SECTION -->
            <!-- MENU SECTION -->
            @include('layout.includes.leftnav')
            <!--END MENU SECTION -->
            <!-- main Content -->
            @yield('content')
            <!-- main contect END-->
        </div>
        <!-- FOOTER -->
        <div id="footer">
            <p>&copy;  OboxDigitech &nbsp;2018 &nbsp;  </p>
        </div>
        <!--END FOOTER -->
        <!-- GLOBAL SCRIPTS -->

        <script src="{{ asset('public/plugins/jquery-2.0.3.min.js') }}"></script>        
        @if(Route::current()->uri != 'chat/{id}')
            <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        @endif
        <script src="{{ asset('public/plugins/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
        <!-- END GLOBAL SCRIPTS -->
        <!-- PAGE LEVEL SCRIPTS -->

        @if(Route::current()->uri == 'admin/viewreport')      
        <script src="{{ asset('public/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('public/plugins/daterangepicker/moment.min.js') }}"></script>     
       {{--  <script src="{{ asset('public/js/formsInit.js') }}"></script> --}}
        <script>
       
        </script>
        <script src="{{ asset('public/plugins/dataTables/jquery.dataTables.js')}}"></script>
            <script src="{{ asset('public/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
            <script src="{{ asset('public/plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('public/js/custom.js')}}"></script>
            <script>  
                $(".click-able").click(function() {window.location = $(this).data("href");});          
                $(document).ready(function () {
                    $('#register__Requests').dataTable();
                    $('#approved__Requests').dataTable();
                    $('#Deleted__User').dataTable();
                    $('#hr').dataTable();
                });
            </script>
        @endif





        @if(Route::current()->uri == 'hr/home')
        <script src="{{ asset('public/plugins/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('public/plugins/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('public/plugins/flot/jquery.flot.time.js') }}"></script>
        <script  src="{{ asset('public/plugins/flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('public/js/for_index.js') }}"></script>
        @endif

        <!-- Data Table and custome SCRIPTS -->
        @if(
            Route::current()->uri == 'cm/tasksDetails/{taskid}'||
            Route::current()->uri == 'cm/viewTasks'||
            Route::current()->uri == 'client/tasksDetails/{taskid}' ||            
            
            Route::current()->uri == 'admin/registerRequests' || 
            Route::current()->uri == 'admin/Users' ||
            Route::current()->uri == 'admin/viewProjects' ||
            Route::current()->uri == 'admin/clients' ||
            Route::current()->uri == 'admin/ProjectsAllTasks/{projectID}' || 

            Route::current()->uri == 'hr/registerRequests' ||          
            Route::current()->uri == 'hr/viewAllocation{id}' ||
            Route::current()->uri == 'hr/clients' ||
            Route::current()->uri == 'hr/allcm' ||
            Route::current()->uri == 'hr/viewProjects' ||
              Route::current()->uri == 'hr/ProjectsAllTasks/{projectID}' ||

            Route::current()->uri == 'client/all_Tasks/{projectID}' || 
            Route::current()->uri == 'client/allocatedManagers' ||
            Route::current()->uri == 'client/requestNewResource' ||
            Route::current()->uri == 'client/viewRequest/{id}' ||
            Route::current()->uri == 'client/projects'
            
            )
            <script src="{{ asset('public/plugins/dataTables/jquery.dataTables.js')}}"></script>
            <script src="{{ asset('public/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
            <script src="{{ asset('public/plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('public/js/custom.js')}}"></script>
            <script>  
                $(".click-able").click(function() {window.location = $(this).data("href");});          
                $(document).ready(function () {
                    $('#register__Requests').dataTable();
                    $('#approved__Requests').dataTable();
                    $('#Deleted__User').dataTable();
                    $('#hr').dataTable();
                });
            </script>
            @endif
            <!-- END DataTables SCRIPTS -->
            {{-- script for timer and comment section--}}

            @if(Route::current()->uri == 'client/tasksDetails/{taskid}'||
                Route::current()->uri == 'cm/tasksDetails/{taskid}'
                )
                <script src="{{ asset('public/js/jsForTimer.js')}}"></script>


            @endif

            @if(Route::current()->uri == 'chat/{id}')
                <script src="{{ asset('public/js/app.js') }}"></script>
            @endif


        {{--     @if(Route::current()->uri == 'login')
            
              
            @endif --}}
                {{-- end timer and comment section section script --}}
                 @yield('js')
        
            </body>
            <!-- END BODY -->
            </html>
             
            <script>
            // $("ul a")
            //     .click(function(e) {
            //         var link = $(this);

            //         var item = link.parent("li");

            //         if (item.hasClass("active")) {
            //             item.removeClass("active").children("a").removeClass("active");
            //         } else {
            //             item.addClass("active").children("a").addClass("active");
            //         }

            //         if (item.children("ul").length > 0) {
            //             var href = link.attr("href");
            //             link.attr("href", "#");
            //             setTimeout(function () {
            //                 link.attr("href", href);
            //             }, 300);
            //             e.preventDefault();
            //         }
            //     })
            //     .each(function() {
            //         var link = $(this);
            //         if (link.get(0).href === location.href) {
            //             link.addClass("active").parents("li").addClass("active");
            //             return false;
            //         }
            //     });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
