@extends('layouts.app', ['page_title' => 'View History'])

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



    <div class="container-fluid">



        <!-- Timelime example  -->

        <div class="row">



            <div class="col-md-12">
                <div class="timeline">
                    <!-- Timeline items -->
                    @php
                        $timelineItems = [];
                        // Push created event
                        $timelineItems[] = [
                            'type' => 'created',
                            'time' => $File->created_at,
                            'header' => 'Created ' . $File->reference_no,
                            'body' => 'Created By ' . ($File->initiatedbysection->name ?? '') . ' on ' . $File->created_at->format('d F Y') . ' at ' . $File->created_at->format('h:i A'),
                            'footer' => ''
                        ];
                        // Push forwarded events
                        foreach ($FileLog as $item) {
                            if (isset($item->to->name)) {
                                $timelineItems[] = [
                                    'type' => 'forwarded',
                                    'time' => $item->created_at,
                                    'header' => 'Forwarded ' . $File->reference_no,
                                    'body' => 'Forwarded By ' . ($item->from->name ?? '') . ' to ' . ($item->to->name ?? '') . ' on ' . $item->created_at->format('d F Y') . ' at ' . $item->created_at->format('h:i A'),
                                    'footer' => '',
                                ];
                            }
                        }
                        // Push replied events
                        if (!$File->replys->isEmpty()) {
                            foreach ($File->replys as $item) {
                                $timelineItems[] = [
                                    'type' => 'replied',
                                    'time' => $item->created_at,
                                    'header' => 'Replied ' . $File->reference_no,
                                    'body' => 'Replied By ' . ($item->from->name ?? '') . ' to ' . ($item->to->name ?? '') . ' on ' . $item->created_at->format('d F Y') . ' at ' . $item->created_at->format('h:i A'),
                                    'footer' => '',
                                ];
                            }
                        }
                        // Sort timeline items by time
                        usort($timelineItems, function ($a, $b) {
                            return $a['time'] < $b['time'];
                        });

                    @endphp

                    <!-- Render sorted timeline items -->
                    @foreach ($timelineItems as $item)
                        <div>
                            <i class="fas fa-comments bg-green"></i>
                            <div class="timeline-item">
                                <span class="time" style="font-weight: bold; color:black; font-size: 14px;">{{ $item['time']->format('d F Y  |  h:i A') }} <i class="fas fa-clock"></i></span>
                                <h3 class="timeline-header" style="color: #007bff; text-transform: capitalize; font-weight: bold">{{ $item['header'] }}</h3>
                                <div class="timeline-body">{{ $item['body'] }}</div>
                                <div class="timeline-footer">{!! $item['footer'] !!}</div>
                            </div>
                        </div>
                    @endforeach
                    <!-- END timeline item -->

                </div>
            </div>

            <!-- /.col -->


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
