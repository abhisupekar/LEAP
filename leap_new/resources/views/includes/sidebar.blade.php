<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>LEAP Parkar!</span></a>
        </div>
        
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->first_name }} {{Auth::user()->last_name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <span class="label label-success" style="font-size:12px;">{{Auth::user()->department->name}}</span>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Self <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/">Dashboard</a></li>
                            <li><a href="/evaluation">Submit Evaluation</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->role_id >= 3)
                        <li><a><i class="fa fa-tasks"></i> Manager <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/manager/dashboard">Dashboard</a></li>
                            </ul>
                        </li>
                    @endif
                    <li>
                        <a href="/evaluation">
                            <i class="fa fa-keyboard-o"></i>
                            Submit Evaluation
                            <span class="label label-success pull-right">Flag</span>
                        </a>
                    </li>
                    <li>
                        @if (Auth::user()->department->id == 1)
                            <a href="/files/Self-Evaluation-Performance-Matrix-Engineering.xlsx">
                                <i class="fa fa-link"></i>
                                Proficiency Level Reference
                            </a>
                        @elseif (Auth::user()->department->id == 2)
                            <a href="/files/Performance-Review-Matrix-Operations.xlsx">
                                <i class="fa fa-link"></i>
                                Proficiency Level Reference
                            </a>
                        @endif      
                    </li>
                </ul>
            </div>
            @if(Auth::user()->role_id == 5)
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-sitemap"></i> Administration <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="/list/submission-status">Organization Submission Status</a>
                                <li>
                                    <a>User Administration<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li class="sub_menu">
                                            <a href="/list/users">User List</a>
                                        </li>
                                        <li>
                                            <a href="/register">Add User</a>
                                        </li>
                                        <li>
                                            <li><a href="/list/submission-status">Submission Status</a></li>
                                        </li>
                                    </ul>
                                </li>
                            <li>
                                <a>Departments<span class="fa fa-chevron-down"></span></a>
                                     <ul class="nav child_menu">
                                        <li class="sub_menu">
                                            <a href="/departments">Department List</a>
                                        </li>
                                         <li class="sub_menu">
                                            <a href="/department/add-new">Add Department</a>
                                        </li>
                                    </ul>
                            </li>
                            <li>
                                <a>Sub KPIs<span class="fa fa-chevron-down"></span></a>
                                     <ul class="nav child_menu">
                                        <li class="sub_menu">
                                            <a href="/subkpis">Sub KPI List</a>
                                        </li>
                                        <li class="sub_menu">
                                            <a href="/subkpi/add-new">Add Sub KPI</a>
                                        </li>
                                    </ul>
                            </li>
                            <li>
                                <a href="/reports/report-generation">Generate Reports</a>
                            </li>
                            <li>
                                <a href="/export-records">Export Records</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endif
        
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>