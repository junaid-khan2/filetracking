@extends('layouts.app',['page_title'=>'Open Search'])
@push('style')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
             <div class="card-header border-transparent">
               <form  action="{{route('open.search')}}">
                <div class="row mb-1">


                    <div class="col-6">
                        <div class="form-group">
                            <label for="subject">&nbsp;</label>
                            <input type="text" value="{{request('q')}}" class="form-control" name="q" id="q"
                                placeholder="Search File... ">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="filter">&nbsp;</label>
                            <button type="submit" class="form-control btn btn-primary"
                                >Search</button>
                        </div>
                    </div>
                </div>
               </form>
             </div>
             <!-- /.card-header -->
             <div class="card-body p-0">
               <div class="table-responsive">
                <table id="example11" class="table table-bordered table-hover">
                    <thead>

                    <tr>
                      <th>Action</th>
                      <th>Type</th>
                      <th>Subject</th>
                      <th>Reference No</th>
                      <th>Initiated Section</th>
                      <th>Current Section</th>
                      <th>Status</th>
                      <th>Type</th>
                      <th>Initiated Date</th>
                      <th>Received Date</th>
                      {{-- <th>Days On Desk</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $item)
                        <tr>
                            <td><a class="btn btn-success btn-sm" href="{{route('track.show',$item->id)}}"><i class="fa fa-eye"></i> Track</a></td>
                            <td>{{$item->file_type ?? ''}}</td>
                            <td>{{$item->subject ?? $item->name}}</td>
                            <td>{{$item->reference_no ?? ''}}</td>
                            <td>{{$item->initiatedbysection->name ?? ''}}</td>
                            <td>{{$item->recentSection->name ?? ''}}</td>
                            <td>
                              @if ($item->status == "In Process")
                                  <span class="badge badge-danger">{{$item->status}}</span>
                              @elseif ($item->status == "In Transit")
                              <span class="badge badge-warning">{{$item->status}}</span>
                              @elseif ($item->status == "Dispost")
                                <span class="badge badge-success">Completed</span>
                              @endif
                            </td>
                            <td>{{$item->file_type}}</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->lastLog()->date}}</td>
                            {{-- <td>9</td> --}}
                        </tr>
                        @endforeach
                    </tbody>

                  </table>

               </div>
               <!-- /.table-responsive -->
             </div>

           </div>
           <!-- /.card -->
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
    $("#example11").DataTable({
        // "paging": true,
        lengthChange: false,
        searching: true,
        ordering: true,
        order: [[ 4, 'desc' ]],
        info: true,
        autoWidth: false,
        responsive: true,
        buttons: ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>

@endpush

