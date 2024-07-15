<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>File Tracking | Dashboard</title>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/svg" href="{{asset('images/KPK_Police_Logo.svg')}}">



    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet"

        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->

    <link rel="stylesheet"

        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->

    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

    <!-- Theme style -->

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->

    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->

    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Select 2 -->

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <!-- summernote -->

    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">



    <!-- Toastr -->

    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    @stack('style')


    <style>
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px);
        }
    </style>

</head>



<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">



        <!-- Preloader -->

        <div class="preloader flex-column justify-content-center align-items-center">

            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"

                height="60" width="60">

        </div>



        @include('partials.header')



        <!-- Main Sidebar Container -->

        @include('partials.sidebar')





        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->

            <div class="content-header">

                <div class="container-fluid">
                    @if(isset($show_title))

                    @else
                    <div class="row mb-2">

                        <div class="col-sm-6">

                            <h1 class="m-0">{{ $page_title ?? 'Dashboard' }}</h1>

                        </div><!-- /.col -->

                        <div class="col-sm-4">

                            @if (isset($last_file) && isset($letter_id))

                                <h1>Letter NO : <a href="{{ route('track.show', $letter_id) }}">{{ $last_file }}</a>

                                </h1>

                            @endif





                        </div>

                        <div class="col-sm-2">

                            <ol class="breadcrumb float-sm-right">

                                <li class="breadcrumb-item"><a href="{{route('dashboardd')}}">Home</a></li>

                                <li class="breadcrumb-item active">{{ $page_title ?? '' }}</li>

                            </ol>

                        </div><!-- /.col -->

                    </div><!-- /.row -->
                    @endif
                </div><!-- /.container-fluid -->

            </div>

            <!-- /.content-header -->





            <!-- Main content -->

            @yield('content')

            <!-- /.content -->

        </div>

        <!-- /.content-wrapper -->

        @include('partials.footer')



        <!-- Control Sidebar -->

        <aside class="control-sidebar control-sidebar-dark">

            <!-- Control sidebar content goes here -->

        </aside>

        <!-- /.control-sidebar -->


        <!-- last File Modal -->

        <!-- Modal HTML -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="lastFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Last File Tracking Number</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               Tracking Number : @if(isset($fileNumber)) {{$fileNumber}} @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>





</div>

    </div>

    <!-- ./wrapper -->



    <!-- jQuery -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->

    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script>

        $.widget.bridge('uibutton', $.ui.button)

    </script>

    <!-- Bootstrap 4 -->

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ChartJS -->

    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Sparkline -->

    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>



    <!-- jQuery Knob Chart -->

    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- daterangepicker -->

    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->

    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>



    <!-- overlayScrollbars -->

    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->

    <script src="{{ asset('dist/js/adminlte.js') }}"></script>



    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->

    {{-- <script src="{{asset('dist/js/demo.js')}}"></script> --}}



    <!-- Toastr -->

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js" integrity="sha512-zmlLhIesl+uwwzjoUz/izUsSjAMVb/7fH2ffCbJvYLepAvdvAq1T6ev9edZR8jwRKfM0OTaUyFVO1D7wAwXCEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        $(document).ready(function() {


            // Initialize Select2

            $('.select2').select2();

        });

    </script>

    @if(isset($fileNumber))
    <script>
            $(document).ready(function() {


// Initialize Select2
$('#lastFileModal').modal('show');
            });
    </script>
    @endif

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    {{-- <script src="{{asset('dist/js/pages/dashboard.js')}}"></script> --}}

    <!-- REQUIRED SCRIPTS -->

    @if ($errors->any())

        @foreach ($errors->all() as $error)

            <script>

                $(document).Toasts('create', {

                    class: 'bg-danger',

                    title: 'Error!',

                    body: '{{ $error }}',

                    autohide: true,

                    delay: 10000 // 10 seconds

                });

            </script>

        @endforeach

    @endif


    @if (Session::has('error'))

        <script>

            $(document).Toasts('create', {

                class: 'bg-danger',

                title: 'Error!',

                body: '{{ Session::get('error') }}',

                autohide: true,

                delay: 10000 // 10 seconds

            });

        </script>

    @endif



    @if (Session::has('success'))

        <script>

            $(document).Toasts('create', {

                class: 'bg-success',

                title: 'Success!',

                body: '{{ Session::get('success') }}',

                autohide: true,

                delay: 10000 // 10 seconds

            });

        </script>

    @endif





    @stack('script')

</body>



</html>

