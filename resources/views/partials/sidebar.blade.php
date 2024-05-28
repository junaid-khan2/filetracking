<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="File Tracking Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">File Tracking</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? ''}}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- <li class="nav-item menu-open">
            <a href="{{url('/')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li> --}}
                <li class="nav-item menu-open">
                    <a href="{{ url('/file/create') }}" class="nav-link active">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>
                            Compose

                        </p>
                    </a>

                </li>
                <li class="nav-item menu-open">
                    <a href="{{ url('mydesk') }}" class="nav-link active">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            My Desk

                        </p>
                    </a>
                    {{-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('mydesk') }}" class="nav-link active">
                                <i class="fa fa-solid fa-file-import"></i>
                                <p>My Desk</p>
                                <span class="right badge badge-danger">{{$fileCount['intransit']}}</span>
                            </a>
                        </li>


                    </ul> --}}

                </li>
                {{-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            My Files
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('myfile.intransit') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>In Transit</p>
                                <span class="right badge badge-warning">{{$fileCount['intransit']}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('myfile.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Created</p>
                                <span class="right badge badge-info">{{$fileCount['created']}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('myfile.inprocess') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>In Process</p>
                                <span class="right badge badge-danger">{{$fileCount['inprocess']}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('myfile.disposed') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complated</p>
                                <span class="right badge badge-success">{{$fileCount['disposed']}}</span>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                           Master File
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('masterfile.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Master Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('masterfile.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Master File</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Search & Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ url('search') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advance Search</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('report')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="pages/charts/inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Setting</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>
                @if (Auth::user()->role == "Super Admin")

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                           Section & Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sections.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sections.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Section List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                           Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>LogOut</p>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
