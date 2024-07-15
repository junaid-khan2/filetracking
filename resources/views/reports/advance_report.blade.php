@extends('layouts.app',['page_title'=>'Advance Report'])

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

               <form  action="{{route('report.advance')}}">

                <div class="row mb-1">



                    <div class="col-2">

                        <div class="form-group">

                            <label for="from_date">From Date</label>

                            <input type="date" value="{{ request('from_date') }}" class="form-control" name="from_date" id="from_date"

                                placeholder="From Date">

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="to_date">To Date</label>

                            <input type="date" value="{{ request('to_date') }}" class="form-control" name="to_date" id="to_date"

                                placeholder="To Date">

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="to_date">Initiated Section</label>

                            <select name="section" class="form-control select2" id="section">

                                <option value="" selected>Select Section</option>

                                @foreach ($sections as $item)

                                    @if (request('section') == $item->id)



                                    <option selected value="{{$item->id}}">{{$item->name}}</option>

                                    @else



                                    <option value="{{$item->id}}">{{$item->name}}</option>

                                    @endif

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="last_desk">Last Desk</label>

                            <select name="last_desk" class="form-control select2" id="last_desk">

                                <option value="" selected>Select Section</option>

                                @foreach ($sections as $item)

                                    @if (request('last_desk') == $item->id)



                                    <option selected value="{{$item->id}}">{{$item->name}}</option>

                                    @else



                                    <option value="{{$item->id}}">{{$item->name}}</option>

                                    @endif

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="to_date">Type</label>

                            <select name="type" class="form-control" id="type">

                                <option value="" selected>Select Type</option>

                                <option @if (request('type') == "Letter") selected @endif value="Letter">Letter</option>

                                <option @if (request('type') == "File") selected @endif  value="File">File</option>

                                <option @if (request('type') == "NoteSheet") selected @endif  value="NoteSheet">NoteSheet</option>

                            </select>

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="to_date">Status</label>



                            <select name="status" class="form-control" id="status">

                                <option value="" selected>Select Staus</option>

                                <option @if (request('status') == "Created") selected @endif  value="Created">Created</option>

                                <option @if (request('status') == "In Transit") selected @endif  value="In Transit">In Transit</option>

                                <option @if (request('status') == "In Process") selected @endif  value="In Process">In Process</option>

                                <option @if (request('status') == "Dispost") selected @endif  value="Dispost">Completed</option>

                            </select>

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="to_date">Nature of Case</label>



                            <select name="category" class="form-control" id="category">

                                <option value="" selected>Select Nature OF Case</option>

                                @foreach ($category as $item)

                                @if (request('category') == $item->id)



                                <option selected value="{{$item->id}}">{{$item->name}}</option>

                                @else



                                <option value="{{$item->id}}">{{$item->name}}</option>

                                @endif

                                @endforeach

                            </select>

                        </div>

                    </div>


                    <div class="col-2">

                        <div class="form-group">

                            <label for="subject">Subject</label>

                            <input type="text" value="{{request('subject')}}" class="form-control" name="subject" id="subject"

                                placeholder="Subject ">

                        </div>

                    </div>
                    <div class="col-2">

                        <div class="form-group">

                            <label for="letter_no">Letter NO</label>

                            <input type="text" value="{{request('letter_no')}}" class="form-control" name="letter_no" id="subject"

                                placeholder="Letter No ">

                        </div>

                    </div>

                    <div class="col-2">

                        <div class="form-group">

                            <label for="reference_no">Reference No</label>

                            <input type="text" value="{{request('reference_no')}}" class="form-control" name="reference_no" id="reference_no"

                                placeholder="Reference No">

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

                      <th>Letter No</th>

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

                            <td>{{$item->letter_no ?? ''}}</td>

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

                            <td>{{$item->lastLog()->date ?? ''}}</td>

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



