@extends('layouts.app',['page_title'=>'Forward File'])
@push('style')
    <!-- Dropzone CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
@endpush
@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">

              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('forword.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="from_section" value="{{$File->recentSection->id}}" id="">
                <input type="hidden" name="file_id" value="{{$File->id}}" id="">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                  <!-- Post -->
                              <div class="post">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                  <span class="username">
                                    <span >{{$File->initiatedbysection->name}}</span>
                                    <div class="float-right">
                                        <a href="#" class="float-right "><span  class="badge p-2 bg-success ">{{$File->date}}</span></a>
                                    </div>

                                  </span>
                                  {{--
                                  <span class="mx-3"></span>
                                  <hr> --}}
                                  <span class="description"><strong>Subject : </strong> {{$File->subject}} </span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                {!! $File->content !!}
                                </p>

                              </div>

                              <!-- /.post -->
                            </div>
                        </div>
                    </div>

                    <fieldset class="border px-3">

                        @if ($File->file_type == "Letter")
                        <legend class="w-auto px-2">Deparment / Office Section</legend>
                        {{-- <div class="row mb-3">
                            <div class="col-6 offset-6 ">
                                <div class="form-group">
                                    <label for="search_file">Search File</label>
                                    <input type="text" id="search_file_no" placeholder="Search File NO" class="form-control" name="search_file">
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">

                            <div class="col-6" >
                                <div class="form-group">
                                    <label for="file_name">File Name</label>
                                    <input type="text" placeholder="File Name" class="form-control"
                                        name="file_name" id="file_name">
                                </div>
                            </div>
                            <div class="col-6" >
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="file_no">File No</label>
                                            <input type="text" placeholder="File No" class="form-control"
                                                name="file_no" id="file_no" readonly value="{{$file_no}}">
                                        </div>
                                    </div>
                                    <div class="col-6">


                                       <div id="qr_code">
                                        {{QrCode::size(100)->generate($file_no)}}
                                       </div>
                                        <span id="reference_no_span">{{$file_no}}</span>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="col-6">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <select name="designation" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Designation</option>
                                        <option value="Designation">Designation</option>
                                        <option value="Designation">Designation 1</option>
                                        <option value="Designation">Designation 2</option>
                                        <option value="Designation">Designation 3</option>
                                        <option value="Designation">Designation 4</option>
                                      </select>
                                </div>
                            </div> --}}
{{-- 
                            <div class="col-6">
                                <label for="dead_line">To Section </label>
                                <div class="form-group">
                                    <select name="section" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Section</option>
                                        @foreach ($section as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div> --}}
                        </div>
                        @else
                        <legend class="w-auto px-2">Deparment / Office Section</legend>
                        <div class="row">
                            <div class="col-6">

                                <div class="form-group">
                                    <select name="section" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Section</option>
                                        @foreach ($section as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                        @endif

                    </fieldset>
                    <fieldset class="border px-3 mt-2">
                        <legend class="w-auto px-2"> Comments</legend>
                        <div class="row">

                            <div class="col-12">
                                <textarea name="content" id="summernote" style="width: 50px">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="input1">Attachment</label>
                                <input type="file" class="form-control" name="attachment[]" multiple id="">
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary mt-4" id="forword_btn"> Forward <i class="fa fa-save"></i></button>
                </div>

              </form>
            </div>
          </div>
        </div>
  </div>
</section>
@endsection
@push('script')
    <!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- CodeMirror -->
<script src="{{asset('plugins/codemirror/codemirror.js')}}"></script>
<script src="{{asset('plugins/codemirror/mode/css/css.js')}}"></script>
<script src="{{asset('plugins/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
 <!-- Dropzone JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" ></script>

<script>
    $(function () {
        $('#search_file_no').on('keyup', function() {
            var file_no = $(this).val();
            debugger
           // if(file_no.length > 6){
                $.ajax({
                url: "{{ route('file.file_no_search') }}",
                type: "GET",
                data: { file_no: file_no },
                success: function(response) {
            
                    if(response.reference_no) {
                    $("#forword_btn").text('Attach');
                        $("#file_name").val(response.name);
                        $("#file_no").val(response.reference_no);
                        $("#reference_no_span").html(response.reference_no);
                        $("#qr_code").html('');
                        debugger
                        var qr = new QRCode(document.getElementById("qr_code"), {
                                text: response.reference_no,
                                width: 100,
                                height: 100,
                            });

                    }
                }
            });
           // }

        });
      // Summernote
      $('#summernote').summernote()

      // CodeMirror
    //   CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    //     mode: "htmlmixed",
    //     theme: "monokai"
    //   });

    })
  </script>

@endpush
