<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="/">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search" />
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li> @if(isset(session('adminmaster')->id))
                <a href="{{ url('logout') }}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
                @elseif(isset(session('store')->id)) 
                <a href="{{ url('s_logout') }}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
                @endif
                
            </li>
        </ul>
    </nav>
</div>
