<div id="top">
    <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
            <i class="icon-align-justify"></i>
        </a>
        <!-- LOGO SECTION -->
        <header class="navbar-header">
            <a href="/" class="navbar-brand">
                {{--<img src="assets/img/logo.png" alt="" />--}}
                Client Portal
            </a>
        </header>
        <!-- END LOGO SECTION -->
        <ul class="nav navbar-top-links navbar-right">
            <!-- MESSAGES SECTION -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="label label-success">2</span>    <i class="icon-envelope-alt"></i>&nbsp; <i class="icon-chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                            <em>Today</em>
                                        </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                                <br />
                                <span class="label label-primary">Important</span>

                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Read All Messages</strong>
                            <i class="icon-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!--END MESSAGES SECTION -->
            <!--ALERTS SECTION -->
            <li class="chat-panel dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="label label-info">8</span>   <i class="icon-comments"></i>&nbsp; <i class="icon-chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="icon-comment" ></i> New Comment
                                <span class="pull-right text-muted small"> 4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="icon-twitter info"></i> 3 New Follower
                                <span class="pull-right text-muted small"> 9 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="icon-angle-right"></i>
                        </a>
                    </li>
                </ul>

            </li>
            <!-- END ALERTS SECTION -->
            <!--ADMIN SETTINGS SECTIONS -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="#">
                            <i class="icon-user"></i>
                            User Profile
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-gear"></i>
                            Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="icon-signout"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
            <!--END ADMIN SETTINGS -->
        </ul>
    </nav>
</div>