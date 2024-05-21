@extends('layouts.app',['page_title'=>'Dashboard'])
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
                    10
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
                  <span class="info-box-number">41,410</span>
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
                  <span class="info-box-number">760</span>
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
                  <span class="info-box-number">2,000</span>
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
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Track ID</th>
                                <th>File Name</th>
                                <th>Subject</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                            </tr>
                        </tbody>
                    </table>

                  </div>
                  <!-- /.table-responsive -->
                </div>

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
                  <span class="info-box-number">5,200</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="far fa-heart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">In Process</span>
                  <span class="info-box-number">92,050</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Dispost</span>
                  <span class="info-box-number">114,381</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
              <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="far fa-comment"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Created</span>
                  <span class="info-box-number">163,921</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->


            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
