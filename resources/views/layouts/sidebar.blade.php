<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href=""><i class="fa fa-home"></i> <span>My First Project</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span></span>
                <h2>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h2>
            </div>
        </div>

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('users') }}">
                            <i class="fa fa-users"> Users</i>
                        </a>
                    </li>
                    @can('delete-user')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('role') }}">
                                <i class="fa fa-cog" aria-hidden="true"> Roles</i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('permission') }}">
                                <i class="fa fa-cog" aria-hidden="true"> Permission</i>
                            </a>
                        </li>
                    @endcan

                </ul>


            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
