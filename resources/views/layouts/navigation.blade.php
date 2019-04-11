<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">Example user</strong>
                            </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ \App\Helpme::isActiveRoute('master_dashboard') }}">
                <a href="{{ url('master_dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
            </li>
            <li class="{{ \App\Helpme::isActiveRoute('store') }}">
                <a href="{{ url('store') }}"><i class="fa fa-home"></i> <span class="nav-label">Store</span> </a>
            </li>
           
        </ul>

    </div>
</nav>
