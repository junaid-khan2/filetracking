@extends('layouts.app',['page_title'=>'User Performance Evalution Report'])

@push('style')

 <!-- DataTables -->

 <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

 <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

 <style>

  #colorDisplay {

    width: 100%;

    height: 20px;

    border-radius: 5px;

    margin: 10px 0;

  }

 </style>

@endpush

@section('content')

<section class="content">

    <div class="container-fluid">

        <div class="col-md-12">

            <!-- TABLE: LATEST ORDERS -->

            <div class="card">

             <div class="card-header border-transparent">

                <form  action="{{route('report.performance.user')}}">

                <div class="row mb-1">





                    <div class="col-3">

                        <div class="form-group">

                            <label for="to_date">Sections</label>



                                <select name="section" class="select2 form-control" id="section">

                                    <option value="">Select Section</option>

                                    @foreach ($sections as $item)



                                        <option @if(request('section') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>

                                    @endforeach

                                </select>

                        </div>

                    </div>

                    <div class="col-3">

                        <div class="form-group">

                            <label for="to_date">Users</label>



                                <select name="user" class="select2 form-control" id="user">

                                    <option value="">Select User</option>



                                       @isset($users)

                                       @forelse ($users as $item)

                                       <option @if(request('user') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>

                                       @empty



                                       @endforelse

                                       @endisset

                                </select>

                        </div>

                    </div>

                    <div class="col-3">

                        <div class="form-group">

                            <label for="duration">Duration</label>



                                <select name="duration" class="select2 form-control" id="duration">

                                    <option value="day">Current Day</option>

                                    <option value="week">Current Week</option>

                                    <option value="month">Current Month</option>

                                    <option value="year">Current Year</option>

                                </select>

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

                 <table id="example1" class="table m-0">

                     <thead>

                         <tr>

                             <th>Assigned Tasks</th>

                             <th>Completed Tasks</th>

                             <th>Performance %age</th>

                             <th>Grade</th>

                             <th>Remarks</th>

                         </tr>

                     </thead>

                     <tbody >

                        @if (isset($prfamance) )

                            <tr>

                                <td><a href="#" href1="{{route('report.performance.user.single',['userId'=>request('user'),'type'=>'Assigned'])}}">{{$prfamance['created']}}</a> </td>

                                <td><a href="#" href1="{{route('report.performance.user.single',['userId'=>request('user'),'type'=>'complated'])}}">{{$prfamance['complated']}}</a></td>

                                <td>{{$prfamance['per']}}</td>

                                <td>{{$prfamance['grade']}}</td>

                                <td>{{$prfamance['remarks']}}</td>

                            </tr>

                        @endif

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

    var pageTitle = "{{ isset($prfamance['title']) ? $prfamance['title'] : 'User Performance Evalution Report' }}";

    if (pageTitle) {

        $(document).ready(function() {

            document.title = pageTitle;

        });

    }



    $('#section').on('change',function(){

        var section_id = $("#section").val();



        $.ajax({

        url: "{{ route('sections.users', '') }}/" + section_id,

        type: "GET",

        success: function(response) {

            // Assuming your response is an array of users

            var users = response;



            // Clear existing options

            $('#user').empty();



            // Append new options

            $.each(users, function(index, user) {

                $('#user').append('<option value="' + user.id + '">' + user.name + '</option>');

            });

        },

        error: function(xhr, status, error) {

            console.error(error);

        }

    });

    })

    $("#example1").DataTable({

        "paging": false,

        "lengthChange": false,

        "searching": false,

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

    $('#example1 a').click(function(){
        debugger  


        var loc=$(this).attr("href1")+'&duration='+$('#duration').val();
        window.location.href=loc;
    });

  });

</script>



@endpush



