<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\File;

use App\Models\FileLog;

use App\Models\Section;

use App\Models\Attachment;

use App\Models\Letter;

use App\Models\FileLetter;

use App\Models\Notifications;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Auth;



class FileMovementController extends Controller

{

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        //

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create($id)

    {

        $data['File'] = File::with(['fileLog', 'attachment', 'initiatedbysection', 'recentSection'])->where('id', $id)->first();

        $lastFile = File::where('created_section', Auth::user()->section)

            ->max('track_count') ?? 0;



        $data['file_no'] = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            . ($lastFile + 1);



            if($data['File']->file_type == "NoteSheet"){

                $data['section'] = Section::where('in_out','Internal')->orderBy('name')->get();
            }else{

                $data['section'] = Section::orderBy('name')->get();
            }

        return view('file.forword', $data);

    }



    /**

     * Store a newly created resource in storage.

     */



    // public function store(Request $request)

    // {



    //     $validatedData = $request->validate([

    //         // 'file_name' => 'required',

    //         // 'section' => 'required'

    //     ]);

    //     $newFile = File::where('reference_no',$request->file_no)->first();

    //     if($request->file_name && $request->file_no){

    //         if(!$request->section){



    //             FileLetter::create([

    //                 'file_id'=> $newFile->id,

    //                 'letter_id'=>File::find($request->file_id)->id

    //             ]);



    //             return redirect()->route('mydesk')->with('success','Letter Attach Successfuly');

    //         }

    //     }



    //     $file = File::find($request->file_id)->update([

    //         'current_section' => $request->section,

    //         'status'=>"In Transit"

    //     ]);

    //     if(!File::where('reference_no',$request->file_no)->first()){

    //         $newFile = File::create([

    //             'created_by'=>Auth::user()->id,

    //             'created_section'=>Auth::user()->section,

    //             'letter_id'=> File::find($request->file_id)->id,

    //             'file_type'=>"File",

    //             'content'=>$request->content,

    //             'file_name'=>$request->file_name,

    //             'file_no'=>$request->file_no,

    //             'from_section'=>$request->from_section,

    //             'to_section'=>$request->section,

    //             'track_number'=>$request->file_no,

    //             'reference_no'=>$request->file_no,

    //             'name'=>$request->file_name,

    //             'current_section' => $request->section,

    //             'status'=>"In Transit"

    //         ]);



    //         FileLetter::create([

    //             'file_id'=> $newFile->id,

    //             'letter_id'=>File::find($request->file_id)->id

    //         ]);





    //     }else{

    //        if($request->file_name && $request->file_no){

    //         $newFile = File::where('reference_no',$request->file_no)->first();

    //         $updateFile = $newFile->update([

    //             'current_section' => $request->section,

    //             'status'=>"In Transit"

    //         ]);

    //         FileLetter::create([

    //             'file_id'=> $newFile->id,

    //             'letter_id'=>File::find($request->file_id)->id

    //         ]);

    //        }else{

    //         $newFile = File::find($request->file_id);

    //        }

    //     }

    //     $log = FileLog::create([

    //         'last_modified_by'=> Auth::user()->id,

    //         'file_id'=> $newFile->id,

    //         'from_section'=>$request->from_section,

    //         'to_section'=>$request->section,

    //         'content'=>$request->content,

    //         'date'=>date('Y-m-d'),

    //         'status'=>"In Transit"

    //     ]);







    //     if ($request->hasFile('attachment')) {

    //         foreach ($request->file('attachment') as $file) {

    //             $fileNameToStore = time() . '_' . $file->getClientOriginalName();

    //             $file->move(public_path('uploads/attachment'), $fileNameToStore);

    //             // You can perform database operations here if needed

    //             $attachment = Attachment::create([

    //                 'file_log_id'=> $newFile->id,

    //                 'path'=> 'uploads/attachment/',

    //                 'source'=>$fileNameToStore

    //             ]);

    //         }

    //     }



    //     return redirect()->route('mydesk');





    // }





    public function store(Request $request)

    {



        $validatedData = $request->validate([

            'file_name' => 'required',

            // 'section' => 'required'

        ]);









        $newFile = File::create([

            'created_by' => Auth::user()->id,

            'created_section' => Auth::user()->section,

            'letter_id' => File::find($request->file_id)->id,

            'file_type' => "File",

            'content' => $request->content,

            'file_name' => $request->file_name,

            'file_no' => $request->file_no,

            'from_section' => $request->from_section,

            'to_section' => $request->from_section,

            'track_number' => $request->file_no,

            'reference_no' => $request->file_no,

            'name' => $request->file_name,

            'current_section' => $request->from_section,

            'status' => "In Process"

        ]);



        $log = FileLog::create([

            'last_modified_by' => Auth::user()->id,

            'file_id' => $newFile->id,

            'from_section' => $request->from_section,

            'to_section' => $request->from_section,

            'content' => $request->content,

            'date' => date('Y-m-d'),

            'status' => "In Process"

        ]);







        if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_log_id' => $newFile->id,

                    'path' => 'uploads/attachment/',

                    'source' => $fileNameToStore

                ]);

            }

        }



        return redirect()->route('mydesk');





    }



    public function attachtofile_post(Request $request)

    {



        $validatedData = $request->validate([

            'search_file' => 'required',

            'file_id' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf',

        ]);



        if ($request->file_id && $request->search_file) {



            FileLetter::create([

                'created_by' => Auth::user()->id,

                'created_section' => Auth::user()->section,

                'file_id' => $request->search_file,

                'letter_id' => $request->file_id,

            ]);



            $log = FileLog::create([

                'created_by' => Auth::user()->id,

                'last_modified_by' => Auth::user()->id,

                'file_id' => $request->search_file,

                'from_section' => Auth::user()->section,

                'content' => $request->content,

                'date' => date('Y-m-d'),

                'status' => "In Process"

            ]);



            if ($request->hasFile('attachment')) {

                foreach ($request->file('attachment') as $file) {

                    $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                    $file->move(public_path('uploads/attachment'), $fileNameToStore);

                    // You can perform database operations here if needed

                    $attachment = Attachment::create([

                        'file_log_id' => $log->id,

                        'path' => 'uploads/attachment/',

                        'source' => $fileNameToStore

                    ]);

                }

            }

        }







        return redirect()->route('mydesk');

    }



    public function forword_post(Request $request)

    {

        $validatedData = $request->validate([



            'section' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf',

        ]);



        $newFile = File::where('id', $request->file_id)->first();

        $file = File::find($request->file_id)->update([

            'current_section' => $request->section,

            'status' => "In Transit"

        ]);



        $log = FileLog::create([

            'last_modified_by' => Auth::user()->id,

            'file_id' => $newFile->id,

            'from_section' => $request->from_section,

            'to_section' => $request->section,

            'content' => $request->content,

            'date' => date('Y-m-d'),


            'status' => "In Transit"

        ]);







        if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_log_id' => $log->id,

                    'path' => 'uploads/attachment/',

                    'source' => $fileNameToStore

                ]);

            }

        }







        return redirect()->route('mydesk');





    }







    /**

     * Display the specified resource.

     */

    public function show(Request $request, string $id)

    {

       $data['File'] = File::with(['attachment', 'letters.fileletter.initiatedbysection', 'replys.initiatedbysection','reminders.initiatedbysection'])->findOrFail($id);

        $data['FileLog'] = FileLog::where('file_id', $data['File']->id)->with('attachment', 'from', 'to')->orderBy('created_at', 'desc')->get();

        $data['created'] = FileLog::where('created_by', Auth::user()->id)->count();

        $data['disposed'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'Dispost')->count();

        $data['inprocess'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'In Process')->count();

        $data['intransit'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'In Transit')->count();

        $data['qrcode'] = QrCode::size(100)->generate($data['File']->reference_no);

        // return $data;

        if($request->ajax()){
             return response()->json($data['File']);
        }

        if ($data['File']->file_type == "Letter") {

            return view('file.letter_track', $data);

        } else if ($data['File']->file_type == "Reply") {

            return view('file.reply_track', $data);

        } else {



            return view('file.file_track', $data);

        }

    }

    public function show_history(Request $request, string $id)

    {

        $data['File'] = File::with(['initiatedbysection','attachment', 'letters.fileletter.initiatedbysection', 'replys.initiatedbysection'])->findOrFail($id);

        $data['FileLog'] = FileLog::where('file_id', $data['File']->id)->with('attachment', 'from', 'to')->orderBy('created_at', 'desc')->get();

        $data['created'] = FileLog::where('created_by', Auth::user()->id)->count();

        $data['disposed'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'Dispost')->count();

        $data['inprocess'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'In Process')->count();

        $data['intransit'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'In Transit')->count();

        $data['qrcode'] = QrCode::size(100)->generate($data['File']->reference_no);

        // return $data;

        if($request->ajax()){
             return response()->json($data['File']);
        }

        return view('file.file_show_history', $data);


    }



    public function attachtofile(string $id)

    {

        $data['File'] = File::with(['fileLog', 'attachment', 'initiatedbysection', 'recentSection'])->where('id', $id)->first();



        $lastFile = File::where('created_section', Auth::user()->section)

            ->max('track_count') ?? 0;

          $data['Files'] = File::where('file_type', 'File')
          ->where('status', 'In Process')
        ->where(function($query) {
            $query->where('created_section', Auth::user()->section)
                  ->orWhere(function($query) {
                      $query->where('current_section', Auth::user()->section)
                            ->where('status', 'In Process');
                  });
        })
        ->get();







        $data['file_no'] = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            . ($lastFile + 1);



        $data['section'] = Section::orderBy('name')->get();

        return view('file.attachtofile', $data);

    }







    public function createfile(string $id)

    {

        $data['File'] = File::with(['fileLog', 'attachment', 'initiatedbysection', 'recentSection'])->where('id', $id)->first();



        $lastFile = File::where('created_section', Auth::user()->section)

            ->max('track_count') ?? 0;



        $data['file_no'] = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            . ($lastFile + 1);



        $data['section'] = Section::orderBy('name')->get();

        return view('file.createfile', $data);

    }



    public function byreference(string $reference)

    {

        $data['File'] = File::with(['attachment', 'letters'])->where('reference_no', $reference)->firstOrFail();

        $data['FileLog'] = FileLog::where('file_id', $data['File']->id)->with('attachment', 'from', 'to')->get();

        $data['created'] = FileLog::where('created_by', Auth::user()->id)->count();

        $data['disposed'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'Dispost')->count();

        $data['inprocess'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'In Process')->count();

        $data['intransit'] = FileLog::where('last_modified_by', Auth::user()->id)->where('status', 'In Transit')->count();

        $data['qrcode'] = QrCode::size(100)->generate($data['File']->reference_no);

        // return $data;

        if ($data['File']->file_type == "Letter") {

            return view('file.letter_track', $data);

        } else {



            return view('file.file_track', $data);

        }

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit(string $id)

    {

        // return $request;

        //    $file = File::find($id)->update([

        //         'status'=>"In Process"

        //     ]);

        //     return back();

    }

    public function inprocess(string $id)

    {

        $files =  File::find($id);
        if($files->status == "Dispost" && $files->file_type != "File"){
            return back()->with('error','Can Not ReProcess '.$files->file_type);
        }


        $file = File::find($id)->update([

            'last_modify_by' => Auth::user()->id,

            'status' => "In Process",

            'current_section' => Auth::user()->section,

        ]);

        return back();

    }

    public function desposed(string $id)

    {

        $data['File'] = File::with(['fileLog', 'attachment', 'initiatedbysection', 'recentSection'])->where('id', $id)->first();

        $data['section'] = Section::all();

        return view('file.dispost', $data);

    }

    public function desposed_store(Request $request, string $id)

    {

        // return $request;

      $filess =  File::with('letters','replys','reminders')->find($id);


        $file = File::find($id)->update([

            'status' => "Dispost"

        ]);

        if($filess){
            if(!$filess->replys->isEmpty()){
                foreach ($filess->replys as $reply) {
                    $logreply = FileLog::create([

                        'last_modified_by' => Auth::user()->id,

                        'file_id' => $reply->id,

                        'from_section' => $request->from_section,

                        'content' => 'Complated due to complation of '.$filess->file_type.' : '.$filess->track_number,

                        'date' => date('Y-m-d'),

                        'subject' => 'Complate',

                        'status' => "Dispost"

                    ]);
                   $reply->status = "Dispost";
                   $reply->save();
                }
            }
            if(!$filess->letters->isEmpty()){

               foreach ($filess->letters as $letter) {
                    $logletter = FileLog::create([

                        'last_modified_by' => Auth::user()->id,

                        'file_id' => $letter->id,

                        'from_section' => $request->from_section,

                        'content' => 'Complated due to complation of '.$filess->file_type.' : '.$filess->track_number,

                        'date' => date('Y-m-d'),

                        'subject' => 'Complate',

                        'status' => "Dispost"

                    ]);

                   $letter->status = "Dispost";
                   $letter->save();
               }
            }
            if(!$filess->reminders->isEmpty()){

                foreach ($filess->reminders as $reminder) {
                     $logletter = FileLog::create([

                         'last_modified_by' => Auth::user()->id,

                         'file_id' => $reminder->id,

                         'from_section' => $request->from_section,

                         'content' => 'Complated due to complation of '.$filess->file_type.' : '.$filess->track_number,

                         'date' => date('Y-m-d'),

                         'subject' => 'Complate',

                         'status' => "Dispost"

                     ]);

                    $reminder->status = "Dispost";
                    $reminder->save();
                }
             }
        }


        $log = FileLog::create([

            'last_modified_by' => Auth::user()->id,

            'file_id' => $request->file_id,

            'from_section' => $request->from_section,

            'content' => $request->content,

            'date' => date('Y-m-d'),

            'subject' => 'Complate',

            'status' => "Dispost"

        ]);



        if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_log_id' => $log->id,

                    'path' => 'uploads/attachment/',

                    'source' => $fileNameToStore

                ]);

            }

        }



        return redirect()->route('mydesk');

    }



    /**

     * Update the specified resource in storage.

     */

    public function update(Request $request, string $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     */

    public function destroy(string $id)

    {

        //

    }

}

