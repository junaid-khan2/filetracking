@extends('layouts.app',['page_title'=>'Track File'])
@push('style')
    <!-- Dropzone CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
<style>
    /* The actual timeline (the vertical ruler) */
.main-timeline-5 {
  position: relative;
  max-width: 70%;
  margin: 0 auto;
}

/* The actual timeline (the vertical ruler) */
.main-timeline-5::after {
  content: "";
  position: absolute;
  width: 5px;
  background-color: #007bff;
  top: 0;
  bottom: 0;
  left: auto;
  margin-left: -3px;
}

/* Container around content */
.timeline-5 {
  position: relative;
  background-color: inherit;
  width: 100%;
}

/* The circles on the timeline */
.timeline-5::after {
  content: "";
  position: absolute;
  width: 20px;
  height: 20px;
  right: 1px;
  background-color: #007bff;
  top: 18px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the right */
.right-5 {
  padding: 0px 0px 20px 40px;
  left: auto;
}

/* Add arrows to the right container (pointing left) */
.right-5::before {
  content: " ";
  position: absolute;
  top: 18px;
  z-index: 1;
  left: 30px;
  border: medium solid #fff;
  border-width: 10px 10px 10px 0;
  border-color: transparent #fff transparent transparent;
}

/* Fix the circle for containers on the right side */
.right-5::after {
  left: -10px;
}

@media (max-width: 991px) {
  .main-timeline-5 {
    max-width: 100%;
  }
}

</style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
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
                              <a href="#" class="float-right "><span  class="badge p-2 bg-success ">{{$File->status}}</span></a>
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
                    <div class="timeline-footer">
                      @foreach ($File->attachment as $item)
                      <a  href="{{asset($item->path.$item->source)}}" target="_blank" class="btn btn-primary btn-sm">{{$item->source}} <i class="fa fa-download"></i></a>
                      @endforeach

                      {{-- <a class="btn btn-primary btn-sm">Attachment2</a>
                      <a class="btn btn-primary btn-sm">Attachment3</a> --}}
                    </div>

                    <!-- /.post -->
                  </div>
                </div>
            </div>
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline time label -->

                <!-- /.timeline-label -->
                <!-- timeline item -->
                @foreach ($FileLog as $item)
                <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">

                    <span class="time">{{$item->date}} <i class="fas fa-clock"></i></span>
                    <h3 class="timeline-header">{{$item->from->name ?? ''}} To {{$item->to->name ?? ''}}</h3>

                    <div class="timeline-body">
                     {!! $item->content !!}
                    </div>
                    <div class="timeline-footer">
                      @foreach ($item->attachment as $item1)
                      <a  href="{{asset($item1->path.$item1->source)}}" target="_blank" class="btn btn-primary btn-sm">{{$item1->source}} <i class="fa fa-download"></i></a>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endforeach

                <!-- END timeline item -->

                <div>
                  <i class="fas fa-clock bg-gray"></i>
                </div>
              </div>
            </div>
            <!-- /.col -->
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
