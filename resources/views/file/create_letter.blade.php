@extends('layouts.app', ['page_title' => 'Create Letter', 'last_file' => request('last_file'), 'letter_id' => request('letter_id')])

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

                    <div class="card ">

                        <div class="card-header">



                            {{-- <div class="row">

                                <div class="col-12 ">

                                    @if (request('last_file'))

                                    <div class="float-left">

                                        <h6>Last Number</h6>

                                    </div>

                                    <div class="float-right">

                                        {{QrCode::size(100)->generate(request('last_file'))}}

                                        <br>

                                        <span id="reference_no_span">{{request('last_file')}}</span>

                                    </div>

                                    @endif



                                </div>

                            </div> --}}

                        </div>

                        <!-- /.card-header -->

                        <!-- form start -->

                        <form action="{{ route('file.store.letter') }}" id="letterForm" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="card-body">



                                <fieldset class="border px-3">

                                    <legend class="w-auto px-2">Letter Section</legend>



                                    <div class="row">

                                        <input type="hidden" name="file_type" value="Letter">

                                        <input type="hidden" name="source" value="External">

                                        <input type="text" placeholder="Reference No"
                                            class="form-control  @error('reference_no') is-invalid @enderror"
                                            value="{{ $reference_no }}" name="reference_no" id="reference_no_val" hidden
                                            readonly>

                                        <div class="col-6" id="letter_no">

                                            <div class="form-group">

                                                <label for="input1">Dispatch No <span class="text-danger">*</span></label>

                                                <input value="{{ old('letter_no') }}" type="text" require
                                                    placeholder="Letter No"
                                                    class="form-control @error('letter_no') is-invalid @enderror"
                                                    name="letter_no">

                                                @error('letter_no')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>



                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Received Date <span
                                                        class="text-danger">*</span></label>

                                                <input type="date" value="{{ date('Y-m-d') }}"
                                                    class="form-control @error('date') is-invalid @enderror" name="date"
                                                    id="">

                                                @error('date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>



                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Subject <span class="text-danger">*</span></label>

                                                <input type="text" value="{{ old('subject') }}" require name="subject"
                                                    placeholder="Enter Subject Title" id=""
                                                    class="form-control  @error('subject') is-invalid @enderror">

                                                @error('subject')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>





                                        {{-- <div class="col-6" id="reference_no">



                                                <div class="form-group">

                                                    <label for="input1">Reference No <span class="text-danger">*</span></label>

                                                    <input type="text" placeholder="Reference No" class="form-control  @error('reference_no') is-invalid @enderror" value="{{$reference_no}}"

                                                        name="reference_no" id="reference_no_val"  readonly>

                                                        @error('reference_no')

                                                        <div class="invalid-feedback">{{ $message }}</div>

                                                        @enderror

                                                </div>



                                        </div> --}}



                                        {{-- <div class="col-6">

                                                <div class="form-group">

                                                    <label for="input1">Master File</label>

                                                    <select name="master_file" class="form-control" aria-label="Default select example">

                                                        <option selected disabled>Select Master File</option>

                                                        @foreach ($masterfile as $item)

                                                            <option value="{{$item->id}}">{{$item->name}}</option>

                                                        @endforeach

                                                    </select>

                                                </div>

                                            </div> --}}

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Nature Of Case <span
                                                        class="text-danger">*</span></label>

                                                <select name="case_type" require
                                                    class="form-control select2 @error('case_type') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected disabled>Select Case Nature</option>

                                                    @foreach ($category as $item)
                                                        @if (old('case_type') == $item->id)
                                                            <option selected value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach

                                                </select>

                                                @error('case_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>



                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Flag</label>

                                                <select name="flag"
                                                    class="form-control  @error('flag') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected disabled>Select Flag</option>

                                                    <option value="Normal">Normal</option>

                                                    <option value="Urgent">Urgent</option>

                                                    <option value="Immediate">Immediate</option>

                                                    <option value="Most Immediate">Most Immediate</option>

                                                </select>

                                                @error('flag')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>

                                        <!-- <div class="col-6" id="name">

                                                                <div class="form-group">

                                                                    <label for="input1">Name</label>

                                                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Name"

                                                                        name="name">

                                                                        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

                                                                </div>

                                                            </div>

                                                            <div class="col-6" id="belt_no">

                                                                <div class="form-group">

                                                                    <label for="input1">Belt No</label>

                                                                    <input type="text" class="form-control  @error('belt_no') is-invalid @enderror" placeholder="Belt No"

                                                                        name="belt_no">

                                                                        @error('belt_no')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

                                                                </div>

                                                            </div> -->

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="no_of_pages">No of Pages</label>

                                                <select name="no_of_pages"
                                                    class="form-control  @error('no_of_pages') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected disabled>No of Pages</option>

                                                    <option value="1 page">1 page</option>

                                                    <option value="2 page">2 page</option>

                                                    <option value="3 page">3 page</option>

                                                    <option value="4 page">4 page</option>

                                                    <option value="5 page">5 page</option>

                                                    <option value="6 page">6 page</option>

                                                    <option value="7 page">7 page</option>

                                                    <option value="8 page">8 page</option>

                                                    <option value="9 page">9 page</option>

                                                    <option value="10 page">10 page</option>

                                                    <option value="more then 10">more then 10</option>

                                                </select>

                                                @error('no_of_pages')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="dead_line">Dead Line </label>

                                                <select name="dead_line"
                                                    class="form-control  @error('dead_line') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected disabled>Dead Line </option>

                                                    <option value="1 day">1 day</option>

                                                    <option value="2 day">2 day</option>

                                                    <option value="3 day">3 day</option>

                                                    <option value="4 day">4 day</option>

                                                    <option value="5 day">5 day</option>

                                                    <option value="6 day">6 day</option>

                                                    <option value="7 day">7 day</option>

                                                    <option value="8 day">8 day</option>

                                                    <option value="9 day">9 day</option>

                                                    <option value="10 day">10 day</option>

                                                    <option value="more then 10">more then 10</option>

                                                </select>

                                                @error('dead_line')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">Letter Date <span
                                                        class="text-danger">*</span></label>

                                                <input type="date" value="{{ date('Y-m-d') }}"
                                                    class="form-control  @error('letter_date') is-invalid @enderror"
                                                    name="letter_date" id="">

                                                @error('letter_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
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

                                                <label for="input1">From Department </label>

                                                <select name="from_section"
                                                    class="form-control select2  @error('from_section') is-invalid @enderror"
                                                    aria-label="Default select example">

                                                    <option selected value="" disabled>Select Department</option>

                                                    <!-- Options will be loaded dynamically -->

                                                    @foreach ($section as $item)
                                                        @if ($item->in_out == 'External')
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach

                                                </select>

                                                @error('from_section')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">

                                                <label for="input1">To Section <span
                                                        class="text-danger">*</span></label>

                                                <select name="to_section" require
                                                    class="form-control select2 @error('to_section') is-invalid @enderror"
                                                    id="to_section1" aria-label="Default select example">

                                                    <option selected disabled>Select Department</option>

                                                    <!-- Options will be loaded dynamically -->

                                                    @foreach ($section as $item)
                                                        @if ($item->in_out == 'Internal')
                                                            <option code="{{ $item->code }}"
                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>

                                                @error('to_section')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror

                                            </div>

                                        </div>









                                    </div>

                                </fieldset>

                                <fieldset class="border px-3">

                                    <div class="row">



                                        <div class="col-12">

                                            <label for="input1">Brief </label>


                                            <textarea col='20' row='20' name="content" class="form-control " style="height: 138px;"
                                                id=""> </textarea>
                                            @error('content')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="form-group">

                                            <label for="input1">Attachment (jpeg,jpg,png,pdf)</label>

                                            <input type="file"
                                                class="form-control  @error('attachment') is-invalid @enderror"
                                                name="attachment[]" multiple id="">

                                            @error('attachment')
                                                <div class="invalid-feedback">{{ $message }}</div>
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
        $(function() {

            // Summernote

            //  $('#summernote').summernote()
        })

        $(document).ready(function() {
            tinymce.init({
                selector: '#summernote', // Use the ID of the textarea
                plugins: 'advlist autolink lists link image charmap print preview anchor',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
                height: 250, // set the height of the editor
                menubar: false // disable the menubar
            });
            // Wait for the DOM to be fully loaded

            $("#to_section1").change(function() {

                var dataCode = $(this).find(':selected').attr('code');

                var ref = $("#reference_no_val").val();



                // Split ref by '/'

                var refParts = ref.split('/');



                // Remove the last part (old dataCode)

                refParts.pop();



                // Append the new dataCode

                refParts.push(dataCode);



                // Reconstruct the ref variable

                ref = refParts.join('/');



                // Update the value of #reference_no_val

                $("#reference_no_val").val(ref);





            });

        });


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



    <script>
        $(document).ready(function() {
            $('#lastFileModel').modal('show');
            debugger
            // Initialize Summernote
            // $('#summernote').summernote();

            // Initialize jQuery Validation
            $('#letterForm').validate({
                rules: {
                    letter_no: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    subject: {
                        required: true
                    },
                    case_type: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                    to_section: {
                        required: true
                    },
                    attachment: {
                        // Custom validation using a method
                        required: function(element) {
                            return element.files.length > 0; // Check if at least one file is selected
                        },
                        accept: function(element) {
                            const allowedExtensions = /^(?:image\/(jpeg|png))|(application\/pdf)$/i;
                            const file = element.files[0]; // Get the first selected file

                            if (!file || !allowedExtensions.test(file.type)) {
                                return false; // File is missing or extension is not allowed
                            }

                            return true; // File is valid
                        }
                    }
                },
                messages: {
                    letter_no: {
                        required: "Please enter the letter number"
                    },
                    date: {
                        required: "Please select the received date"
                    },
                    subject: {
                        required: "Please enter the subject"
                    },
                    case_type: {
                        required: "Please select the case nature"
                    },
                    content: {
                        required: "Please enter the letter content"
                    },
                    to_section: {
                        required: "Please Select To Section"
                    },
                    attachment: {
                        required: "Please attach a file (JPEG, PNG, or PDF)",
                        accept: "Only JPEG, PNG, and PDF files are allowed"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.attr('type') === 'file') {
                        element.closest('.form-group').append(error); // For attachment field
                    } else {
                        element.closest('.form-group').find('label').after(error); // For other fields
                    }
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
@endpush
