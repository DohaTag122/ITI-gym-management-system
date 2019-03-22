<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
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
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Gym Managers</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>City Managers</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Users</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Cities</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Gyms</span>
                </a>
            </li>

            <li>
                <a href="{{route('package.index')}}">
                    <i class="fa fa-th"></i> <span>Training Packages</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Coaches</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Attendance</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Buy</span>
                </a>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Revenue</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>