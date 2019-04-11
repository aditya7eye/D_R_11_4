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
            <li class="{{ \App\Helpme::isActiveRoute('store_dashboard') }}">
                <a href="{{ url('store_dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
            </li>
            <li class="{{ \App\Helpme::isActiveRoute('products') }}">
                <a href="{{ url('products') }}"><i class="fa fa-trello"></i> <span class="nav-label">Products</span> </a>
            </li>
            {{-- <li class="{{ \App\Helpme::isActiveRoute('store') }}">
                <a href="{{ url('store') }}"><i class="fa fa-home"></i> <span class="nav-label">Store</span> </a>
            </li>
            <li class="{{ \App\Helpme::isActiveRoute('category') }}">
                <a href="{{ url('category') }}"><i class="fa fa-step-forward"></i> <span class="nav-label">Category</span> </a>
            </li>
            <li class="{{ \App\Helpme::isActiveRoute('sub_category') }}">
                <a href="{{ url('sub_category') }}"><i class="fa fa-play"></i> <span class="nav-label">Sub Category</span> </a>
            </li> --}}
           
        </ul>

    </div>
</nav>
