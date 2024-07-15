@extends('layouts.app',['page_title'=>'Dashboard'])

@push('style')

 <!-- DataTables -->

 <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

 <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

@endpush

@section('content')

<!-- Main content -->

<section >

    <div class="container-fluid">

      <!-- Info boxes -->

      <div class="row">
      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="fa fa-file"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>

      <div class="row">

        <div class="col-12 col-sm-6 col-md-3">

          <a class="text-dark" href="{{route('dashboard.files')}}">

            <div class="info-box">

              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">File</span>

                <span class="info-box-number">

                  {{$file ?? 0}}

                </span>

              </div>

              <!-- /.info-box-content -->

            </div>

          </a>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->

        <div class="col-12 col-sm-6 col-md-3">

          <a class="text-dark" href="{{route('dashboard.letters')}}">

            <div class="info-box mb-3">

              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">Letter</span>

                <span class="info-box-number"> {{$Letter ?? 0}}</span>

              </div>

              <!-- /.info-box-content -->

            </div>

          </a>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->



        <!-- fix for small devices only -->

        <div class="clearfix hidden-md-up"></div>



        <div class="col-12 col-sm-6 col-md-3">

          <a class="text-dark" href="{{route('dashboard.notesheet')}}">

            <div class="info-box mb-3">

              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">NoteSheet</span>

                <span class="info-box-number">{{$NoteSheet ?? 0}}</span>

              </div>

              <!-- /.info-box-content -->

            </div>

          </a>

          <!-- /.info-box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->







      <!-- Main row -->

      <div class="row">

        <!-- Left col -->

        <div class="col-md-8">

          <!-- DONUT CHART -->

          <div class="card card-danger">

            <div class="card-header">

              <h3 class="card-title">File Progress Chart</h3>



              <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse">

                  <i class="fas fa-minus"></i>

                </button>

                <button type="button" class="btn btn-tool" data-card-widget="remove">

                  <i class="fas fa-times"></i>

                </button>

              </div>

            </div>

            <div class="card-body">

              <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

            </div>

            <!-- /.card-body -->

          </div>

          <!-- /.card -->







        </div>

        <!-- /.col -->



        <div class="col-md-4">



          <!-- /.info-box -->

          <div class="info-box mb-3 bg-info">

            <span class="info-box-icon"><i class="far fa-comment"></i></span>



            <div class="info-box-content">

              <span class="info-box-number">

                <div class="d-flex  justify-content-around">

                  <div>

                    <a href="{{route('report.sectionwises',['type'=>'File','status'=>'Created'])}}" class="text-light">

                        <div>

                            File Created

                        </div>

                        <div class="text-light">

                            {{$createdfile}}

                        </div>

                    </a>

                  </div>

                  <div>

                    <a href="{{route('report.sectionwises',['type'=>'Letter','status'=>'Created'])}}" class="text-light">

                    <div>

                      Letter Created

                    </div>

                    <div class="text-light">

                      {{$createdletter}}

                    </div>

                    </a>

                  </div>

                </div>

              </span>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->



          <!-- Info Boxes Style 2 -->

          <div class="info-box mb-3 bg-warning">

            <span class="info-box-icon"><i class="fas fa-tag"></i></span>



            <div class="info-box-content ">



              <span class="info-box-number">

                <div class="d-flex  justify-content-around">

                  <div>

                    <a href="{{route('report.sectionwises',['type'=>'File','status'=>'In Transit'])}}" class="text-light">

                    <div>

                      File Transit

                    </div>

                    <div class="text-light">

                      {{$intransitfile}}

                    </div>

                    </a>

                  </div>

                  <div>

                    <a href="{{route('report.sectionwises',['type'=>'Letter','status'=>'In Transit'])}}" class="text-light">

                    <div>

                      Letter Transit

                    </div>

                    <div class="text-light">

                      {{$intransitletter}}

                    </div>

                    </a>

                  </div>

                </div>

                {{-- <table class="table">

                  <tr>

                    <td>File</td>

                    <td>Letter</td>

                  </tr>

                  <tr>

                    <td>{{$intransitfile}}</td>

                    <td>{{$intransitletter}}</td>

                  </tr>

                </table> --}}

              </span>

            </div>

            <!-- /.info-box-content -->

          </div>

          <!-- /.info-box -->

          <div class="info-box mb-3 bg-danger">

            <span class="info-box-icon"><i class="far fa-heart"></i></span>



            <div class="info-box-content">

              <span class="info-box-number">

                <div class="d-flex  justify-content-around">

                  <div>

                    <a href="{{route('report.sectionwises',['type'=>'File','status'=>'In Process'])}}" class="text-light">

                    <div>

                      File InProcess

                    </div>

                    <div class="text-light">

                      {{$inprocessfile}}

                    </div>

                    </a>

                  </div>

                  <div>

                    <a href="{{route('report.sectionwises',['type'=>'Letter','status'=>'In Process'])}}" class="text-light">

                    <div>

                      Letter InProcess

                    </div>

                    <div class="text-light">

                      {{$inprocessletter}}

                    </div>

                    </a>

                  </div>

                </div>

              </span>

            </div>

            <!-- /.info-box-content -->

          </div>



           <!-- /.info-box -->

           <div class="info-box mb-3 bg-success">

            <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>



            <div class="info-box-content">

                <a href="{{route('report.sectionwises',['type'=>'File','status'=>'Dispost'])}}" class="text-light">

                    <span class="info-box-text">Completed</span>

                    <span class="info-box-number">{{$dispost}}</span>

                </a>

            </div>

            <!-- /.info-box-content -->

          </div>





        </div>

        <div class="col-md-12">



        <!-- BAR CHART -->

        <div class="card card-success">

          <div class="card-header">

            <h3 class="card-title">Section Wise Progress Chart</h3>



            <div class="card-tools">

              <button type="button" class="btn btn-tool" data-card-widget="collapse">

                <i class="fas fa-minus"></i>

              </button>

              <button type="button" class="btn btn-tool" data-card-widget="remove">

                <i class="fas fa-times"></i>

              </button>

            </div>

          </div>

          <div class="card-body">

            <div class="chart">

              <canvas id="sectionChart" ></canvas>

            </div>

          </div>

          <!-- /.card-body -->

        </div>

        <!-- /.card -->

        </div>

        <!-- /.col -->



      </div>

      <!-- /.row -->

    </div><!--/. container-fluid -->

  </section>

  <!-- /.content -->

@endsection

@push('script')

<!-- DataTables  & Plugins -->

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>

<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="../../plugins/jszip/jszip.min.js"></script>

<script src="../../plugins/pdfmake/pdfmake.min.js"></script>

<script src="../../plugins/pdfmake/vfs_fonts.js"></script>

<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>



 //-------------

    //- DONUT CHART -

    //-------------

    // Get context with jQuery - using jQuery's .get() method.

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')

    var donutData        = {

      labels: [

          'In Transit',

          'In Process',

          'Completed',

          'Created',

      ],

      datasets: [

        {

          data: [{{$intransit ?? 0}},{{$inprocess ?? 0}},{{$dispost ?? 0}},{{$createdfile ?? 0}}],

          backgroundColor : ['#ffc107', '#dc3545', '#28a745', '#17a2b8'],

        //   backgroundColor : ['#ffc107', '#28a745', '', '#17a2b8'],

        }

      ]

    }

    var donutOptions     = {

      maintainAspectRatio : false,

      responsive : true,

    }

    //Create pie or douhnut chart

    // You can switch between pie and douhnut using the method below.

    new Chart(donutChartCanvas, {

      type: 'doughnut',

      data: donutData,

      options: donutOptions

    })



     //-------------

    //- BAR CHART -

    //-------------

    const sections = @json($sections);



const labels = sections.map(section => section.name);

const createdCounts = sections.map(section => section.created_count);

const disposedCounts = sections.map(section => section.disposed_count);

const inProcessCounts = sections.map(section => section.in_process_count);

const transitCounts = sections.map(section => section.transit_count);



const ctx = document.getElementById('sectionChart').getContext('2d');

const sectionChart = new Chart(ctx, {

    type: 'bar',

    data: {

        labels: labels,

        datasets: [

            {

                label: 'Created Count',

                data: createdCounts,

                backgroundColor: '#17a2b8',

                borderColor: '#17a2b8',

                borderWidth: 1

            },

            {

                label: 'Completed Count',

                data: disposedCounts,

                backgroundColor: '#28a745',

                borderColor: '#28a745',

                borderWidth: 1

            },

            {

                label: 'In Process Count',

                data: inProcessCounts,

                backgroundColor: '#dc3545',

                borderColor: '#dc3545',

                borderWidth: 1

            },

            {

                label: 'Transit Count',

                data: transitCounts,

                backgroundColor: '#ffc107',

                borderColor: '#ffc107',

                borderWidth: 1

            }

        ]

    },

    options: {

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});





  $(function () {

    $("#example1").DataTable({

        "paging": true,

        "lengthChange": false,

        "searching": true,

        "ordering": true,

        "info": true,

        "autoWidth": false,

        "responsive": true,

        "buttons": ["copy", "csv", "excel", "pdf", "print"]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false,

      "responsive": true,

    });

  });

</script>



@endpush

