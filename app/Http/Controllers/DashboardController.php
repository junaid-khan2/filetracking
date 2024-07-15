<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\File;
use App\Models\User;

use App\Models\Section;
use Carbon\Carbon;

use Auth;



class DashboardController extends Controller

{

    public function index(){



        // return view('dashboard1');

        if(Auth::user()->role == "Super Admin"){

            // START for weekly BAR Chart
            // Initialize an array to hold daily data for the current week
            $currentWeekData = [
                'labels' => ["","Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",""],
                'files' => [],
                'letters' => [],
                'noteSheets' => [],
                'replies' => [],
            ];

            // Get the start and end dates of the current week
            $startWeekDate = Carbon::now()->startOfWeek();
            $endWeekDate = Carbon::now()->endOfWeek();

            // Loop through each day of the week
            $currentDate = $startWeekDate->copy();
            while ($currentDate->lte($endWeekDate)) {

                // Fetch counts for each file type for the current day
                $filesCount = File::where('file_type', 'File')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->count();

                $lettersCount = File::where('file_type', 'Letter')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->count();

                $noteSheetsCount = File::where('file_type', 'NoteSheet')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->count();

                $repliesCount = File::where('file_type', 'Reply')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->count();

                // Add data to currentWeekData array
                $currentWeekData['files'][] = $filesCount;
                $currentWeekData['letters'][] = $lettersCount;
                $currentWeekData['noteSheets'][] = $noteSheetsCount;
                $currentWeekData['replies'][] = $repliesCount;

                // Move to the next day
                $currentDate->addDay();
            }
            $data['currentWeekData'] =   $currentWeekData;

            $data['currentWeekFiles'] = File::where('file_type', 'File')
           ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
           ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())
           ->count();



            $data['currentWeekLetter'] = File::where('file_type', 'Letter')
            ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
            ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())

            ->count();
            $data['currentWeekNoteSheet'] = File::where('file_type', 'NoteSheet')
            ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
            ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())

            ->count();
            $data['currentWeekReply'] = File::where('file_type', 'Reply')
            ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
            ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())

            ->count();
            // END for weekly BAR Chart

            $data['StatusWiseFiles'] = File::whereDate('created_at',Carbon::today())->get();

            // START For Internal External Chart

            $data['InternalData'] = File::wherehas('initiatedbysection', function($query){
                $query->where('in_out','Internal');
            })

            ->count();
            // $data['ExternalData'] = File::wherehas('initiatedbysection', function($query){
            //     $query->where('in_out','External');
            // })
            // ->count();
             $data['ExternalData'] = 10;

            // END For Internal External Chart


            // START Flag Wise Data
            $data['FlagWise']['Normal'] = File::where('flag','Normal')->orWhereNull('flag')->count();
            $data['FlagWise']['Urgent'] = File::where('flag','Urgent')->count();
            $data['FlagWise']['Immediate'] = File::where('flag','Immediate')->count();
            $data['FlagWise']['MostImmediate'] = File::where('flag','Most Immediate')->count();


            $currentWeekDataDeadline = [
                'labels' => ["1 day", "2 day", "3 day", "4 day", "5 day", "6 day", "7 day", "8 day", "9 day", "10 day", "more than 10"],
                'files' => [],
                'letters' => [],
                'noteSheets' => [],
                'replies' => [],
            ];

            // Loop through each label
            foreach ($currentWeekDataDeadline['labels'] as $index => $label) {
                if ($index == 10) {
                    $filesCount = File::where('file_type', 'File')
                        ->where('dead_line', 'like', '%more than 10%') // Adjust for 'more than 10' condition
                        ->count();

                    $lettersCount = File::where('file_type', 'Letter')
                        ->where('dead_line', 'like', '%more than 10%')
                        ->count();

                    $noteSheetsCount = File::where('file_type', 'NoteSheet')
                        ->where('dead_line', 'like', '%more than 10%')
                        ->count();

                    $repliesCount = File::where('file_type', 'Reply')
                        ->where('dead_line', 'like', '%more than 10%')
                        ->count();
                } else {
                    $filesCount = File::where('file_type', 'File')
                        ->where('dead_line', 'like', '%' . ($index + 1) . ' day%') // Adjust for 'x day' condition
                        ->count();

                    $lettersCount = File::where('file_type', 'Letter')
                        ->where('dead_line', 'like', '%' . ($index + 1) . ' day%')
                        ->count();

                    $noteSheetsCount = File::where('file_type', 'NoteSheet')
                        ->where('dead_line', 'like', '%' . ($index + 1) . ' day%')
                        ->count();

                    $repliesCount = File::where('file_type', 'Reply')
                        ->where('dead_line', 'like', '%' . ($index + 1) . ' day%')
                        ->count();
                }

                // Add data to currentWeekData array
                $currentWeekDataDeadline['files'][$index] = $filesCount;
                $currentWeekDataDeadline['letters'][$index] = $lettersCount;
                $currentWeekDataDeadline['noteSheets'][$index] = $noteSheetsCount;
                $currentWeekDataDeadline['replies'][$index] = $repliesCount;
            }

            $data['currentWeekDataDeadline'] = $currentWeekDataDeadline;

            // END Flag Wise Data

            $flagStatus = [   "Most Immediate","Immediate","Urgent","Normal"];
            $fileTypes = ["File", "Letter", "Reply", "NoteSheet"];

            $typeWise = []; // Initialize an empty array

            foreach ($fileTypes as $labelt) {
                foreach ($flagStatus as $label) {
                    if ($label === "Normal") {
                        $count = File::where('file_type', $labelt)
                                     ->where(function ($query) {
                                         $query->where('flag', null)
                                               ->orWhere('flag', 'Normal');
                                     })
                                     ->count();
                    } else {
                        $count = File::where('file_type', $labelt)
                                     ->where('flag', $label)
                                     ->count();
                    }

                    // Store the count in the nested associative array
                    $typeWise[$label][$labelt] = $count;
                }
            }

            $data['typeWise'] = $typeWise;


            $flagStatus1 = [   "Most Immediate","Immediate","Urgent","Normal"];
            $fileTypes1 = ["File", "Letter", "Reply", "NoteSheet"];

            $typeWise1 = []; // Initialize an empty array

            foreach ($flagStatus1 as $label) {
                foreach ($fileTypes1 as $labelt) {
                    if ($label === "Normal") {
                        $count = File::where('file_type', $labelt)
                                     ->where(function ($query) {
                                         $query->where('flag', null)
                                               ->orWhere('flag', 'Normal');
                                     })
                                     ->count();
                    } else {
                        $count = File::where('file_type', $labelt)
                                     ->where('flag', $label)
                                     ->count();
                    }

                    // Store the count in the nested associative array
                    $typeWise1[$labelt][$label] = $count;
                }
            }

            $data['typeWise1'] = $typeWise1;


            $data['top_10_file'] =  File::latest()->take(10)->get();

            $AdminUsers = User::with('multiSection')
            ->where('role', 'Admin')
            ->get();
 
        $fileTypes = ["File", "Letter", "Reply", "NoteSheet"];
        $mysecData1 = [];
 
        foreach ($AdminUsers as $admin) {
            $mysecstions = $admin->multiSection->pluck('id');
 
            foreach ($fileTypes as $type) {
                $data11 = [
                    'adminName' => $admin->name,
                    'type' => $type,
                    'Created' => File::whereIn('created_section', $mysecstions)->where('file_type', $type)->count(),
                    'InTransit' => File::whereIn('current_section', $mysecstions)->where('file_type', $type)->where('status', 'In Transit')->count(),
                    'InProcess' => File::whereIn('current_section', $mysecstions)->where('file_type', $type)->where('status', 'In Process')->count(),
                    'Dispost' => File::whereIn('current_section', $mysecstions)->where('file_type', $type)->where('status', 'Dispost')->count(),
                    'total' => File::whereIn('current_section', $mysecstions)->where('file_type', $type)->count(),
                ];
 
                $mysecData1[] = $data11;
            }
        }
 
        $data['mysecData1'] =  $mysecData1;





            $data['file'] = File::where('file_type', 'File')

            ->count();



            $data['Letter'] = File::where('file_type', 'Letter')

            ->whereDoesntHave('files')

            ->count();



            $data['NoteSheet'] = File::where('file_type', 'NoteSheet')

            ->count();

            $data['Reply'] = File::where('file_type', 'Reply')

            ->count();



            $data['intransitfile'] = File::where('status', 'In Transit')

            ->where('file_type','File')

            ->count();

            $data['intransitletter'] = File::where('status', 'In Transit')

            ->where('file_type','Letter')

            ->whereDoesntHave('files')

            ->count();



            $data['inprocessfile'] = File::where('status', 'In Process')

            ->where('file_type','File')

            ->count();



            $data['inprocessletter'] = File::where('status', 'In Process')

            ->where('file_type','Letter')

            ->whereDoesntHave('files')

            ->count();



            $data['inprocess'] = $data['inprocessfile'] + $data['inprocessletter'];



                $data['dispost'] = File::where('file_type', 'File')->where('status', 'Dispost')

                ->count();





                $data['createdfile'] = File::where('file_type', 'File')->count();

                $data['createdletter'] = File::where('file_type', 'Letter')->whereDoesntHave('files')->count();



        $data['sections'] = Section::withCount([

                'files as transit_count' => function ($query) {

                    $query->where('file_type', 'File');

                    $query->where('status', 'In Transit');

                },

                'files as in_process_count' => function ($query) {

                    $query->where('file_type', 'File');

                    $query->where('status', 'In Process');

                },

                'files as disposed_count' => function ($query) {

                    $query->where('file_type', 'File');

                    $query->where('status', 'Dispost');

                },

                'created_files as created_count' // This will count the created_files

            ])->get();

            //   return $data ;

            return view('dashboard1',$data);





        }else if(Auth::user()->role == "Admin"){





            $mySections =  Auth::user()->multiSection->pluck('id');

            // Initialize an array to hold daily data for the current week
            $currentWeekData = [
                'labels' => ["","Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",""],
                'files' => [],
                'letters' => [],
                'noteSheets' => [],
                'replies' => [],
            ];

            // Get the start and end dates of the current week
            $startWeekDate = Carbon::now()->startOfWeek();
            $endWeekDate = Carbon::now()->endOfWeek();

            // Loop through each day of the week
            $currentDate = $startWeekDate->copy();
            while ($currentDate->lte($endWeekDate)) {

                // Fetch counts for each file type for the current day
                $filesCount = File::where('file_type', 'File')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->whereIn('created_section',$mySections)
                    ->orWhereIn('current_section',$mySections)
                    ->count();

                $lettersCount = File::where('file_type', 'Letter')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->whereIn('created_section',$mySections)
                    ->orWhereIn('current_section',$mySections)
                    ->count();

                $noteSheetsCount = File::where('file_type', 'NoteSheet')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->whereIn('created_section',$mySections)
                    ->orWhereIn('current_section',$mySections)
                    ->count();

                $repliesCount = File::where('file_type', 'Reply')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'))
                    ->whereIn('created_section',$mySections)
                    ->orWhereIn('current_section',$mySections)
                    ->count();

                // Add data to currentWeekData array
                $currentWeekData['files'][] = $filesCount;
                $currentWeekData['letters'][] = $lettersCount;
                $currentWeekData['noteSheets'][] = $noteSheetsCount;
                $currentWeekData['replies'][] = $repliesCount;

                // Move to the next day
                $currentDate->addDay();
            }
            $data['currentWeekData'] =   $currentWeekData;

            $data['currentWeekFiles'] = File::where('file_type', 'File')
           ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
           ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())
           ->whereIn('created_section',$mySections)
           ->orWhereIn('current_section',$mySections)

           ->count();



            $data['currentWeekLetter'] = File::where('file_type', 'Letter')
            ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
            ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())
            ->whereIn('created_section',$mySections)
            ->orWhereIn('current_section',$mySections)

            ->count();
            $data['currentWeekNoteSheet'] = File::where('file_type', 'NoteSheet')
            ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
            ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())
            ->whereIn('created_section',$mySections)
            ->orWhereIn('current_section',$mySections)

            ->count();
            $data['currentWeekReply'] = File::where('file_type', 'Reply')
            ->whereDate('created_at', '>=', Carbon::now()->startOfWeek())
            ->whereDate('created_at', '<=', Carbon::now()->endOfWeek())
            ->whereIn('created_section',$mySections)
            ->orWhereIn('current_section',$mySections)

            ->count();

            $data['file'] = File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })

            ->where('file_type', 'File')

            ->count();



            $data['Letter'] = File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })->where('file_type', 'Letter')

                ->whereDoesntHave('files')

                ->count();

            $data['Reply'] = File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })->where('file_type', 'Reply')

                ->whereDoesntHave('files')

                ->count();



            $data['NoteSheet'] = File::where(function ($query) use ($mySections) {

                $query->whereIn('created_by', $mySections)

                      ->orWhereIn('current_section', $mySections);

            })

            ->where('file_type', 'NoteSheet')

            ->count();





            $data['intransitfile'] = File::where(function ($query) use ($mySections) {

                $query->whereIn('created_by', $mySections)

                      ->orWhereIn('current_section', $mySections);

            })

            ->where('status', 'In Transit')

            ->where('file_type', 'File')

            ->count();



            $data['intransitletter'] = File::where(function ($query) use ($mySections) {

                    $query->whereIn('created_by', $mySections)

                        ->orWhereIn('current_section', $mySections);

                })

                ->where('status', 'In Transit')

                ->where('file_type', 'Letter')

                ->whereDoesntHave('files')

                ->count();





            $data['inprocessfile'] = File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })

                ->where('status', 'In Process')

                ->where('file_type','File')

                ->count();



            $data['inprocessletter'] = File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })->where('status', 'In Process')

                ->where('file_type','Letter')

                ->count();



            // $data['inprocess'] = $data['inprocessfile'] + $data['inprocessletter'];

            $data['inprocess'] = $data['inprocessfile'];



            $data['dispost'] = File::where(function ($query) use ($mySections) {

                $query->whereIn('created_by', $mySections)

                    ->orWhereIn('current_section', $mySections);

            })

            ->where('status', 'Dispost')

            ->count();





            $data['createdfile'] = File::where('file_type', 'File')->whereIn('created_by', $mySections)->count();

            $data['createdletter'] = File::where('file_type', 'File')->whereIn('created_by', $mySections)->count();



           $data['sections'] = Section::withCount([

                'files as transit_count' => function ($query) use ($mySections) {

                    $query->where('status', 'In Transit')

                    ->whereIn('created_by', $mySections);

                },

                'files as in_process_count' => function ($query) use ($mySections) {

                    $query->where('status', 'In Process')

                    ->whereIn('created_by', $mySections);



                },

                'files as disposed_count' => function ($query) use ($mySections) {

                    $query->where('status', 'Dispost')

                    ->whereIn('created_by', $mySections);

                },

                'created_files as created_count' // This will count the created_files

            ])->whereIn('id',$mySections)->get();

            //   return $data['sections'] ;

            return view('dashboard1',$data);



        }else {

            return redirect()->route('mydesk');

        }



    }

    public function files(){

        $data['file'] = File::where('file_type','File')->get();

        return view('superadmin.files',$data);

    }

    public function letters(){

        $data['letter'] = File::where('file_type','Letter')->whereDoesntHave('files')->get();

        return view('superadmin.letter',$data);

    }

    public function notesheet(){

        $data['file'] = File::where('file_type','NoteSheet')->get();

        return view('superadmin.notesheet',$data);

    }

    public function report(Request $request){

        $from_date = $request->get('from_date') ?? date('Y-m-d');

        $to_date = $request->get('to_date') ?? date('Y-m-d');



        $data['file'] = File::where('file_type','File')->count();

        $data['Letter'] = File::where('file_type','Letter')->count();

        $data['Application'] = File::where('file_type','Application')->count();

        $data['Diary'] = File::where('file_type','Diary')->count();

        $data['intransit'] = File::where('status','In Transit')->count();

        $data['inprocess'] = File::where('status','In Process')->count();

        $data['dispost'] = File::where('status','Dispost')->count();

        $data['created'] = File::where('status','Created')->count();



        if(Auth::user()->role == "Admin"){



            $mySections =  Auth::user()->multiSection->pluck('id');



            $data['sections'] = Section::withCount([

                'files as transit_count' => function ($query) use ($from_date, $to_date) {

                    $query->where('status', 'In Transit')

                        ->when($from_date, function ($q) use ($from_date) {

                            $q->where('date', '<=', $from_date);



                        })

                        ->when($to_date, function ($q) use ($to_date) {

                            $q->where('date', '>=', $to_date);

                        });

                },

                'files as in_process_count' => function ($query) use ($from_date, $to_date) {

                    $query->where('status', 'In Process')

                        ->when($from_date, function ($q) use ($from_date) {

                            $q->where('date', '<=', $from_date);

                        })

                        ->when($to_date, function ($q) use ($to_date) {

                            $q->where('date', '>=', $to_date);

                        });

                },

                'files as disposed_count' => function ($query) use ($from_date, $to_date) {

                    $query->where('status', 'Dispost')

                        ->when($from_date, function ($q) use ($from_date) {

                            $q->where('date', '<=', $from_date);

                        })

                        ->when($to_date, function ($q) use ($to_date) {

                            $q->where('date', '>=', $to_date);

                        });

                },

                'created_files as created_count' =>  function ($query) use ($from_date, $to_date) {

                    $query->when($from_date, function($q) use ($from_date){

                        $q->where('date', '>=', $from_date);

                    })->when($to_date,function($q) use ($to_date){



                        $q->where('date', '<=', $to_date);

                    });

                } // This will count the created_files

            ])->whereIn('id', $mySections)->orderBy('created_count', 'DESC')

            ->orderBy('transit_count', 'DESC')

            ->orderBy('in_process_count', 'DESC')

            ->orderBy('disposed_count', 'DESC')->get();



        //   return $data['sections'] ;



        }else{

            $data['sections'] = Section::withCount([

                'files as transit_count' => function ($query) use ($from_date, $to_date) {

                    $query->where('status', 'In Transit')

                        ->when($from_date, function ($q) use ($from_date) {

                            $q->where('date', '<=', $from_date);



                        })

                        ->when($to_date, function ($q) use ($to_date) {

                            $q->where('date', '>=', $to_date);

                        });

                },

                'files as in_process_count' => function ($query) use ($from_date, $to_date) {

                    $query->where('status', 'In Process')

                        ->when($from_date, function ($q) use ($from_date) {

                            $q->where('date', '<=', $from_date);

                        })

                        ->when($to_date, function ($q) use ($to_date) {

                            $q->where('date', '>=', $to_date);

                        });

                },

                'files as disposed_count' => function ($query) use ($from_date, $to_date) {

                    $query->where('status', 'Dispost')

                        ->when($from_date, function ($q) use ($from_date) {

                            $q->where('date', '<=', $from_date);

                        })

                        ->when($to_date, function ($q) use ($to_date) {

                            $q->where('date', '>=', $to_date);

                        });

                },

                'created_files as created_count' =>  function ($query) use ($from_date, $to_date) {

                    $query->when($from_date, function($q) use ($from_date){

                        $q->where('date', '>=', $from_date);

                    })->when($to_date,function($q) use ($to_date){



                        $q->where('date', '<=', $to_date);

                    });

                } // This will count the created_files

            ])->orderBy('created_count', 'DESC')

                ->orderBy('transit_count', 'DESC')

                ->orderBy('in_process_count', 'DESC')

                ->orderBy('disposed_count', 'DESC')

                ->get();

        }





        //   return $data['sections'] ;

        return view('reports.section_wise_report',$data);

    }



    public function reportSetionType(Request $request, $setion, $type){

        $from_date = $request->get('from_date');

        $to_date = $request->get('to_date');

        if($type == "Created"){

            $data['pate_title'] = "Created Files";

            $data['File'] =  File::with(['fileLog','attachment'])->where('created_section',$setion)

            ->when($from_date,function($q) use ($from_date){

                $q->where('date','>=',$from_date);

            })

            ->when($to_date,function($q) use ($to_date){

                $q->where('date','<=',$to_date);

            })

            ->latest()->get();

        }else if($type == "Completed"){

            $data['pate_title'] = "Completed Files";

            $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',$setion)

            ->when($from_date,function($q) use ($from_date){

                $q->where('date','>=',$from_date);

            })

            ->when($to_date,function($q) use ($to_date){

                $q->where('date','<=',$to_date);

            })->where('status',"Dispost")->latest()->get();

        }

        else{

            $data['pate_title'] = "In Process Files";

            $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',$setion)

            ->when($from_date,function($q) use ($from_date){

                $q->where('date','>=',$from_date);

            })

            ->when($to_date,function($q) use ($to_date){

                $q->where('date','<=',$to_date);

            })->where('status',$type)->latest()->get();

        }





       return view('reports.single_section',$data);

    }



    public function notifications(){

        $data =  File::whereDoesntHave('files')->where('current_section',Auth::user()->section)->where('status','In Transit')->latest()->get();

       return response()->json($data);

    }

}