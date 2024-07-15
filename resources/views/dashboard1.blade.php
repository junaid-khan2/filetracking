@extends('layouts.app', ['page_title' => 'Dashboard'])

@push('style')
    <!-- DataTables -->

    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/fullcalendar.min.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/animate.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/style.css') }}">
    <style>

    </style>
@endpush

@section('content')
    <section>
        <!-- Dashboard summery Start Here -->
        <div class="row gutters-20">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-green ">
                                <i class="flaticon-classmates text-green"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Files</div>
                                <div class="item-number"><span class="counter"
                                        data-num="{{ $file }}">{{ $file }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-blue">
                                <i class="flaticon-multiple-users-silhouette text-blue"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Letters</div>
                                <div class="item-number"><span class="counter"
                                        data-num="{{ $Letter }}">{{ $Letter }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-yellow">
                                <i class="flaticon-couple text-orange"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Note sheets</div>
                                <div class="item-number"><span class="counter"
                                        data-num="{{ $NoteSheet }}">{{ $NoteSheet }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="item-icon bg-light-red">
                                <i class="flaticon-money text-red"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="item-content">
                                <div class="item-title">Replies</div>
                                <div class="item-number"><span class="counter"
                                        data-num="{{ $Reply }}">{{ $Reply }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard summery End Here -->
        <!-- Dashboard Content Start Here -->
        <div class="row gutters-20">
            <div class="col-12 col-xl-5 col-5-xxxl">
                <div class="card dashboard-card-one pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Weekly Report</h3>
                            </div>

                        </div>
                        <div class="earning-report">
                            <div class="item-content">
                                <div class="single-item pseudo-bg-Aquamarine">
                                    <h4>Files</h4>
                                    {{ $currentWeekFiles }}
                                </div>
                                <div class="single-item pseudo-bg-blue">
                                    <h4>Letters</h4>
                                    {{ $currentWeekLetter }}
                                </div>
                                <div class="single-item pseudo-bg-yellow">
                                    <h4>Note Sheets</h4>
                                    {{ $currentWeekNoteSheet }}
                                </div>
                                <div class="single-item pseudo-bg-red">
                                    <h4>Replies</h4>

                                    {{ $currentWeekReply }}


                                </div>
                            </div>

                        </div>
                        <div class="earning-chart-wrap">
                            <canvas id="earning-line-chart1" width="660" height="320"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 col-4-xxxl">
                <div class="card dashboard-card-two pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Deadline based report</h3>
                            </div>

                        </div>

                        <div class="expense-chart-wrap">
                            <canvas id="expense-bar-chart1" width="100" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-3 col-3-xxxl">
                <div class="card dashboard-card-three pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Internal / External</h3>
                            </div>

                        </div>
                        <div class="doughnut-chart-wrap">
                            <canvas id="student-doughnut-chart1" width="100" height="300"></canvas>
                        </div>
                        <div class="student-report">
                            <div class="student-count pseudo-bg-blue">
                                <h4 class="item-title">Internal</h4>
                                <div class="item-number">{{ $InternalData ?? 0 }}</div>
                            </div>
                            <div class="student-count pseudo-bg-yellow">
                                <h4 class="item-title">External</h4>
                                <div class="item-number">
                                    {{ $ExternalData ?? 30 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-12 col-xl-6 col-4-xxxl">
                <div class="card dashboard-card-four pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Flag Wise Report</h3>
                            </div>

                        </div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#file" role="tab" data-toggle="tab">File(s)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#letter" role="tab" data-toggle="tab">Letter(s)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#notesheet" role="tab" data-toggle="tab">Note Sheet(s)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#reply" role="tab" data-toggle="tab">Reply(ies)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="file">
                                <div class="traffic-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($typeWise1['File'] as $index => $item)
                                                <tr>
                                                    <td>{{ $index }}</td>
                                                    <td>{{ $item }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="letter">
                                <div class="traffic-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($typeWise1['Letter'] as $index => $item)
                                                <tr>
                                                    <td>{{ $index }}</td>
                                                    <td>{{ $item }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="notesheet">
                                <div class="traffic-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($typeWise1['NoteSheet'] as $index => $item)
                                                <tr>
                                                    <td>{{ $index }}</td>
                                                    <td>{{ $item }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="reply">
                                <div class="traffic-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="t-title pseudo-bg-Aquamarine">Type</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($typeWise1['Reply'] as $index => $item)
                                                <tr>

                                                    <td class="t-title pseudo-bg-Aquamarine">{{ $index }}</td>
                                                    <td>{{ $item }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}
            <div class="col-lg-6 col-xl-6 col-4-xxxl">
                <div class="card dashboard-card-five pd-b-20">
                    <div class="card-body pd-b-14">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Status Wises All</h3>
                            </div>

                        </div>
                        <div class="my-2">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#file" role="tab"
                                        data-toggle="tab">File(s)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#letter" role="tab" data-toggle="tab">Letter(s)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#notesheet" role="tab" data-toggle="tab">Note
                                        Sheet(s)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#reply" role="tab" data-toggle="tab">Reply(ies)</a>
                                </li>
                            </ul>
                        </div>

                        <h6 class="traffic-title">Unique Visitors</h6>
                        <div class="traffic-number">2,590</div>

                        <div class="traffic-bar">
                            <div class="direct" data-toggle="tooltip" data-placement="top" title="File">
                            </div>
                            <div class="search" data-toggle="tooltip" data-placement="top" title="Letter">
                            </div>
                            <div class="referrals" data-toggle="tooltip" data-placement="top" title="Note Sheet">
                            </div>
                            <div class="social" data-toggle="tooltip" data-placement="top" title="Replay">
                            </div>
                        </div>
                        <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade" id="file">
                            <div class="traffic-table table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="t-title pseudo-bg-Aquamarine">Files</td>
                                            <td>12,890</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-blue">Letters</td>
                                            <td>7,245</td>
                                            <td>27%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-yellow">Note Sheets</td>
                                            <td>4,256</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-red">Replies</td>
                                            <td>500</td>
                                            <td>7%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="letter">
                            <div class="traffic-table table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="t-title pseudo-bg-Aquamarine">Files</td>
                                            <td>12,890</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-blue">Letters</td>
                                            <td>7,245</td>
                                            <td>27%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-yellow">Note Sheets</td>
                                            <td>4,256</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-red">Replies</td>
                                            <td>500</td>
                                            <td>7%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="notesheet">
                            <div class="traffic-table table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="t-title pseudo-bg-Aquamarine">Files</td>
                                            <td>12,890</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-blue">Letters</td>
                                            <td>7,245</td>
                                            <td>27%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-yellow">Note Sheets</td>
                                            <td>4,256</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-red">Replies</td>
                                            <td>500</td>
                                            <td>7%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="reply">
                            <div class="traffic-table table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="t-title pseudo-bg-Aquamarine">Files</td>
                                            <td>12,890</td>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-blue">Letters</td>
                                            <td>7,245</td>
                                            <td>27%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-yellow">Note Sheets</td>
                                            <td>4,256</td>
                                            <td>8%</td>
                                        </tr>
                                        <tr>
                                            <td class="t-title pseudo-bg-red">Replies</td>
                                            <td>500</td>
                                            <td>7%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="card dashboard-card-six">
                    <div class="card-body">
                        <div class="heading-layout1 mg-b-17">
                            <div class="item-title">
                                <h3>Notifications</h3>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                    aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <div class="notice-box-wrap ">
                            <div class="notice-list">
                                <div class="post-date bg-red">Most Immediate</div>
                                <h6 class="notice-title"><a href="#">
                                        File: GB/2024/1/E3
                                        <br>
                                        Subject: Testing Subject
                                    </a></h6>
                                <div class="entry-meta"> Genral Branch | <span>12/07/2024</span></div>
                            </div>
                            <div class="notice-list">
                                <div class="post-date bg-yellow">16 June, 2019</div>
                                <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                                <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                            </div>
                            <div class="notice-list">
                                <div class="post-date bg-pink">16 June, 2019</div>
                                <h6 class="notice-title"><a href="#">Great School manag Nulla rhoncus eleifensed
                                        mim
                                        us mi faucibus id. Mauris vestibulum non purus lobortismenearea</a></h6>
                                <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                            </div>
                            <div class="notice-list">
                                <div class="post-date bg-blue">16 June, 2019</div>
                                <h6 class="notice-title"><a href="#">Great School manag mene esom text of the
                                        printing.</a></h6>
                                <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                            </div>
                            <div class="notice-list">
                                <div class="post-date bg-yellow">16 June, 2019</div>
                                <h6 class="notice-title"><a href="#">Great School manag printing.</a></h6>
                                <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                            </div>
                            <div class="notice-list">
                                <div class="post-date bg-blue">16 June, 2019</div>
                                <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                                <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                            </div>
                            <div class="notice-list">
                                <div class="post-date bg-pink">16 June, 2019</div>
                                <h6 class="notice-title"><a href="#">Great School manag meneesom.</a></h6>
                                <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 col-4-xxxl">
                <div class="card dashboard-card-six pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1 mg-b-17">
                            <div class="item-title">
                                <h3>Flag based notifications</h3>
                            </div>

                        </div>
                        <div class="notice-box-wrap">
                            @foreach ($typeWise as $fileType => $counts)
                                <div class="notice-list">
                                    <div
                                        class="post-date
                                    @if ($fileType == 'Normal') bg-yellow
                                    @elseif($fileType == 'Urgent')
                                    bg-blue
                                    @elseif($fileType == 'Immediate')
                                    bg-pink
                                    @elseif($fileType == 'Most Immediate')
                                    bg-red @endif
                                    ">
                                        {{ $fileType }} <!-- Display the file type -->
                                    </div>
                                    <h6 class="notice-title">

                                        <a href="#">
                                            @foreach ($counts as $flag => $count)
                                                @if ($count > 0)
                                                    @if ($flag == 'File')
                                                        {{ $count }} File(s)
                                                    @elseif($flag == 'Letter')
                                                        {{ $count }} Letter(s)
                                                    @elseif($flag == 'Reply')
                                                        {{ $count }} Reply(ies)
                                                    @elseif($flag == 'NoteSheet')
                                                        {{ $count }} Note Sheet(s)
                                                    @endif
                                                @endif
                                            @endforeach
                                        </a>
                                        <!-- Display count and flag status -->

                                    </h6>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard Content End Here -->
        <!-- Social Media Start Here -->
        <div class="row gutters-20">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card dashboard-card-seven">
                    <div class="social-media bg-fb hover-fb">
                        <div class="media media-none--lg">
                            <div class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="media-body space-sm">
                                <h6 class="item-title">Like us on facebook</h6>
                            </div>
                        </div>
                        <div class="social-like">30,000</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card dashboard-card-seven">
                    <div class="social-media bg-twitter hover-twitter">
                        <div class="media media-none--lg">
                            <div class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="media-body space-sm">
                                <h6 class="item-title">Follow us on twitter</h6>
                            </div>
                        </div>
                        <div class="social-like">1,11,000</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card dashboard-card-seven">
                    <div class="social-media bg-gplus hover-gplus">
                        <div class="media media-none--lg">
                            <div class="social-icon">
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                            <div class="media-body space-sm">
                                <h6 class="item-title">Follow us on googleplus</h6>
                            </div>
                        </div>
                        <div class="social-like">19,000</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card dashboard-card-seven">
                    <div class="social-media bg-linkedin hover-linked">
                        <div class="media media-none--lg">
                            <div class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                            <div class="media-body space-sm">
                                <h6 class="item-title">Follow us on linked</h6>
                            </div>
                        </div>
                        <div class="social-like">45,000</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Social Media End Here -->
    </section>
@endsection

@push('script')
    <!-- jquery-->
    <script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('dashboard/js/plugins.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    <!-- Counterup Js -->
    <script src="{{ asset('dashboard/js/jquery.counterup.min.js') }}"></script>
    <!-- Moment Js -->
    <script src="{{ asset('dashboard/js/moment.min.js') }}"></script>
    <!-- Waypoints Js -->
    <script src="{{ asset('dashboard/js/jquery.waypoints.min.js') }}"></script>
    <!-- Scroll Up Js -->
    <script src="{{ asset('dashboard/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Full Calender Js -->
    <script src="{{ asset('dashboard/js/fullcalendar.min.js') }}"></script>
    <!-- Chart Js -->
    <script src="{{ asset('dashboard/js/Chart.min.js') }}"></script>
    <!-- Chart Js -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {

            /*-------------------------------------
                Line Chart
            -------------------------------------*/
            if ($("#earning-line-chart1").length) {

                var lineChartData = {
                    labels: @json($currentWeekData['labels']),
                    datasets: [{
                            data: @json($currentWeekData['files']), // Files
                            backgroundColor: '#1de9b6',
                            borderColor: '#1de9b6',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#1de9b6',
                            pointBorderColor: '#ffffff',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Files"
                        },
                        {
                            data: @json($currentWeekData['letters']), // Letters
                            backgroundColor: '#417dfc',
                            borderColor: '#417dfc',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#417dfc',
                            pointBorderColor: '#417dfc',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Letters"
                        },
                        {
                            data: @json($currentWeekData['noteSheets']), // Note Sheets
                            backgroundColor: '#ffaa01',
                            borderColor: '#ffaa01',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#ffaa01',
                            pointBorderColor: '#ffaa01',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Note Sheets"
                        },
                        {
                            data: @json($currentWeekData['replies']), // Replies
                            backgroundColor: '#ff0000',
                            borderColor: '#ff0000',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#ff0000',
                            pointBorderColor: '#ff0000',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Replies"
                        }
                    ]
                };

                var lineChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 2000
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                fontColor: "#222222",
                                fontSize: 16,
                                padding: 20
                            },
                            gridLines: {
                                display: true,
                                drawBorder: true,
                                color: '#cccccc',
                                borderDash: [5, 5]
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                autoSkip: true,
                                maxRotation: 0,
                                fontColor: "#646464",
                                fontSize: 16,
                                // stepSize: 1,
                                padding: 20,
                                callback: function(value) {
                                    var ranges = [{
                                            divider: 1e6,
                                            suffix: 'M'
                                        },
                                        {
                                            divider: 1e3,
                                            suffix: 'k'
                                        }
                                    ];

                                    function formatNumber(n) {
                                        for (var i = 0; i < ranges.length; i++) {
                                            if (n >= ranges[i].divider) {
                                                return (n / ranges[i].divider).toString() + ranges[
                                                    i].suffix;
                                            }
                                        }
                                        return n;
                                    }
                                    return formatNumber(value);
                                }
                            },
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                color: '#cccccc',
                                borderDash: [5, 5],
                                zeroLineBorderDash: [5, 5],
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontColor: '#333',
                            fontSize: 14,
                            boxWidth: 20,
                            usePointStyle: true
                        }
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        enabled: true
                    },
                    elements: {
                        line: {
                            tension: .35
                        },
                        point: {
                            pointStyle: 'circle'
                        }
                    }
                };

                var earningCanvas = $("#earning-line-chart1").get(0).getContext("2d");
                var earningChart = new Chart(earningCanvas, {
                    type: 'line',
                    data: lineChartData,
                    options: lineChartOptions
                });
            }


            /*-------------------------------------
                  Doughnut Chart
              -------------------------------------*/
            if ($("#student-doughnut-chart1").length) {

                var doughnutChartData = {
                    labels: ["Internal", "External"],
                    datasets: [{
                        backgroundColor: ["#304ffe", "#ffa601"],
                        data: [@json($InternalData), @json($ExternalData)],
                        label: "Total Files"
                    }, ]
                };
                var doughnutChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutoutPercentage: 65,
                    rotation: -9.4,
                    animation: {
                        duration: 2000
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                };
                var studentCanvas = $("#student-doughnut-chart1").get(0).getContext("2d");
                var studentChart = new Chart(studentCanvas, {
                    type: 'doughnut',
                    data: doughnutChartData,
                    options: doughnutChartOptions
                });
            }


            /*-------------------------------------
                  Bar Chart
              -------------------------------------*/
            if ($("#expense-bar-chart1").length) {

                var lineChartData = {
                    labels: @json($currentWeekDataDeadline['labels']),
                    datasets: [{
                            data: @json($currentWeekDataDeadline['files']), // Files
                            backgroundColor: '#1de9b6',
                            borderColor: '#1de9b6',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#1de9b6',
                            pointBorderColor: '#1de9b6',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Files"
                        },
                        {
                            data: @json($currentWeekDataDeadline['letters']), // Letters
                            backgroundColor: '#417dfc',
                            borderColor: '#417dfc',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#417dfc',
                            pointBorderColor: '#417dfc',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Letters"
                        },
                        {
                            data: @json($currentWeekDataDeadline['noteSheets']), // Note Sheets
                            backgroundColor: '#ffaa01',
                            borderColor: '#ffaa01',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#ffaa01',
                            pointBorderColor: '#ffaa01',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Note Sheets"
                        },
                        {
                            data: @json($currentWeekDataDeadline['replies']), // Replies
                            backgroundColor: '#ff0000',
                            borderColor: '#ff0000',
                            borderWidth: 1,
                            pointRadius: 0,
                            pointBackgroundColor: '#ff0000',
                            pointBorderColor: '#ff0000',
                            pointHoverRadius: 6,
                            pointHoverBorderWidth: 3,
                            fill: 'origin',
                            label: "Replies"
                        }
                    ]
                };

                var lineChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 2000
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                fontColor: "#222222",
                                fontSize: 16,
                                padding: 20
                            },
                            gridLines: {
                                display: true,
                                drawBorder: true,
                                color: '#cccccc',
                                borderDash: [5, 5]
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                autoSkip: true,
                                maxRotation: 0,
                                fontColor: "#646464",
                                fontSize: 16,
                                // stepSize: 1,
                                padding: 20,
                                callback: function(value) {
                                    var ranges = [{
                                            divider: 1e6,
                                            suffix: 'M'
                                        },
                                        {
                                            divider: 1e3,
                                            suffix: 'k'
                                        }
                                    ];

                                    function formatNumber(n) {
                                        for (var i = 0; i < ranges.length; i++) {
                                            if (n >= ranges[i].divider) {
                                                return (n / ranges[i].divider).toString() + ranges[
                                                    i].suffix;
                                            }
                                        }
                                        return n;
                                    }
                                    return formatNumber(value);
                                }
                            },
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                color: '#cccccc',
                                borderDash: [5, 5],
                                zeroLineBorderDash: [5, 5],
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontColor: '#333',
                            fontSize: 14,
                            boxWidth: 20,
                            usePointStyle: true
                        }
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        enabled: true
                    },
                    elements: {
                        line: {
                            tension: .35
                        },
                        point: {
                            pointStyle: 'circle'
                        }
                    }
                };

                var earningCanvas = $("#expense-bar-chart1").get(0).getContext("2d");
                var earningChart = new Chart(earningCanvas, {
                    type: 'bar',
                    data: lineChartData,
                    options: lineChartOptions
                });
            }


            /*-------------------------------------
                 Clinder
              ------------------------------------*/
            if ($.fn.fullCalendar !== undefined) {
                $('#fc-calender').fullCalendar({
                    header: {
                        center: 'basicDay,basicWeek,month',
                        left: 'title',
                        right: 'prev,next',
                    },
                    fixedWeekCount: false,
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    aspectRatio: 1.8,
                    events: [{
                            title: 'All Day Event',
                            start: '2024-07-01'
                        },

                        {
                            title: 'Meeting',
                            start: '2024-07-12T14:30:00'
                        },

                        {
                            title: 'Other Event',
                            start: '2024-07-12T14:30:00'
                        },
                        {
                            title: 'Happy Hour',
                            start: '2024-07-15T17:30:00'
                        },
                        {
                            title: 'Birthday Party',
                            start: '2024-07-20T07:00:00'
                        }
                    ]
                });
            }
        });
        $(document).ready(function() {
            // Set up animation properties (adjust as needed)
            var animationDuration = 500; // Time in milliseconds for animation
            var animationEasing = 'swing'; // Animation easing function (e.g., 'linear', 'easeInOutCubic')

            // Bind scroll event to the notice-box-wrap element
            $('.notice-box-wrap').scroll(function() {
                var scrollTop = $(this).scrollTop();

                // Animate notice-list items as they come into view
                $('.notice-list', this).each(function() {
                    var $noticeList = $(this);
                    var noticeListTop = $noticeList.offset().top;
                    var noticeListHeight = $noticeList.outerHeight();
                    var viewportTop = scrollTop;
                    var viewportBottom = viewportTop + $(window).height();

                    // Check if notice-list is within the viewport
                    if (noticeListTop + noticeListHeight >= viewportTop && noticeListTop <=
                        viewportBottom) {
                        // Apply animation only if not already animated
                        if (!$noticeList.hasClass('animated')) {
                            $noticeList.addClass(
                                'animated'); // Add a class to track animation state

                            $noticeList.animate({
                                opacity: 1, // Adjust animation properties as needed
                                transform: 'translateY(0px)' // Or other desired transformation
                            }, animationDuration, animationEasing, function() {
                                // Optional callback after animation completes
                            });
                        }
                    }
                });
            });

            // Initial trigger for animations on page load (optional)
            $('.notice-list', '.notice-box-wrap').trigger('scroll'); // Simulate scroll event
        });
    </script>
@endpush
