@extends('layouts.app', ['page_title' => 'Register'])
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
                        <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" name="registration">
                            @csrf
                            <div class="card-body">

                                <fieldset class="border px-3">
                                    <legend class="w-auto px-2">Letter Section</legend>

                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">File Type *</label>
                                                <select id="file_type" name="file_type" class="form-control  @error('file_type') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected disabled>Select File Type</option>
                                                    <option value="File">File</option>
                                                    <option value="Letter">Letter</option>
                                                    <option value="NoteSheet">Note Sheet</option>


                                                </select>
                                                @error('file_type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6" id="reference_no">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="input1">Reference No</label>
                                                        <input type="text" placeholder="Reference No" class="form-control @error('reference_no') is-invalid @enderror"
                                                            name="reference_no" readonly value="{{$reference_no}}">
                                                            @error('reference_no')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    {{QrCode::size(100)->generate($reference_no)}}
                                                    <br>
                                                    <span id="reference_no_span">{{$reference_no}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6" id="letter_no">
                                            <div class="form-group">
                                                <label for="input1">Letter No *</label>
                                                <input type="text" placeholder="Letter No" class="form-control @error('letter_no') is-invalid @enderror"
                                                    name="letter_no">
                                                    @error('letter_no')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-6" id="belt_no">
                                            <div class="form-group">
                                                <label for="input1">Belt No</label>
                                                <input type="text" class="form-control @error('belt_no') is-invalid @enderror" placeholder="Belt No"
                                                    name="belt_no">
                                                    @error('belt_no')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div> --}}

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">Flag</label>
                                                <select name="flag" class="form-control @error('flag') is-invalid @enderror"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Flag</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="Immediate">Immediate</option>
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
                                                <label>Source</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" checked type="radio" name="source"
                                                        id="Internal" value="Internal">
                                                    <label class="form-check-label" for="Internal">Internal</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="source"
                                                        id="External" value="External">
                                                    <label class="form-check-label" for="External">External</label>
                                                </div>
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
                                    </div>
                                </fieldset>
                                <fieldset class="border px-3">
                                    <legend class="w-auto px-2">Department / Office Section</legend>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">To Section *</label>
                                                <select name="to_section" class="form-control @error('to_section') is-invalid @enderror select2" id="to_section"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Department</option>
                                                    <!-- Options will be loaded dynamically -->
                                                    @foreach ($section as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('to_section')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">Received Date</label>
                                                <input type="date" value="{{date('Y-m-d')}}" class="form-control @error('date') is-invalid @enderror" name="date" id="">
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
                                        <div class="col-8">
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
                                        <div class="col-12">
                                            <label for="input1">Brief</label>
                                            <textarea name="content" id="summernote"> </textarea>
                                            @error('content')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="input1">Attachment</label>
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
        // Add a custom validation method to check file type
        $.validator.addMethod("checkFileType", function(value, element) {
            var fileType = value.split('.').pop().toLowerCase();
            return this.optional(element) || (fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png' || fileType === 'pdf');
        }, "Please upload only JPG, JPEG, PNG, or PDF files.");

        $(document).ready(function() {
            $("form[name='registration']").validate({
                // Specify validation rules and messages for each field
                rules: {
                    file_type: "required",
                    letter_no: "required",

                    attachment: {
                        required: true,
                        checkFileType: true // Use custom method for attachment validation
                    }
                    // Add more rules for other fields as needed
                },
                messages: {
                    file_type: "Please select a file type",
                    letter_no: "Please enter a letter number",
                    attachment: {
                        required: "Please upload an attachment",
                        checkFileType: "Please upload only JPG, JPEG, PNG, or PDF files." // Custom message for attachment validation
                    }
                    // Add more messages for other fields as needed
                },
                // Specify the error class
                errorClass: "is-invalid",
                 // Specify error placement
                errorPlacement: function(error, element) {
                    // Add red color only to the error messages
                    error.addClass("text-danger");
                    error.insertAfter(element); // Insert error message after the element
                },
                // Highlight invalid fields
                highlight: function(element, errorClass) {
                    $(element).addClass(errorClass);
                },
                // Remove the error message when the field is valid
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                // Handle form submission
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>


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
