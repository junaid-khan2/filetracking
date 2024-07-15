@extends('layouts.app', ['page_title' => 'Create Reply'])

@push('style')

    <!-- Dropzone CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">

@endpush

@php

    use SimpleSoftwareIO\QrCode\Facades\QrCode;

@endphp

@section('content')

    <section >

        <div class="container-fluid">

            @include('partials.alerts')

            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">

                        <div class="card-header">

                            {{-- <h3 class="card-title">Letter</h3> --}}

                        </div>

                        <!-- /.card-header -->

                        <!-- form start -->

                        <form action="{{ route('file.store_reply',$File->id) }}" method="POST" enctype="multipart/form-data" name="registration" id="registration">

                            @csrf

                            <div class="card-body">



                                <fieldset class="border px-3">

                                    <legend class="w-auto px-2">Reply Section</legend>



                                    <div class="row">

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Dispatch No <span class="text-danger">*</span></label>

                                                <input type="text"   name="dispatch_no" placeholder="Enter Dispatch No Title"

                                                    id="" class="form-control @error('dispatch_no') is-invalid @enderror">

                                                    @error('dispatch_no')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                    @enderror

                                            </div>

                                        </div>



                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Letter Reference <span class="text-danger">*</span></label>

                                                <input type="text" readonly id="letter_ref" name="letter_ref" class="form-control  @error('letter_ref') is-invalid @enderror" value="{{$File->reference_no}}">



                                                @error('letter_ref')

                                                <div class="invalid-feedback">

                                                    {{ $message }}

                                                </div>

                                                @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Subject <span class="text-danger">*</span></label>

                                                <input type="text" readonly value="{{$File->subject}}" name="subject" placeholder="Enter Subject Title"

                                                    id="" class="form-control @error('subject') is-invalid @enderror">

                                                    @error('subject')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                    @enderror

                                            </div>

                                        </div>

                                        <div class="col-6" >

                                            <div class="form-group">

                                                <label for="input1">Letter Dispatch No <span class="text-danger">*</span></label>

                                                <input type="text" id="letter_no" readonly value="{{$File->letter_no}}" placeholder="Letter No" class="form-control @error('letter_no') is-invalid @enderror"

                                                    name="letter_no">

                                                    @error('letter_no')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                    @enderror

                                            </div>

                                        </div>





                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Reply Date</label>

                                                <input type="date" value="{{date('Y-m-d')}}" class="form-control @error('date') is-invalid @enderror" name="date" id="date">

                                                @error('date')

                                                <div class="invalid-feedback">

                                                    {{ $message }}

                                                </div>

                                                @enderror

                                            </div>

                                        </div>



                                    </div>

                                </fieldset>

                                <fieldset class="border px-3">

                                    <div class="row">



                                        <div class="col-12">

                                            <label for="input1">Brief</label>

                                            <textarea col='20' row='20' name="content" class="form-control " style="height: 138px;" id=""> </textarea>

                                            @error('content')

                                            <div class="invalid-feedback">

                                                {{ $message }}

                                            </div>

                                            @enderror

                                        </div>

                                        <div class="form-group">

                                            <label for="input1">Attachment (jpeg,jpg,png,pdf)</label>

                                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment[]" multiple

                                                id="">

                                                @error('attachment.*')

                                                <div class="invalid-feedback">

                                                    {{ $message }}

                                                </div>

                                                @enderror

                                        </div>

                                    </div>

                                </fieldset>

                                <button type="submit" class="btn btn-primary mt-4">Send <i

                                        class="fa fa-paper-plane"></i></button>

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

        // Add a custom validation method to check file type

        $.validator.addMethod("checkFileType", function(value, element) {

            var fileType = value.split('.').pop().toLowerCase();

            return this.optional(element) || (fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png' || fileType === 'pdf');

        }, "Please upload only JPG, JPEG, PNG, or PDF files.");



        $(document).ready(function() {

            $('#registration').validate({
            rules: {
                dispatch_no: {
                    required: true
                },
                subject: {
                    required: true
                },
                letter_ref: {
                    required: true
                },
                letter_no: {
                    required: true
                },
                date: {
                    required: true
                }
                // Add rules for other fields as needed
            },
            messages: {
                dispatch_no: {
                    required: "Please enter the dispatch number"
                },

                subject: {
                    required: "Please enter the subject"
                },
                date: {
                    required: "Please select the received date"
                },
                letter_ref: {
                    required: "Please select the letter nature"
                },
                letter_no:{
                    required: "Please Select To letter no"
                }
                // Add custom messages for other fields as needed
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });

        });

    </script>





    <script>

        $(function() {

            tinymce.init({
            selector: '#summernote', // Use the ID of the textarea
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
            height: 250,  // set the height of the editor
            menubar: false  // disable the menubar
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



        // $(document).ready(function() {

        //     $('input[name="source"]').change(function() {



        //         var selectedSource = $(this).val();

        //         debugger

        //         $.ajax({

        //             url: '{{ route('sections.bySource') }}',

        //             type: 'GET',

        //             data: {

        //                 source: selectedSource

        //             },

        //             success: function(data) {



        //                 var toSection = $('#to_section');

        //                 debugger

        //                 toSection.empty();

        //                 toSection.append(

        //                 '<option selected disabled>Select Department</option>');

        //                 $.each(data.sections, function(index, section) {

        //                     toSection.append('<option value="' + section.id + '">' +

        //                         section.name + '</option>');

        //                 });

        //             }

        //         });

        //     });

        // });

    </script>

@endpush

