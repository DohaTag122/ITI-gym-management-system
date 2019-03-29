<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            
                <img src="/storage/{{Auth::user()->image }}" class="img-circle" alt="User Image">
                
            </div>
            <div class="pull-left info">
                <p>{{ ucwords(Auth::user()->name) }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

           
        <ul class="sidebar-menu" data-widget="tree">
        @role('admin')
            <li class="{{ (request()->is('users*')) ? 'active' : '' }}">
              
                <a href="{{route('users.index')}}">
                
                    <i class="fas fa-users"></i> <span>Users</span>
                </a>
            </li>
            @endrole
            @role('admin|cityManager')
            <li class="{{ (request()->is('city_managers*')) ? 'active' : '' }}">
                <a href="{{route('ShowCityMangers')}}">
                    <i class="fa fa-th"></i> <span>City Managers</span>
                </a>
            </li>
            @endrole
            <li class="{{ (request()->is('gym_managers*')) ? 'active' : '' }}">
                <a href="{{route('ShowGymMangers')}}">
                    <i class="fa fa-th"></i> <span>Gym Managers</span>
                </a>
            </li>
            @role('admin|cityManager')
            <li class="{{ (request()->is('cities*')) ? 'active' : '' }}">
                <a href="{{route('cities.index')}}">
                    <i class="fas fa-city"></i><span>&nbsp;Cities</span>
                </a>
            </li>
            @endrole
            @role('admin|cityManager')
            <li class="{{ (request()->is('gyms*')) ? 'active' : '' }}">
                <a href="{{route('gyms.index')}}">
                    <i class="fas fa-dumbbell"></i><span>&nbsp;Gyms</span>
                </a>
            </li>
            @endrole
            <li class="{{ (request()->is('packages*','sessions*')) ? 'active menu-open' : '' }} treeview">
                <a href="#">
                    <i class="fas fa-box-open"></i>
                    <span>Bundles</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('sessions*')) ? 'active' : '' }}">
                        <a href="{{route('sessions.index')}}"><i class="fas fa-male"></i>&nbsp;Sessions</a>
                    </li>
                    <li class="{{ (request()->is('packages*')) ? 'active' : '' }}">
                        <a href="{{route('packages.index')}}"><i class="fas fa-people-carry"></i>&nbsp;Packages</a>
                    </li>
                </ul>
            </li>
            @role('admin|cityManager|gymManager')
            <li class="{{ (request()->is('coaches*')) ? 'active' : '' }}">
                <a href="{{route('coaches.index')}}">
                    <i class="fas fa-clipboard-list"></i> <span>Coaches</span>
                </a>
            </li>
            @endrole
            <li class="{{ (request()->is('attendances*')) ? 'active' : '' }}">
                <a href="{{route('attendances.index')}}">
                    <i class="fa fa-th"></i> <span>Attendance</span>
                </a>
            </li>

            <li class="{{ (request()->is('stripe*')) ? 'active' : '' }} treeview">
                <a href="pages/widgets.html">
                    <i class="fas fa-shopping-cart"></i><span>&nbsp;Purchase</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('stripe/session*')) ? 'active' : '' }}">
                        <a href="{{route('stripe.session')}}"><i class="fas fa-male"></i>&nbsp;Purchase Session</a>
                    </li>
                    <li class="{{ (request()->is('stripe/packages*')) ? 'active' : '' }}">
                        <a href="{{route('stripe.package')}}"><i class="fas fa-people-carry"></i>&nbsp;Purchase Package</a>
                    </li>
                </ul>
            </li>

            <li class="{{ (request()->is('purchases*')) ? 'active' : '' }}">
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Revenue</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>