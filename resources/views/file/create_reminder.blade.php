@extends('layouts.app', ['page_title' => 'Create Reminder'])

@push('style')
    <!-- Dropzone CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
@endpush

@php

    use SimpleSoftwareIO\QrCode\Facades\QrCode;

@endphp

@section('content')
    <section>

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

                        <form id="ReminderForm" action="{{ route('file.store_reminder') }}" method="POST"
                            enctype="multipart/form-data" name="registration">

                            @csrf

                            <div class="card-body">



                                <fieldset class="border px-3">

                                    <legend class="w-auto px-2">Reminder Section</legend>



                                    <div class="row">

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Letter Reference <span
                                                        class="text-danger">*</span></label>

                                                <select id="letter_ref" name="letter_ref"
                                                    class="form-control  @error('letter_ref') is-invalid @enderror"
                                                    aria-label="Default select example">



                                                    <option selected disabled>Select Letter</option>

                                                    @foreach ($letter_ref as $item)
                                                        @if ($item->file_type == 'Letter')
                                                            <option value="{{ $item->id }}">{{ $item->reference_no }}
                                                            </option>
                                                        @endif
                                                    @endforeach





                                                </select>

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

                                                <input type="text" name="subject" placeholder="Enter Subject Title"
                                                    id="subject"
                                                    class="form-control @error('subject') is-invalid @enderror">

                                                @error('subject')
                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>
                                                @enderror

                                            </div>

                                        </div>





                                        <div class="col-6" id="letter_no">

                                            <div class="form-group">

                                                <label for="input1">Dispatch No <span class="text-danger">*</span></label>

                                                <input type="text" placeholder="Dispatch No"
                                                    class="form-control @error('letter_no') is-invalid @enderror"
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

                                                <label for="input1">Flag</label>

                                                <select name="flag"
                                                    class="form-control @error('flag') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected disabled>Select Flag</option>

                                                    <option value="Normal">Normal</option>

                                                    <option value="Urgent">Urgent</option>

                                                    <option value="Immediate">Immediate</option>

                                                    <option value="Most Immediate">Most Immediate</option>

                                                </select>

                                                @error('flag')
                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Reminder Date</label>

                                                <input type="date" value="{{ date('Y-m-d') }}"
                                                    class="form-control @error('date') is-invalid @enderror" name="date"
                                                    id="">

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

                                            <input type="file"
                                                class="form-control @error('attachment') is-invalid @enderror"
                                                name="attachment[]" multiple id="">

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
        // Add a custom validation method to check file type

        $.validator.addMethod("checkFileType", function(value, element) {

            var fileType = value.split('.').pop().toLowerCase();

            return this.optional(element) || (fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png' ||
                fileType === 'pdf');

        }, "Please upload only JPG, JPEG, PNG, or PDF files.");





        $(document).ready(function() {
            $("#letter_ref").on("change", function() {
                var ref_letter_no = $(this).val();
                $.ajax({
                    url: "{{ route('track.show', '') }}" + '/' + ref_letter_no,
                    type: "GET",
                    success: function(response) {
                        if (response.subject) {

                            $("#subject").val(response.subject)
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here

                    }
                });

            });
            $('#ReminderForm').validate({
                rules: {
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
                    letter_ref: {
                        required: "Please select the letter ref"
                    },
                    letter_no: {
                        required: "Please Enter Dispatch No"
                    },
                    date: {
                        required: "Please Select Date"
                    },
                    file: {
                        required: "Please Select The File For The NoteSheet"
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
