<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\File;

use App\Models\Section;

use App\Models\User;

use App\Models\Category;

use App\Models\FileLog;

use Auth;



class Reportcontroller extends Controller

{

    public function sectionWise(string $type, string $status){

        $data['type'] = $type;

        $data['status'] = $status;

        if(Auth::user()->role == "Super Admin"){

            // return $data;

            $data['pate_title'] = $type .' '. $status;

            if($status == "Created"){

                $data['File'] =  File::with(['fileLog','attachment'])->where('file_type',$type)->whereDoesntHave('files')->get();

            }else{

                $data['File'] =  File::with(['fileLog','attachment'])->where('file_type',$type)->where('status',$status)->whereDoesntHave('files')->get();

            }



            return view('file.my_files',$data);



        }else if(Auth::user()->role == "Admin"){

            $mySections =  Auth::user()->multiSection->pluck('id');





           $data['pate_title'] = $type .' '. $status;

           if($status == "Created"){

               $data['File'] =  File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })->with(['fileLog','attachment'])->where('file_type',$type)->whereDoesntHave('files')->get();

           }else{

               $data['File'] =  File::where(function($query) use ($mySections){

                $query->whereIn('created_by', $mySections)

                ->orWhereIn('current_section', $mySections);

            })->with(['fileLog','attachment'])->where('file_type',$type)->where('status',$status)->whereDoesntHave('files')->get();

           }



           return view('file.my_files',$data);

        }else{

            return "section";

        }



    }



    public function openSearch(Request $request){

        $keyword = $request->input('q');

        if($keyword){

            $data['files'] = File::where(function ($query) use ($keyword) {

                $query->where('reference_no', 'LIKE', "%$keyword%")

                      ->orWhere('letter_no', 'LIKE', "%$keyword%")

                      ->orWhere('belt_no', 'LIKE', "%$keyword%")

                      ->orWhere('name', 'LIKE', "%$keyword%")

                      ->orWhere('flag', 'LIKE', "%$keyword%")

                      ->orWhere('prefix', 'LIKE', "%$keyword%")

                      ->orWhere('file_type', 'LIKE', "%$keyword%")

                      ->orWhere('source', 'LIKE', "%$keyword%")

                      ->orWhere('track_number', 'LIKE', "%$keyword%")

                      ->orWhere('letter_date', 'LIKE', "%$keyword%")

                      ->orWhere('date', 'LIKE', "%$keyword%")

                      ->orWhere('subject', 'LIKE', "%$keyword%")

                      ->orWhere('content', 'LIKE', "%$keyword%")

                      ->orWhere('current_section', 'LIKE', "%$keyword%")

                      ->orWhere('status', 'LIKE', "%$keyword%")

                      ->orWhere('file_no', 'LIKE', "%$keyword%");

                // Add more columns as needed

            })->get();

        }else{

            $data['files'] = [];

        }



        return view('reports.open_search',$data);



    }



    public function reportAdvance(Request $request){

        $from_date = $request->get('from_date');

        $to_date = $request->get('to_date');

        $section = $request->get('section');

        $type = $request->get('type');

        $status = $request->get('status');

        $category = $request->get('category');

        $subject = $request->get('subject');

        $reference_no = $request->get('reference_no');

        $last_desk = $request->get('last_desk');
        $letter_no = $request->get('letter_no');



        $data['category'] = Category::all();

        if(Auth::user()->role == "Super Admin" || Auth::user()->sections->code == "GB"){

            $data['sections'] = Section::all();

            $data['files'] = File::whereDoesntHave('files')

            ->when($from_date, function ($query) use ($from_date, $status) {

                if (isset($status) && $status == "Created") {

                    $query->where('date', '>=', $from_date);

                } else {

                    $query->whereRaw('DATE(updated_at) >= ?', [$from_date]);

                }

            })

            ->when($to_date, function ($query) use ($to_date, $status) {

                if (isset($status) && $status == "Created") {

                    $query->where('date', '<=', $to_date);

                } else {

                    $query->whereRaw('DATE(updated_at) <= ?', [$to_date]);

                }

            })

            ->when($last_desk, function($query) use ($last_desk){

                $query->where('current_section', $last_desk);

            })
            ->when($letter_no,function($query) use ($letter_no){
                $query->where('letter_no',$letter_no);
            })



            ->when($section,function($query) use ($section){

                $query->where('created_section', $section)

                ->orWhere('from_section',$section);

            })

            ->when($type,function($query) use ($type){

                $query->where('file_type', $type);

            })

            ->when($status,function($query) use ($status){

                if($status == "Created"){



                    $query->whereIn('status', ['In Process','In Transit','Dispost']);

                }else{



                    $query->where('status', $status);



                }

            })

            ->when($category,function($query) use ($category){

                $query->where('category_id',$category);

            })

            ->when($subject,function($query) use ($subject){

                $query->where('subject','like','%'.$subject.'%')

                ->orWhere('name','like','%'.$subject.'%');

            })

            ->when($reference_no,function($query) use ($reference_no){

                $query->where('reference_no','like','%'.$reference_no.'%');

            })

            ->get();



        }else if(Auth::user()->role == "Admin"){

            $mySections =  Auth::user()->multiSection->pluck('id');

            $data['sections'] = Section::whereIn('id',$mySections)->get();

            $data['files'] = File::whereDoesntHave('files')->whereIn('current_section',$mySections)

            ->when($from_date, function ($query) use ($from_date, $status) {

                if (isset($status) && $status == "Created") {

                    $query->where('date', '>=', $from_date);

                } else {

                    $query->whereRaw('DATE(updated_at) >= ?', [$from_date]);

                }

            })

            ->when($to_date, function ($query) use ($to_date, $status) {

                if (isset($status) && $status == "Created") {

                    $query->where('date', '<=', $to_date);

                } else {

                    $query->whereRaw('DATE(updated_at) <= ?', [$to_date]);

                }

            })

            ->when($last_desk, function($query) use ($last_desk){

                $query->where('current_section', $last_desk);

            })



            ->when($section,function($query) use ($section){

                $query->where('created_section', $section)

                ->orWhere('from_section',$section);

            })

            ->when($type,function($query) use ($type){

                $query->where('file_type', $type);

            })

            ->when($status,function($query) use ($status){

                if($status == "Created"){



                    $query->whereIn('status', ['In Process','In Transit','Dispost']);

                }else{



                    $query->where('status', $status);



                }

            })

            ->when($category,function($query) use ($category){

                $query->where('category_id',$category);

            })

            ->when($subject,function($query) use ($subject){

                $query->where('subject','like','%'.$subject.'%')

                ->orWhere('name','like','%'.$subject.'%');

            })

            ->when($reference_no,function($query) use ($reference_no){

                $query->where('reference_no','like','%'.$reference_no.'%');

            })

            ->get();



        }else{

            return redirect()->back()->with('error','Acess Not Found');

        }



        return view('reports.advance_report',$data);

    }



    public function sectionPerformance(Request $request){

        if(!Auth::user()->role == "Super Admin" || !Auth::user()->role == "Admin"){

            return redirect()->back()->with('error','You Have Not Permistion To Access This Page');

        }

        if(Auth::user()->role == "Super Admin"){

            $mySections = Section::pluck('id');

        }else{

            $mySections =  Auth::user()->multiSection->pluck('id');





        }







        $performance_list = [];

        foreach ($mySections as  $item) {

            $users_id = User::where('section',$item)->pluck('id');





            $created =  FileLog::

            when($request->duration == "day", function ($query) {

                $query->whereDate('created_at', now()->toDateString());

            })

            ->when($request->duration == "week", function ($query) {

                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);

            })

            ->when($request->duration == "month", function ($query) {

                $query->whereYear('created_at', now()->year)

                      ->whereMonth('created_at', now()->month);

            })

            ->when($request->duration == "year", function ($query) {

                $query->whereYear('created_at', now()->year);

            })

            ->whereIn('created_by',$users_id)->orWhere('to_section',$request->section)->count();





            $complated =  FileLog::

            when($request->duration == "day", function ($query) {

                $query->whereDate('created_at', now()->toDateString());

            })

            ->when($request->duration == "week", function ($query) {

                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);

            })

            ->when($request->duration == "month", function ($query) {

                $query->whereYear('created_at', now()->year)

                      ->whereMonth('created_at', now()->month);

            })

            ->when($request->duration == "year", function ($query) {

                $query->whereYear('created_at', now()->year);

            })

            ->where('from_section',$item)->whereNotNull('to_section')->Orwhere('status','Dispost')->count();

            if($created > 0 ){

                $per =  $complated/$created * 100;

                $per = number_format($per,2);







            }else{

                $per =  0;

            }



            if ($per >= 80) {

                $grade = 'A+';

                $remarks = 'Great';

            } elseif ($per >= 70) {

                $grade = 'A';

                $remarks = 'Best';

            } elseif ($per >= 60) {

                $grade = 'B';

                $remarks = 'Better';

            } elseif ($per >= 50) {

                $grade = 'C';

                $remarks = 'Good';

            }elseif ($per >= 40) {

                $grade = 'D';

                $remarks = 'Satisfactory ';

            } else {

                $grade = 'E';

                $remarks = 'Need to improve';

            }



            $performance =  [

                'created'=>$created,

                'complated'=>$complated,

                'per'=>$per.'%',

                'section'=>Section::where('id',$item)->first()->name,

                'grade'=>$grade,

                'remarks'=>$remarks

            ];









            $performance_list[] = $performance;

        }

         $data['performance_list'] = $performance_list;





        return view('reports.section_performance',$data);

    }



    public  function userPerformance(Request $request){





        $data['sections'] = Section::all();

        if($request->section){

            $data['users'] = User::where('section',$request->section)->get();



        }





        if($request->user){

            $user = User::where('id',$request->user)->first();





                $created =  File::

                when($request->duration == "day", function ($query) {

                    $query->whereDate('created_at', now()->toDateString());

                })

                ->when($request->duration == "week", function ($query) {

                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);

                })

                ->when($request->duration == "month", function ($query) {

                    $query->whereYear('created_at', now()->year)

                          ->whereMonth('created_at', now()->month);

                })

                ->when($request->duration == "year", function ($query) {

                    $query->whereYear('created_at', now()->year);

                })

                ->where('created_by',$user->id)->orWhere('to_section',$user->section)->count();





                $complated =  File::

                when($request->duration == "day", function ($query) {

                    $query->whereDate('created_at', now()->toDateString());

                })

                ->when($request->duration == "week", function ($query) {

                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);

                })

                ->when($request->duration == "month", function ($query) {

                    $query->whereYear('created_at', now()->year)

                          ->whereMonth('created_at', now()->month);

                })

                ->when($request->duration == "year", function ($query) {

                    $query->whereYear('created_at', now()->year);

                })

                ->where('from_section',$user->section)->whereNotNull('to_section')->Orwhere('status','Dispost')->count();

                if($created > 0 ){

                    $per =  $complated/$created * 100;

                    $per = number_format($per,2);







                }else{

                    $per =  0;

                }



                if ($per >= 80) {

                    $grade = 'A+';

                    $remarks = 'Great';

                } elseif ($per >= 70) {

                    $grade = 'A';

                    $remarks = 'Best';

                } elseif ($per >= 60) {

                    $grade = 'B';

                    $remarks = 'Better';

                } elseif ($per >= 50) {

                    $grade = 'C';

                    $remarks = 'Good';

                }elseif ($per >= 40) {

                    $grade = 'D';

                    $remarks = 'Satisfactory ';

                } else {

                    $grade = 'E';

                    $remarks = 'Neet To Impove';

                }



                $performance =  [

                    'created'=>$created,

                    'complated'=>$complated,

                    'per'=>$per.'%',

                    'user'=>$user->name,

                    'grade'=>$grade,

                    'remarks'=>$remarks,

                    'title'=>$user->name .' Of ' .Section::where('id',$user->section)->first()->name ." Performance Evalution Report ",

                ];





           $data['prfamance'] = $performance;

        }



        return view('reports.user_performance',$data);



    }

    public function ReportuserPerformance(Request $request){
        $userId =   $request->userId;
        $type = $request->type;
        $duration = $request->duration;
        $user = User::findOrFail($userId);

        if($type == "Assigned"){
            $data['File'] =  File::

                when($request->duration == "day", function ($query) {

                    $query->whereDate('created_at', now()->toDateString());

                })

                ->when($request->duration == "week", function ($query) {

                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);

                })

                ->when($request->duration == "month", function ($query) {

                    $query->whereYear('created_at', now()->year)

                          ->whereMonth('created_at', now()->month);

                })

                ->when($request->duration == "year", function ($query) {

                    $query->whereYear('created_at', now()->year);

                })

                ->where('created_by',$user->id)->orWhere('to_section',$user->section)->orderBy('created_at', 'desc')->get();
        }

        if($type == "complated"){
            $data['File'] =  File::

            when($request->duration == "day", function ($query) {

                $query->whereDate('created_at', now()->toDateString());

            })

            ->when($request->duration == "week", function ($query) {

                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);

            })

            ->when($request->duration == "month", function ($query) {

                $query->whereYear('created_at', now()->year)

                      ->whereMonth('created_at', now()->month);

            })

            ->when($request->duration == "year", function ($query) {

                $query->whereYear('created_at', now()->year);

            })

            ->where('from_section',$user->section)->whereNotNull('to_section')->Orwhere('status','Dispost')->orderBy('created_at', 'desc')->get();
        }


        $data['pate_title'] = $user->name . " ( ". $user->sections->name ." ) " . $type ."  Files";

        return view('file.my_files',$data);







    }

}

