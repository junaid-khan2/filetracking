@extends('layouts.app', ['page_title' => 'Complete File'])

@push('style')
    <!-- Dropzone CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">



                    <!-- /.card-header -->

                    <!-- form start -->

                    <form action="{{ route('forword.desposed.store', $File->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="from_section" value="{{ $File->recentSection->id }}" id="">

                        <input type="hidden" name="file_id" value="{{ $File->id }}" id="">

                        <div class="card-body">

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="card-body">

                                        <!-- Post -->

                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('images/KPK_Police_Logo.svg') }}" alt="user image">
                                                <span class="username">
                                                    <a href="#">{{ $File->initiatedbysection->name }}</a>
                                                    <div class="float-right " style="font-weight: bold; font-size: 14px">
                                                        {{ $File->category->name ?? '' }} |
                                                        {{ $File->track_number . ' | ' . $File->created_at->format('d F Y  h:i A') }}
                                                        |
                                                        @if ($File->status == 'In Process')
                                                            <span class="badge badge-danger">In Process</span>
                                                        @elseif($File->status == 'Dispost')
                                                            <span class="badge badge-success">Complete</span>
                                                        @elseif($File->status == 'In Transit')
                                                            <span class="badge badge-warning">In Transit</span>
                                                        @endif
                                                    </div>
                                                </span>
                                                <span class="description "
                                                    style="font-weight: bold; font-size: 14px">Subject:
                                                    {{ $File->subject ?? '' }} </span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>

                                                {!! $File->content !!}
                                            </p>

                                            <p>
                                                <span class="float-right">


                                                </span>
                                            </p>


                                        </div>





                                        <!-- /.post -->

                                    </div>

                                </div>

                            </div>



                            {{-- <fieldset class="border px-3">

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

                    </fieldset> --}}

                            <fieldset class="border px-3 mt-2">

                                <legend class="w-auto px-2"> Comments</legend>

                                <div class="row">



                                    <div class="col-12">


                                        <textarea col='20' row='20' name="content" class="form-control " style="height: 138px;" id=""> </textarea>

                                    </div>

                                    <div class="form-group">

                                        <label for="input1">Attachment</label>

                                        <input type="file" class="form-control" name="attachment[]" multiple
                                            id="">

                                    </div>

                                </div>

                            </fieldset>

                            <button type="submit" class="btn btn-primary mt-4">Complete <i
                                    class="fa fa-power-off"></i></button>

                        </div>



                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection

@push('script')
    <!-- Summernote -->

    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- CodeMirror -->

    <script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>

    <script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>

    <script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>

    <script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

    <!-- Dropzone JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        $(function() {

            tinymce.init({
                selector: '#summernote', // Use the ID of the textarea
                plugins: 'advlist autolink lists link image charmap print preview anchor',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
                height: 250, // set the height of the editor
                menubar: false // disable the menubar
            });



        })
    </script>
@endpush
