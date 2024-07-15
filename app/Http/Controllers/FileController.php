<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Section;

use App\Models\MesterFile;

use App\Models\File;

use App\Models\FileLog;

use App\Models\Attachment;

use App\Models\Letter;

use App\Models\FileLetter;

use App\Models\Reminder;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Auth;



class FileController extends Controller

{

    /**

     * Display a listing of the resource.

     */

    public function index()

    {



        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->whereDoesntHave('files')->orderBy('created_at', 'desc')->get();

        $data['created'] = File::where('created_section', Auth::user()->section)->count() ?? 0;

        $data['disposed'] = File::where('current_section',Auth::user()->section)->where('status','Dispost')->count();

        $data['inprocess'] = File::where('current_section',Auth::user()->section)->where('status','In Process')->count();

        $data['intransit'] = File::where('current_section',Auth::user()->section)->where('status','In Transit')->count();

        // return $data;

        return view('mydesk.index',$data);

    }

    public function mydesk()

    {



        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->whereDoesntHave('files')->orderBy('created_at', 'desc')->get();

        $data['created'] = File::where('created_section', Auth::user()->section)->count() ?? 0;

        $data['disposed'] = File::where('current_section',Auth::user()->section)->where('status','Dispost')->count();

        $data['inprocess'] = File::where('current_section',Auth::user()->section)->where('status','In Process')->count();

        $data['intransit'] = File::where('current_section',Auth::user()->section)->where('status','In Transit')->count();

        // return $data;

        return view('mydesk.index',$data);

    }



    public function fileOutBound(){

        $data['file'] = File::where('file_type','File')->whereNot('current_section',Auth::user()->section)->where('created_section', Auth::user()->section)->orderBy('created_at', 'desc')->get();

       return view('mydesk.my_outbound_file',$data);

    }

    public function letterOutBound(){

        $data['letter'] = File::whereIn('file_type',['Letter','Reminder','Reply'])->whereNot('current_section',Auth::user()->section)->where('created_section', Auth::user()->section)->orderBy('created_at', 'desc')->get();

        return view('mydesk.my_outbound_letter',$data);

    }



    public function createlist(){

        $data['pate_title'] = "Created Files";

        if(Auth::user()->sections->code == "GB"){

            $data['pate_title'] = " Created Letters";

        }

        if(Auth::user()->sections->code == "GB"){

            $data['File'] =  File::with(['fileLog','attachment'])->where('created_section',Auth::user()->section)->orderBy('created_at', 'desc')->get();

        }else{

            $data['File'] =  File::with(['fileLog','attachment'])->where('created_section',Auth::user()->section)->orderBy('created_at', 'desc')->get();

        }





        return view('file.my_files',$data);

    }

    public function inprocesslist(){

        $data['pate_title'] = "In Process Files";

        if(Auth::user()->sections->code == "GB"){

            $data['pate_title'] = " In Process Letters";

        }

        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->where('status','In Process')->orderBy('created_at', 'desc')->get();



        return view('file.my_files',$data);

    }

    public function disposedlist(){

        $data['pate_title'] = "Completed Files";

        if(Auth::user()->sections->code == "GB"){

            $data['pate_title'] = " Completed Letters";

        }

         $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->where('status','Dispost')->orderBy('created_at', 'desc')->get();



        return view('file.my_files',$data);

    }



    public function intransit(){

        $data['pate_title'] = "In Transit Files";

        if(Auth::user()->sections->code == "GB"){

            $data['pate_title'] = " In Transit Letters";

        }

        $data['File'] =  File::with(['fileLog','attachment'])->whereDoesntHave('files')->where('current_section',Auth::user()->section)->where('status','In Transit')->orderBy('created_at', 'desc')->get();

       return view('file.my_files',$data);

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create($type)

    {

        // return $type;



        $data['category'] = Category::all();

        $data['masterfile'] = MesterFile::all();

        $data['section'] = Section::orderBy('name')->get();

        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;

        $data['letters'] = File::whereIn('file_type',['Letter','Reminder','NoteSheet','Reply'])->whereDoesntHave('files')->Where('current_section',Auth::user()->section)->where('status','In Process')->whereDoesntHave('files')->get();

        $data['files'] = File::where('file_type', 'File')
        ->where('status', 'In Process')
        ->where(function($query) {
            $query->where('created_section', Auth::user()->section)
                  ->orWhere(function($query) {
                      $query->where('current_section', Auth::user()->section)
                            ->where('status', 'In Process');
                  });
        })
        ->get();



       $data['letter_ref'] = File::whereIn('file_type',['Letter','Reminder'])->where('created_section', Auth::user()->section)->where('current_section', '!=',Auth::user()->section)->where('status', 'In Process')->get();







        $data['reference_no'] = Auth::user()->sections->code

                        . '/'

                        . date('Y')

                        . '/'

                        . ($lastFile + 1);



        if(Auth::user()->sections->code == "GB"){

            $data['section'] = Section::orderBy('name')->get();

            return view('file.create_letter',$data);

        }

        // $data['section'] = Section::where('in_out','Internal')->orderBy('name')->get();

        // return view('file.create',$data);

        switch ($type) {

            case 'File':

                return view('file.create_file',$data);

                break;

            case 'Letter':

                return view('file.create_letter_1',$data);

                break;

            case 'NoteSheet':

                return view('file.create_note_sheet',$data);

                break;

            case 'Reminder':

                return view('file.create_reminder',$data);

                break;

            default:

                 return redirect()->back();

                break;

        }

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        return $request;

        $validatedData = $request->validate([

            // 'from_section' => 'required',

            'to_section' => 'required',

            'reference_no' => 'required',

            'letter_no' => 'required',

            // 'flag' => 'required',

            'source' => 'required',

            'case_type' => 'required',

            'file_type' => 'required',

            'date' => 'required|date',

            'letter_date' => 'required|date',

            'subject' => 'required',

            'content' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf', // Ensure each attachment is a file and not larger than 10MB

        ],[

            'attachment.*.max' => 'Each attachment must not be larger than 10 megabytes.',

            'attachment.*.mimes' => 'Each attachment must be a JPEG, JPG, PNG, or PDF file.',



        ]);





        // return $request;

        $to_code = Section::where('id',$request->to_section)->first()->code;

        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;









        if($request->file_type == "Letter"){

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1)

            . '/'

            . $to_code;

        }else{

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1);

        }



        $files = File::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'reference_no'=>$request->reference_no,

            'from_section'=>$request->from_section,

            'to_section'=>$request->to_section,

            'letter_no'=>$request->letter_no,

            'belt_no'=>$request->belt_no,

            'track_number'=>$track_number,

            'flag'=>$request->flag,

            'source'=>$request->source,

            'category_id'=>$request->case_type,

            'current_section'=>$request->to_section,

            'file_type'=>$request->file_type,

            'date'=>$request->date,

            'subject'=>$request->subject,

            'content'=>$request->content,

            'track_count'=>$lastFile + 1,

            'status'=>"In Transit",

        ]);





       if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_id'=> $files->id,

                    'path'=> 'uploads/attachment/',

                    'source'=>$fileNameToStore

                ]);

            }

        }



        $log = FileLog::create([

            'created_by'=>Auth::user()->id,

            'last_modified_by'=>Auth::user()->id,

            'file_id'=> $files->id,

            'from_section'=>Auth::user()->section,

            'to_section'=>$request->to_section,

            'date'=>$request->date,

            'content'=>"Please Check",

        ]);

        // return $request;



        return redirect()->route('track.show',$files->id)->with('fileNumber',$file->track_number);

    }



    public function reply(string $id){

        $data['File'] =  File::with(['attachment','letters.fileletter.initiatedbysection'])->findOrFail($id);

        return view('file.create_reply',$data);

    }



    public function store_file(Request $request){



        $validatedData = $request->validate([

            'reference_no' => 'required',

            'letter' => 'required',

            'case_type' => 'required',

            'date' => 'required|date',

            'subject' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf', // Ensure each attachment is a file and not larger than 10MB

        ],[

            'attachment.*.max' => 'Each attachment must not be larger than 10 megabytes.',

            'attachment.*.mimes' => 'Each attachment must be a JPEG, JPG, PNG, or PDF file.',



        ]);







        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;



        $track_number  = Auth::user()->sections->code

        . '/'

        . date('Y')

        . '/'

        .  ($lastFile + 1);



        $files = File::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'reference_no'=>$request->reference_no,

            'track_number'=>$track_number,

            'letter_id'=>$request->letter,

            'category_id'=>$request->case_type,

            'current_section'=>Auth::user()->section,

            'file_type'=>"File",

            'date'=>$request->date,

            'subject'=>$request->subject,

            'name'=>$request->subject,

            'content'=>$request->content,

            'track_count'=>$lastFile + 1,

            'status'=>"In Process",

        ]);



        FileLetter::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'file_id'=> $files->id,

            'letter_id'=>$request->letter,

        ]);





       if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_id'=> $files->id,

                    'path'=> 'uploads/attachment/',

                    'source'=>$fileNameToStore

                ]);

            }

        }



        $log = FileLog::create([

            'created_by'=>Auth::user()->id,

            'file_id'=> $files->id,

            'from_section'=>Auth::user()->section,

            'date'=>$request->date,

            'content'=>'Initiated for your kind consideration',

        ]);

        // return $request;



        return redirect()->route('track.show',$files->id)->with('fileNumber',$files->track_number);;

    }



    public function letter_store(Request $request){

     //  return $request;

        $validatedData = $request->validate([

            'from_section' => 'different:to_section',



            'reference_no' => 'required',

            'letter_no' => 'required',

            'to_section' => Auth::user()->sections->code == "GB" ? 'required' : '',

            'source' => 'required',

            'case_type' => 'required',

            'file_type' => 'required',

            'date' => 'required|date',

            'letter_date' => 'required|date',

            'subject' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf', // Ensure each attachment is a file and not larger than 10MB

        ]);

        // return $request;



        $to_code = Section::where('id',$request->to_section)->first()->code ?? null;




       if(isset($to_code)){
        $lastFile = File::where('created_section', Auth::user()->section)->where('to_section',$request->to_section)

        ->max('track_count') ?? 0;
       }else{
        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;
       }









        if(isset($request->to_section)){

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1)

            . '/'

            . $to_code;



            $status = "In Transit";

        }else{

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1);



            $status = "In Process";

        }


        $files = File::create([

            'created_by'=>Auth::user()->id,

            'last_modify_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'from_section'=>$request->from_section,

            'to_section'=>$request->to_section,

            'reference_no'=>$track_number,

            'letter_no'=>$request->letter_no,

            'belt_no'=>$request->belt_no,

            'track_number'=>$track_number,

            'flag'=>$request->flag,

            'name'=>$request->name,

            'source'=>$request->source,

            'category_id'=>$request->case_type,

            'current_section'=>$request->to_section ?? Auth::user()->section,

            'file_type'=>$request->file_type,

            'date'=>$request->date,

            'letter_date'=>$request->letter_date,

            'subject'=>$request->subject,

            'content'=>$request->content,

            'track_count'=>$lastFile + 1,

            'status'=> $status,

        ]);





       if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_id'=> $files->id,

                    'path'=> 'uploads/attachment/',

                    'source'=>$fileNameToStore

                ]);

            }

        }



        $log = FileLog::create([

            'created_by'=>Auth::user()->id,

            'file_id'=> $files->id,

            'from_section'=>Auth::user()->section,

            'to_section'=>$request->to_section ?? null,

            'date'=>$request->date,

            'content'=>'Initiated for your kind consideration',

        ]);

        // return $request;

        return redirect()->route('file.create',['type'=>'Letter','track_number'=>$files->track_number]);

        // return redirect()->route('file.create',['type'=>'letter','last_file'=>$files->reference_no,'letter_id'=>$files->id])->with('success','Letter Created Successfuly');

    }



    public function store_notesheet(Request $request){


        $validatedData = $request->validate([

            'case_type' => 'required',

            'date' => 'required|date',

            'subject' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf', // Ensure each attachment is a file and not larger than 10MB

        ],[

            'attachment.*.max' => 'Each attachment must not be larger than 10 megabytes.',

            'attachment.*.mimes' => 'Each attachment must be a JPEG, JPG, PNG, or PDF file.',



        ]);







        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;



        $track_number  = Auth::user()->sections->code

        . '/'

        . date('Y')

        . '/'

        .  ($lastFile + 1);



        $files = File::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'reference_no'=>$track_number,

            'track_number'=>$track_number,

            'letter_id'=>$request->file,

            'category_id'=>$request->case_type,

            'current_section'=>Auth::user()->section,

            'file_type'=>"NoteSheet",

            'date'=>$request->date,

            'subject'=>$request->subject,

            'name'=>$request->subject,

            'content'=>$request->content,

            'track_count'=>$lastFile + 1,

            'status'=>"In Process",

        ]);



        if($request->filled('file')){



            FileLetter::create([

                'created_by'=>Auth::user()->id,

                'created_section'=>Auth::user()->section,

                'file_id'=> $request->file,

                'letter_id'=>$files->id,

            ]);

            // FileLetter::create([

            //     'created_by' => Auth::user()->id,

            //     'created_section' => Auth::user()->section,

            //     'file_id' => $request->search_file,

            //     'letter_id' => $request->file_id,

            // ]);

        }







       if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_id'=> $files->id,

                    'path'=> 'uploads/attachment/',

                    'source'=>$fileNameToStore

                ]);

            }

        }





        $log = FileLog::create([

            'created_by'=>Auth::user()->id,

            'file_id'=> $files->id,

            'from_section'=>Auth::user()->section,

            'date'=>$request->date,

            'content'=>"Initiated for your kind consideration",

        ]);

        // return $request;



        return redirect()->route('file.create',['type'=>'NoteSheet','track_number'=>$files->track_number]);
        // return redirect()->route('track.show',$files->id)->with('fileNumber',$files->track_number);;

    }



    public function store_reminder(Request $request){

        $validatedData = $request->validate([

            'letter_ref' => 'required',

            'date' => 'required|date',

            'subject' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf', // Ensure each attachment is a file and not larger than 10MB

        ],[

            'attachment.*.max' => 'Each attachment must not be larger than 10 megabytes.',

            'attachment.*.mimes' => 'Each attachment must be a JPEG, JPG, PNG, or PDF file.',



        ]);





        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;







        if($request->file_type == "Letter"){

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1)

            . '/';

        }else{

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1);

        }



        // return $track_number;

        $parent_letter = File::where('id',$request->letter_ref)->first() ;



        $files = File::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'from_section'=>Auth::user()->section,

            'to_section'=>$parent_letter->current_section,

            'reference_no'=>$track_number,

            'letter_id'=>$request->letter_ref,

            'letter_no'=>$request->letter_no,

            'track_number'=>$track_number,

            'flag'=>$request->flag,

            'name'=>$request->name,

            'source'=>$request->source,

            'category_id'=>$request->case_type,

            'current_section'=>$parent_letter->current_section,

            'file_type'=>"Reminder",

            'date'=>$request->date,

            'subject'=>$request->subject,

            'content'=>$request->content,

            'track_count'=>$lastFile + 1,

            'status'=>"In Transit",

        ]);


        if($request->filled('letter_ref')){



            FileLetter::create([

                'created_by'=>Auth::user()->id,

                'created_section'=>Auth::user()->section,

                'file_id'=> $files->id,

                'letter_id'=>$request->letter_ref,

            ]);
        }





       if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_id'=> $files->id,

                    'path'=> 'uploads/attachment/',

                    'source'=>$fileNameToStore

                ]);

            }

        }



        $log = FileLog::create([

            'created_by'=>Auth::user()->id,

            'file_id'=> $files->id,

            'from_section'=>Auth::user()->section,

            'to_section'=>$parent_letter->current_section,

            'date'=>$request->date,

            'content'=>$request->content,

        ]);





        return redirect()->route('file.create',['type'=>'Reminder','track_number'=>$files->track_number]);





    }



    public function store_reply(Request $request, $id){

        $validatedData = $request->validate([
            'dispatch_no' => 'required',
            'letter_ref' => 'required',

            'date' => 'required|date',

            'subject' => 'required',

            'attachment.*' => 'max:10240|mimes:jpeg,jpg,png,pdf', // Ensure each attachment is a file and not larger than 10MB

        ],[


            'attachment.*.max' => 'Each attachment must not be larger than 10 megabytes.',

            'attachment.*.mimes' => 'Each attachment must be a JPEG, JPG, PNG, or PDF file.',



        ]);





        $lastFile = File::where('created_section', Auth::user()->section)

        ->max('track_count') ?? 0;







        if($request->file_type == "Letter"){

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1)

            . '/';

        }else{

            $track_number  = Auth::user()->sections->code

            . '/'

            . date('Y')

            . '/'

            .  ($lastFile + 1);

        }



        // return $track_number;

        $parent_letter = File::where('id',$id)->first() ;



        $files = File::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'from_section'=>Auth::user()->section,

            'to_section'=>$parent_letter->created_section,

            'reference_no'=>$track_number,

            'letter_id'=>$id,

            'letter_no'=>$request->dispatch_no,

            'track_number'=>$track_number,

            'current_section'=>$parent_letter->created_section,

            'file_type'=>"Reply",

            'date'=>$request->date,

            'subject'=>$request->subject,

            'content'=>$request->content,

            'track_count'=>$lastFile + 1,

            'status'=>"In Transit",

        ]);





       if ($request->hasFile('attachment')) {

            foreach ($request->file('attachment') as $file) {

                $fileNameToStore = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/attachment'), $fileNameToStore);

                // You can perform database operations here if needed

                $attachment = Attachment::create([

                    'file_id'=> $files->id,

                    'path'=> 'uploads/attachment/',

                    'source'=>$fileNameToStore

                ]);

            }

        }





        FileLetter::create([

            'created_by'=>Auth::user()->id,

            'created_section'=>Auth::user()->section,

            'file_id'=>$files->id,

            'letter_id'=>$id

        ]);

        $logForLetter = FileLog::create([

            'created_by'=>Auth::user()->id,

            'file_id'=> $id,

            'from_section'=>Auth::user()->section,


            'date'=>$request->date,
            'subject'=>'Reply',
            'content'=>$request->content,
            'status' => 'In Process'

        ]);



        $log = FileLog::create([

            'created_by'=>Auth::user()->id,

            'file_id'=> $files->id,

            'from_section'=>Auth::user()->section,

            'to_section'=>$parent_letter->created_section,

            'date'=>$request->date,

            'content'=>"Initiated for your kind consideration",

        ]);





        return redirect()->route('mydesk',['type'=>'Reminder','track_number'=>$files->track_number]);

    }



    /**

     * Display the specified resource.

     */

    public function show(string $id)

    {

        //

    }



    // Ajax Search Of File NO

    public function fileNoSearch(Request $request){

        $file_no = $request->get('file_no');

        $data = File::where('reference_no',$file_no)->where('file_type','File')->orderBy('name')->first();

        return response()->json($data);;

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit(string $id)

    {

        //

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

