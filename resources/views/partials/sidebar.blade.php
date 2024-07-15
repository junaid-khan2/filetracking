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



                <img src="{{ Auth::user()->profile ? asset('uploads/profile/' . Auth::user()->profile) : asset('images/KPK_Police_Logo.svg') }}" class="img-circle elevation-2" alt="User Image">




            </div>



            <div class="info">



                <a href="{{route('dashboardd')}}" class="d-block">{{ Auth::user()->name ?? '' }}</a>



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

               @if (Auth::user()->role == "Section" )

               <li class="nav-item  menu-open">



                <a href="#" class="nav-link active">



                    <i class="nav-icon fas fa-file"></i>



                    <p>



                        Compose



                        <i class="right fas fa-angle-left"></i>



                    </p>



                </a>



                <ul class="nav nav-treeview">



                    <li class="nav-item ">



                        <a href="{{ url('/file/create', ['type' => 'Letter']) }}" class="nav-link active">



                            <i class="nav-icon fas fa-plus"></i>



                            <p>Create Letter </p>



                        </a>

                    </li>



                    @if (Auth::user()->sections->code !== 'GB')

                        <li class="nav-item ">



                            <a href="{{ url('/file/create', ['type' => 'File']) }}" class="nav-link active">



                                <i class="nav-icon fas fa-plus"></i>



                                <p>Create File </p>



                            </a>







                        </li>



                        <li class="nav-item ">



                            <a href="{{ url('/file/create', ['type' => 'NoteSheet']) }}" class="nav-link active">



                                <i class="nav-icon fas fa-plus"></i>



                                <p>Create Note Sheet </p>



                            </a>







                        </li>

                        <li class="nav-item ">



                            <a href="{{ url('/file/create', ['type' => 'Reminder']) }}" class="nav-link active">



                                <i class="nav-icon fas fa-plus"></i>



                                <p>Create Reminder </p>



                            </a>







                        </li>

                    @endif















                </ul>



            </li>

               @endif







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



                                <span class="right badge badge-warning">{{ $fileCount['intransit'] }}</span>



                            </a>



                        </li>



                        <li class="nav-item ">



                            <a href="{{ route('myfile.create') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>Created</p>



                                <span class="right badge badge-info">{{ $fileCount['created'] }}</span>



                            </a>



                        </li>



                        <li class="nav-item">



                            <a href="{{ route('myfile.inprocess') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>In Process</p>



                                <span class="right badge badge-danger">{{ $fileCount['inprocess'] }}</span>



                            </a>



                        </li>



                        <li class="nav-item">



                            <a href="{{ route('myfile.disposed') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>Completed</p>



                                <span class="right badge badge-success">{{ $fileCount['disposed'] }}</span>



                            </a>



                        </li>







                    </ul>



                </li>



                <li class="nav-item">



                    <a href="#" class="nav-link">



                        <i class="nav-icon fas fa-file"></i>



                        <p>



                            My OutBound



                            <i class="right fas fa-angle-left"></i>



                        </p>



                    </a>



                    <ul class="nav nav-treeview">



                        <li class="nav-item">



                            <a href="{{ route('myfile.outbound.file') }}" class="nav-link ">



                                <i class="far fa-circle nav-icon"></i>



                                <p>OutBound File</p>



                                <span class="right badge badge-warning">{{ $fileCount['outBoundFile'] }}</span>



                            </a>



                        </li>



                        <li class="nav-item">



                            <a href="{{ route('myfile.outbound.letter') }}" class="nav-link ">



                                <i class="far fa-circle nav-icon"></i>



                                <p>OutBound Letter</p>



                                <span class="right badge badge-warning">{{ $fileCount['outBoundLetter'] }}</span>



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







                @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')

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



                                <a href="{{ route('report') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Report</p>



                                </a>



                            </li>







                            <li class="nav-item">



                                <a href="{{ route('open.search') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Open Search</p>



                                </a>



                            </li>

                            <li class="nav-item">



                                <a href="{{ route('report.advance') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Advance Report</p>



                                </a>



                            </li>







                            <li class="nav-item">



                                <a href="{{ route('report.performance.user') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>User Performance</p>



                                </a>



                            </li>



                            <li class="nav-item">



                                <a href="{{ route('report.performance.section') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Section Performance</p>



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

                @elseif(Auth::user()->sections->code == 'GB')

                    <li class="nav-item">



                        <a href="#" class="nav-link">



                            <i class="nav-icon fas fa-file"></i>



                            <p>



                                Search & Report



                                <i class="right fas fa-angle-left"></i>



                            </p>



                        </a>



                        <ul class="nav nav-treeview">











                            <li class="nav-item">



                                <a href="{{ route('open.search') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Open Search</p>



                                </a>



                            </li>

                            <li class="nav-item">



                                <a href="{{ route('report.advance') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Advance Report</p>



                                </a>



                            </li>



                        </ul>



                    </li>

                @endif



                @if (Auth::user()->role == 'Super Admin')

                    <li class="nav-item">



                        <a href="#" class="nav-link">



                            <i class="nav-icon fas fa-building"></i>



                            <p>



                                Section & Users



                                <i class="right fas fa-angle-left"></i>



                            </p>



                        </a>



                        <ul class="nav nav-treeview">



                            {{-- <li class="nav-item">



                            <a href="{{ route('sections.create') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>Create Section</p>



                            </a>



                        </li> --}}



                            <li class="nav-item">



                                <a href="{{ route('sections.index') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Section List</p>



                                </a>



                            </li>



                            {{-- <li class="nav-item">



                            <a href="{{ route('users.create') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>Create User</p>



                            </a>



                        </li> --}}



                            <li class="nav-item">



                                <a href="{{ route('users.index') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>User List</p>



                                </a>



                            </li>



                            <li class="nav-item">



                                <a href="{{ route('assign.sections.list') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Admin Sections</p>



                                </a>



                            </li>



                            <li class="nav-item">



                                <a href="{{ route('assign.sections') }}" class="nav-link">



                                    <i class="far fa-circle nav-icon"></i>



                                    <p>Assign Sections</p>



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



                            <a href="{{ route('profile.edit') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>Profile</p>



                            </a>



                        </li>



                        <li class="nav-item">



                            <a href="{{ route('logout') }}" class="nav-link">



                                <i class="far fa-circle nav-icon"></i>



                                <p>Log Out</p>



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

