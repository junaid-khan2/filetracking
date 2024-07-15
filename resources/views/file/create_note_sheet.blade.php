@extends('layouts.app', ['page_title' => 'Create Note Sheet'])

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

                        <form id="NotesheetForm" action="{{ route('file.store_notesheet') }}" method="POST" enctype="multipart/form-data" name="registration">

                            @csrf



                            <div class="card-body">



                                <fieldset class="border px-3">

                                    <legend class="w-auto px-2">Note Sheet Section</legend>



                                    <div class="row">

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Subject *</label>

                                                <input type="text" name="subject" placeholder="Enter Subject Title"

                                                    id="" class="form-control @error('subject') is-invalid @enderror">

                                                    @error('subject')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                    @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Nature Of Case *</label>

                                                <select name="case_type" class="form-control select2  @error('case_type') is-invalid @enderror"

                                                    aria-label="Default select example">

                                                    <option selected disabled>Select Case Nature</option>

                                                    @foreach ($category as $item)

                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>

                                                    @endforeach

                                                </select>

                                                @error('case_type')

                                                <div class="invalid-feedback">

                                                    {{ $message }}

                                                </div>

                                                @enderror

                                            </div>

                                        </div>



                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="file">File</label>

                                                <select name="file" class="form-control @error('file') is-invalid @enderror select2" id="file"

                                                    aria-label="Default select example">

                                                    <option selected  value="">Select File</option>

                                                    <!-- Options will be loaded dynamically -->

                                                    @foreach ($files as $item)

                                                        <option value="{{ $item->id }}">{{ $item->reference_no }}</option>

                                                    @endforeach

                                                </select>

                                                @error('file')

                                                <div class="invalid-feedback">

                                                    {{ $message }}

                                                </div>

                                                @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="date">Creation Date</label>

                                                <input type="date" value="{{date('Y-m-d')}}" class="form-control @error('date') is-invalid @enderror" name="date" id="">

                                                @error('date')

                                                <div class="invalid-feedback">

                                                    {{ $message }}

                                                </div>

                                                @enderror

                                            </div>

                                        </div>





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

                                <button type="submit" class="btn btn-primary mt-4">Create <i

                                        class="fa fa-save"></i></button>

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





        $(document).ready(function() {

            $('#NotesheetForm').validate({
                    rules: {
                        subject: {
                            required: true
                        },
                        case_type: {
                            required: true
                        },
                        date: {
                            required: true
                        },
                        content: {
                            required: true
                        }

                        // Add rules for other fields as needed
                    },
                    messages: {
                        subject: {
                            required: "Please Enter File subject"
                        },
                        case_type: {
                            required: "Please select the Case Type"
                        },
                        date: {
                            required: "Please Select Date"
                        },
                        content: {
                            required: "Please enter the File content"
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

            // Summernote

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

