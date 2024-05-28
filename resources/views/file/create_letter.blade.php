@extends('layouts.app', ['page_title' => 'Create Letter'])
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
                            <h3 class="card-title">Letter</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('file.store.letter') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <fieldset class="border px-3">
                                    <legend class="w-auto px-2">Letter Section</legend>

                                    <div class="row">
                                        <input type="hidden" name="file_type" value="Letter">
                                        <input type="hidden" name="source" value="External">
                                        <div class="col-6" id="letter_no">
                                            <div class="form-group">
                                                <label for="input1">Letter No</label>
                                                <input type="text" placeholder="Letter No" class="form-control"
                                                    name="letter_no">
                                            </div>
                                        </div>
                                        <div class="col-6" id="reference_no">
                                            <div class="form-group">
                                                <label for="input1">Reference No</label>
                                                <input type="text" placeholder="Reference No" class="form-control" value="{{$reference_no}}"
                                                    name="reference_no" readonly>
                                            </div>
                                        </div>

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
                                                <label for="input1">Nature Of Case</label>
                                                <select name="case_type" class="form-control"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Case Nature</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">Flag</label>
                                                <select name="flag" class="form-control"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Flag</option>
                                                    <option value="Narmal">Narmal</option>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="Immediate">Immediate</option>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-6" id="name">
                                            <div class="form-group">
                                                <label for="input1">Name</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="name">
                                            </div>
                                        </div>
                                        <div class="col-6" id="belt_no">
                                            <div class="form-group">
                                                <label for="input1">Belt No</label>
                                                <input type="text" class="form-control" placeholder="Belt No"
                                                    name="belt_no">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="no_of_pages">No of Pages</label>
                                                <select name="no_of_pages" class="form-control" aria-label="Default select example">
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
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="dead_line">Dead Line </label>
                                                <select name="dead_line" class="form-control" aria-label="Default select example">
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
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="border px-3">
                                    <legend class="w-auto px-2">Deparment / Office Section</legend>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">From Section</label>
                                                <select name="from_section" class="form-control" id="to_section"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Department</option>
                                                    <!-- Options will be loaded dynamically -->
                                                    @foreach ($section as $item)
                                                        @if ($item->in_out == "External")
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">To Section</label>
                                                <select name="to_section" class="form-control" id="to_section"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Department</option>
                                                    <!-- Options will be loaded dynamically -->
                                                    @foreach ($section as $item)
                                                    @if ($item->in_out == "Internal")
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">Received Date</label>
                                                <input type="date" value="{{date('Y-m-d')}}" class="form-control" name="date" id="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="input1">Letter Date</label>
                                                <input type="date" value="{{date('Y-m-d')}}" class="form-control" name="letter_date" id="">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset class="border px-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label for="input1">Subject</label>
                                                <input type="text" name="subject" placeholder="Enter Subject Title"
                                                    id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="input1">Brief</label>
                                            <textarea name="content" id="summernote">

                                </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="input1">Attachment</label>
                                            <input type="file" class="form-control" name="attachment[]" multiple
                                                id="">
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
