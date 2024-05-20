@extends('layouts.app',['page_title'=>'Forward File'])
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

              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                  <!-- Post -->
                              <div class="post">
                                <div class="user-block">
                                  <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                  <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>
                                    <div class="float-right">
                                        <a href="#" class="float-right "><span  class="badge p-2 bg-danger ">Active</span></a>
                                    </div>

                                  </span>
                                  <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                  Lorem ipsum represents a long-held tradition for designers,
                                  typographers and the like. Some people hate it and argue for
                                  its demise, but others ignore the hate as they create awesome
                                  tools to help create filler text for everyone from bacon lovers
                                  to Charlie Sheen fans.
                                </p>

                              </div>

                              <!-- /.post -->
                            </div>
                        </div>
                    </div>

                    <fieldset class="border px-3">
                        <legend class="w-auto px-2">Deparment / Office Section</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-control" aria-label="Default select example">
                                        <option selected disabled>Select Deparment</option>
                                        <option value="1">Section 1</option>
                                        <option value="2">Section 2</option>
                                        <option value="3">Section 3</option>
                                      </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border px-3 mt-2">
                        <legend class="w-auto px-2"> Comments</legend>
                        <div class="row">

                            <div class="col-12">
                                <textarea id="summernote" style="width: 50px">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="input1">Attachment</label>
                                <input type="file" class="form-control" name="" id="">
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
