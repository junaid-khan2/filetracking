@extends('layouts.app',['page_title'=>'Dashboard'])
@push('style')
 <!-- DataTables -->
 <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
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
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Letter</span>
                  <span class="info-box-number"> {{$Letter ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Application</span>
                  <span class="info-box-number">{{$Application ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Diary</span>
                  <span class="info-box-number">{{$Diary ?? 0}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
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
                  <h3 class="card-title">Donut Chart</h3>

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
              <!-- Info Boxes Style 2 -->
              <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    In Transit</span>
                  <span class="info-box-number">{{$intransit}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="far fa-heart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">In Process</span>
                  <span class="info-box-number">{{$inprocess}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Dispost</span>
                  <span class="info-box-number">{{$dispost}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="far fa-comment"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Created</span>
                  <span class="info-box-number">{{$created}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->


            </div>
            <div class="col-md-12">
              
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

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
                  <canvas id="barChart" ></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
                   <!-- TABLE: LATEST ORDERS -->
                   <div class="card">
                    <div class="card-header border-transparent">
                      <h3 class="card-title">Latest Files</h3>
    
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <div class="table-responsive">
                        <table id="example1" class="table m-0">
                            <thead>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Created</th>
                                    <th>Disposed</th>
                                    <th>In Process</th>
                                    <th>In Transit</th>
                                </tr>
                            </thead>
                            <tbody >
                              @foreach ($sections as $item)
                                <tr>
                                  <td><a href="#">{{$item->name}}</a></td>
                                  <td>{{$item->created_count}}</td>
                                  <td>{{$item->disposed_count}}</td>
                                  <td>{{$item->in_process_count}}</td>
                                  <td>{{$item->transit_count}}</td>
                                  
                              </tr>
                              @endforeach
                                {{-- <tr>
                                    <td><a href="pages/examples/invoice.html">OR1234</a></td>
                                    <td>Project Alpha</td>
                                    <td>Initial Documentation</td>
                                    <td><span class="badge badge-info">Created</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR5678</a></td>
                                    <td>Project Beta</td>
                                    <td>Design Phase</td>
                                    <td><span class="badge badge-success">In Process</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9101</a></td>
                                    <td>Project Gamma</td>
                                    <td>Prototype Development</td>
                                    <td><span class="badge badge-warning">In Transit</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR1121</a></td>
                                    <td>Project Delta</td>
                                    <td>Final Testing</td>
                                    <td><span class="badge badge-danger">Disposed</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR3141</a></td>
                                    <td>Project Epsilon</td>
                                    <td>Initial Planning</td>
                                    <td><span class="badge badge-info">Created</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR5161</a></td>
                                    <td>Project Zeta</td>
                                    <td>Execution Phase</td>
                                    <td><span class="badge badge-success">In Process</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR7181</a></td>
                                    <td>Project Eta</td>
                                    <td>Logistics Coordination</td>
                                    <td><span class="badge badge-warning">In Transit</span></td>
                                </tr>
                                <tr>
                                    <td><a href="pages/examples/invoice.html">OR9202</a></td>
                                    <td>Project Theta</td>
                                    <td>Quality Assurance</td>
                                    <td><span class="badge badge-danger">Disposed</span></td>
                                </tr> --}}
                            </tbody>
                        </table>
    
                      </div>
                      <!-- /.table-responsive -->
                    </div>
    
                  </div>
                  <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div><!-- /.container-fluid -->
  </section>
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
          'Dispost',
          'Created',
      ],
      datasets: [
        {
          data: [{{$intransit ?? 0}},{{$inprocess ?? 0}},{{$dispost ?? 0}},{{$created ?? 0}}],
          backgroundColor : ['#ffc107', '#28a745', '#dc3545', '#17a2b8'],
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
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


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
