<div id="left" >
    <div class="media user-media well-small">
        <a class="user-link" href="#">
        @if(Auth::user()->avatar == '')
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('public/img/avatar.png') }}" />

            @else
            {{-- <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ Auth::user()->avatar }}" /> --}}
            <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('public/img/'.$user->avatar) }}" />
            @endif
        </a>
        <br />
        <div class="media-body">
            <h5 class="media-heading"> {{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
            <ul class="list-unstyled user-info">
                <li>
                    <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                </li>
            </ul>
        </div>
        <br />
    </div>
    <ul id="menu" class="collapse">
        <li class="panel">
            <a href="{{ url('/client/home') }}" >
                <i class="icon-table"></i> Dashboard
            </a>
        </li>
        <!-- for client -->
        @if(Auth::user()->role_id == 1) 
        <li class="panel">
            <a href="{{ url('/client/allocatedManagers') }}" >
                <i class="icon-table"></i> Allocated Managers
            </a>
            
        </li>
        <li class="panel">
            <a href="{{ url('/client/projects') }}" >
                <i class="icon-table"></i> Projects
            </a>
        </li>
        <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#client-nav">
                    <i class="icon-user"></i> Hiring
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                </a>
               
                <ul class="collapse" id="client-nav">
                        
                    <li><a href="{{ url('/client/viewRequest')}}"><i class="icon-angle-right"></i>View Requests</a></li>
                    <li><a href="{{ url('/client/requestNewResource') }}"><i class="icon-angle-right"></i> Hire New Resource </a></li>
                </ul>
               
            </li>
        @endif
        <!-- for cm -->
        @if(Auth::user()->role_id == 2)
        <li class="panel">
            <a href="{{ url('/cm/viewTasks') }}" >
                <i class="icon-table"></i> Tasks
            </a>
        </li>
        
        @endif
        
        {{-- 
            It checks weather the user is HR or Director
            3 stands for HR
            4 stands for Director
            --}}
            @if(Auth::user()->role_id == 4)
                <li class="panel">
                    <a href="{{ url('/admin/Users') }}" >
                        <i class="icon-reorder"></i> All Users
                    </a>
                </li>
               
                  <li class="panel">
                    <a href="{{ url('/admin/viewProjects') }}" >
                        <i class="icon-building"></i> View Projects
                    </a>
                </li>
                <li class="panel">
                    <a href="{{ url('/admin/viewreport') }}" >
                        <i class="icon-calendar"></i> View Project Reports
                    </a>
                </li>

            @endif
            @if(Auth::user()->role_id == 3)
            <li class="panel">
                @if(Auth::user()->role_id == 3)
                <a href="{{ url('hr/clients') }}" >
                    <i class="icon-user"></i> Clients
                </a>
                @endif             
            </li>
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#cm-nav">
                    <i class="icon-user"></i> Clients Manager
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                </a>
                @if(Auth::user()->role_id == 3)
                <ul class="collapse" id="cm-nav">
                    <li><a href="{{ url('/hr/allcm') }}"><i class="icon-angle-right"></i> All Clients Manager </a></li>
                    <li><a href="{{ url('/hr/cm') }}"><i class="icon-angle-right"></i> New Registration </a></li>
                </ul>
                @endif
            </li>
            <li class="panel">
            <a href="{{ url('/hr/viewProjects') }}" >
                <i class="icon-table"></i> Projects
            </a>
        </li>
            @endif
            <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#recentchat">
                    <i class="icon-user"></i> Chats
                    <span class="pull-right">
                        <i class="icon-angle-left"></i>
                    </span>
                </a>
                <ul class="collapse" id="recentchat">
                    @foreach(Auth::User()->RecentChat1 as $data)                         
                        <li><a href="{{ url('chat/'.$data->userB->id) }}"><i class="icon-angle-right"></i>
                            {{$data->userB->first_name}} {{$data->userB->last_name}}
                            
                        </a></li>
                    @endforeach
                    @foreach(Auth::User()->RecentChat2 as $data)                         
                        <li><a href="{{ url('chat/'.$data->userA->id) }}"><i class="icon-angle-right"></i>
                            {{$data->userA->first_name}} {{$data->userA->last_name}}
                           
                        </a></li>
                    @endforeach                  
                </ul>
               {{-- @if(Auth::user()->role_id == 1||Auth::user()->role_id == 2)
                <ul class="collapse" id="recentchat">
                    @foreach(Auth::User()->RecentChat_CM_Client as $data)                         
                        <li><a href="{{ url('chat/'.$data->HR->id) }}"><i class="icon-angle-right"></i>
                            {{$data->HR->first_name}} {{$data->HR->last_name}}
                        </a></li>
                    @endforeach                  
                </ul>
               @endif --}}
            </li>
            <li><a href="{{ route('logout') }}"><i class="icon-signin"></i> Logout</a></li>
        </ul>      
    </div>