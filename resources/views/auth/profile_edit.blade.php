@extends('layouts.app', ['page_title' => 'Edit Profile'])

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

                        {{-- <div class="card-header">

                            <h3 class="card-title">Letter</h3>

                        </div> --}}

                        <!-- /.card-header -->

                        <!-- form start -->

                        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            @method('PATCH')

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-6" id="reference_no">

                                        <div class="form-group">

                                            <label for="input1">User Name</label>

                                            <input type="text" placeholder="user Name" class="form-control"

                                                name="name"  value="{{ $user->name }}">

                                        </div>

                                    </div>

                                    <div class="col-6" id="email">

                                        <div class="form-group">

                                            <label for="email">Email</label>

                                            <input type="email" placeholder="Email Address" class="form-control"

                                                name="email" value="{{ $user->email }}">

                                        </div>

                                    </div>
                                    <div class="col-6" id="email">

                                        <div class="form-group">

                                            <label for="recovery_email">Recovery Email</label>

                                            <input type="email" placeholder="Recovery Email Address" class="form-control"

                                                name="recovery_email" value="{{ $user->recovery_email }}">

                                        </div>

                                    </div>

                                    <div class="col-6" id="belt_no">

                                        <div class="form-group">

                                            <label for="password">New Password</label>

                                            <input type="text" class="form-control" placeholder="New Password" name="password">

                                        </div>

                                    </div>

                                    <div class="col-6" >

                                        <div class="form-group">

                                            <label for="profile">Profile</label>

                                            <input type="file" class="form-control" placeholder="Profile" name="profile">

                                        </div>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Update <i

                                        class="fa fa-edit"></i></button>

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

            // Summernote

            $('#summernote').summernote()



            // CodeMirror

            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {

                mode: "htmlmixed",

                theme: "monokai"

            });



        })



        // $(document).ready(function() {

        //     $("#reference_no").hide();

        //     $("#letter_no").hide();

        //     $("#belt_no").hide();

        //     $('#file_type').change(function() {

        //         debugger;

        //         var file_type = $(this).val();

        //         if (file_type == "File") {

        //             $("#reference_no").show();

        //             $("#letter_no").hide();

        //             $("#belt_no").hide();

        //         } else if (file_type == "Letter") {

        //             $("#reference_no").hide();

        //             $("#letter_no").show();

        //             $("#belt_no").hide();

        //         } else if (file_type == "Application") {

        //             $("#reference_no").hide();

        //             $("#letter_no").hide();

        //             $("#belt_no").show();

        //         } else if (file_type == "Diary") {

        //             $("#reference_no").hide();

        //             $("#letter_no").hide();

        //             $("#belt_no").show();

        //         }

        //     })



        // });



        $(document).ready(function() {

            $('input[name="source"]').change(function() {



                var selectedSource = $(this).val();

                debugger

                $.ajax({

                    url: '{{ route('sections.bySource') }}',

                    type: 'GET',

                    data: {

                        source: selectedSource

                    },

                    success: function(data) {



                        var toSection = $('#to_section');

                        debugger

                        toSection.empty();

                        toSection.append(

                            '<option selected disabled>Select Department</option>');

                        $.each(data.sections, function(index, section) {

                            toSection.append('<option value="' + section.id + '">' +

                                section.name + '</option>');

                        });

                    }

                });

            });

        });

    </script>

@endpush

