@extends('layouts.app',['page_title'=>'Sections Performance Evalution Report'])

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

                <form  action="{{route('report.performance.section')}}">

                <div class="row mb-1">









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

                             <th>Section</th>

                             <th>Assigned Tasks</th>

                             <th>Completed Tasks</th>

                             <th>Performance %age</th>

                             <th>Grade</th>

                             <th>Remarks</th>

                         </tr>

                     </thead>

                     <tbody >

                        @if (isset($performance_list) )

                        @foreach ($performance_list as $item)

                        <tr>

                            <td>{{$item['section']}}</td>

                            <td>{{$item['created']}}</td>

                            <td>{{$item['complated']}}</td>

                            <td>{{$item['per']}}</td>

                            <td>{{$item['grade']}}</td>

                            <td>{{$item['remarks']}}</td>

                        </tr>

                        @endforeach



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



    var pageTitle = "{{ isset($prfamance['title']) ? $prfamance['title'] : 'Sections Performance Evalution Report' }}";

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

        "paging": true,

        "lengthChange": true,

        "searching": true,

        "info": true,

        "autoWidth": false,

        "responsive": true,

        "buttons": ["copy", "csv", "excel", "pdf", "print"]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": true,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false,

      "responsive": true,

    });

    $('#example1 a').click(function(){



        var loc=$(this).attr("href1")+"?from_date="+$('#from_date').val()+"&to_date="

        +$('#to_date').val();

        window.location.href=loc;



});

  });

</script>



@endpush



