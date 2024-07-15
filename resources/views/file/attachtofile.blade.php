@extends('layouts.app',['page_title'=>'Attach to File'])

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

              <form action="{{route('forword.attachtofile',$File->id)}}" method="POST" enctype="multipart/form-data">

                @csrf



                <input type="hidden" name="file_id" value="{{$File->id}}" id="">

                <div class="card-body">





                    <fieldset class="border px-3">





                        <legend class="w-auto px-2">File Section</legend>

                        <div class="row mb-3">

                            <div class="col-6 ">

                                <div class="form-group">

                                    <label for="search_file">Search File</label>

                                    {{-- <input type="text" id="search_file_no" placeholder="Search File NO" class="form-control" name="search_file"> --}}

                                    <select id="search_file_no" placeholder="Search File NO" class="form-control select2" name="search_file">

                                        <option value="">Select File</option>

                                        @foreach ($Files as $item)

                                            <option value="{{$item->id}}">{{$item->reference_no}}</option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>









                    </fieldset>

                    <fieldset class="border px-3 mt-2">

                        <legend class="w-auto px-2"> Comments</legend>

                        <div class="row">



                            <div class="col-12">

                                <!-- <textarea name="content" id="summernote" >



                                </textarea> -->
                                <textarea col='20' row='20' name="content" class="form-control " style="height: 138px;" id=""> </textarea>

                            </div>

                            <div class="form-group">

                                <label for="input1">Attachment</label>

                                <input type="file" class="form-control" name="attachment[]" multiple id="">

                            </div>

                        </div>

                    </fieldset>

                    <button type="submit" class="btn btn-primary mt-4" id="forword_btn"> Attach <i class="fa fa-file"></i></button>

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



      tinymce.init({
            selector: '#summernote', // Use the ID of the textarea
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
            height: 250,  // set the height of the editor
            menubar: false  // disable the menubar
        });





    })

  </script>



@endpush

