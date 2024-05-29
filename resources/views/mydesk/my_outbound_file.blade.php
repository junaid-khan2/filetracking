@extends('layouts.app',['page_title'=>'My OutBound Files'])
@push('style')
 <!-- DataTables -->
 <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">

    </div>
        <div class="row">
            <div class="col-12">
              <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>

                    <tr>
                      <th data-orderable="false">Action</th>
                      <th>Subject</th>
                      <th>Bar Code</th>
                      <th>Initiates Section</th>
                      <th>Current Section</th>
                      <th>Status</th>
                      <th>Receved Date</th>
                      {{-- <th>Days On Desk</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($file as $item)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('track.show',$item->id)}}"><i class="fa fa-search"></i> Track</a>
                                      <a class="dropdown-item" href="{{route('forword.create',$item->id)}}"><i class="fa fa-angle-right"></i> Forword To</a>
                                      <a class="dropdown-item" href="{{route('forword.inprocess',$item->id)}}"><i class="fa fa-tasks"></i> In Process</a>
                                      <a class="dropdown-item" href="{{route('forword.desposed',$item->id)}}"><i class="fa fa-trash"></i> Desposed</a>
                                    </div>
                                  </div>
                            </td>
                            <td>{{$item->subject ?? $item->name}}</td>
                            <td>{{$item->track_number}}</td>
                            <td>{{$item->initiatedbysection->name}}</td>
                            <td>{{$item->recentSection->name}}</td>
                            <td>
                              @if ($item->status == "In Process")
                                  <span class="badge badge-danger">{{$item->status}}</span>
                              @elseif ($item->status == "In Transit")
                              <span class="badge badge-warning">{{$item->status}}</span>
                              @elseif ($item->status == "Dispost")
                                <span class="badge badge-success">Completed</span>
                              @endif
                            </td>
                            <td>{{$item->lastLog()->date}}</td>
                            {{-- <td>9</td> --}}
                        </tr>
                        @endforeach
                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
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
