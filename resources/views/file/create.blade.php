@extends('layouts.app',['page_title'=>'Create File'])
@push('style')
    <!-- Dropzone CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">File</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('file.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <fieldset class="border px-3">
                        <legend class="w-auto px-2">File Section</legend>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="input1">File Type</label>
                                    <select name="file_type" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select File Type</option>
                                        <option value="File">File</option>
                                        <option value="Letter">Letter</option>
                                        <option value="Application">Application</option>
                                        <option value="Diary">Diary</option>
                                      </select>
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="input1">Master File</label>
                                    <select name="master_file" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Master File</option>
                                        @foreach ($masterfile as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="input1">Flag</label>
                                    <select name="flag" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Flag</option>
                                        <option value="Narmal">Narmal</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Immediate">Immediate</option>
                                      </select>
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="input1">Case Type</label>
                                    <select name="case_type" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Case Type</option>
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Source</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="source" id="internal" value="internal">
                                        <label class="form-check-label" for="internal">Internal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="source" id="external" value="external">
                                        <label class="form-check-label" for="external">External</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border px-3">
                        <legend class="w-auto px-2">Deparment / Office Section</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="input1">To Section</label>
                                    <select name="to_section" class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Deparment</option>
                                        @foreach ($section as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="input1">Received Date</label>
                                    <input type="date" class="form-control" name="date" id="">
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <fieldset class="border px-3">
                        <legend class="w-auto px-2">Subject | Content Detals</legend>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="input1">Subject</label>
                                    <input type="text" name="subject" placeholder="Enter Subject Title" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <textarea name="content" id="summernote">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="input1">Attachment</label>
                                <input type="file" class="form-control" name="attachment[]" multiple id="">
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary mt-4">Create <i class="fa fa-save"></i></button>
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
<script>
    $(function () {
      // Summernote
      $('#summernote').summernote()

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });

    })
  </script>

@endpush
