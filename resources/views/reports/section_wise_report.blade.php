@extends('layouts.app',['page_title'=>'Section Wise Report'])
@push('style')
 <!-- DataTables -->
 <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
             <div class="card-header border-transparent">
               <h3 class="card-title">Sections</h3>

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

                             <th>In Transit</th>
                             <th>Completed</th>
                             <th>Pending</th>
                         </tr>
                     </thead>
                     <tbody >
                       @foreach ($sections as $item)
                         <tr>
                           <td><strong>{{$item->name}}</a></td>
                           <td><a href="{{route('report.section',['section'=>$item->id,'type'=>'Created'])}}">{{$item->created_count}}</a></td>

                           <td><a href="{{route('report.section',['section'=>$item->id,'type'=>'In Transit'])}}">{{$item->transit_count}}</a></td>
                           <td><a href="{{route('report.section',['section'=>$item->id,'type'=>'Completed'])}}">{{$item->disposed_count}}</a></td>
                           <td><a href="{{route('report.section',['section'=>$item->id,'type'=>'In Process'])}}">{{$item->in_process_count}}</a></td>
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
        "order": [[1, 'desc'], [0, 'desc']],
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

