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
use Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->get();
        $data['created'] = FileLog::where('created_by',Auth::user()->id)->count() ?? 0;
        $data['disposed'] = File::where('current_section',Auth::user()->section)->where('status','Dispost')->count();
        $data['inprocess'] = File::where('current_section',Auth::user()->section)->where('status','In Process')->count();
        $data['intransit'] = File::where('current_section',Auth::user()->section)->where('status','In Transit')->count();
        // return $data;
        return view('mydesk.index',$data);
    }
    public function mydesk()
    {

        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->where('to_section',Auth::user()->section)->get();
        $data['created'] = FileLog::where('created_by',Auth::user()->id)->count() ?? 0;
        $data['disposed'] = File::where('current_section',Auth::user()->section)->where('to_section',Auth::user()->section)->where('status','Dispost')->count();
        $data['inprocess'] = File::where('current_section',Auth::user()->section)->where('to_section',Auth::user()->section)->where('status','In Process')->count();
        $data['intransit'] = File::where('current_section',Auth::user()->section)->where('to_section',Auth::user()->section)->where('status','In Transit')->count();
        // return $data;
        return view('mydesk.index',$data);
    }

    public function fileOutBound(){
        $data['file'] = File::where('file_type','File')->where('created_section', Auth::user()->section)->get();
       return view('mydesk.my_outbound_file',$data);
    }
    public function letterOutBound(){
        $data['letter'] = File::where('file_type','Letter')->where('created_section', Auth::user()->section)->get();
        return view('mydesk.my_outbound_letter',$data);
    }

    public function createlist(){
        $data['pate_title'] = "Created Files";
         $data['File'] =  File::with(['fileLog','attachment'])->where('created_by',Auth::user()->id)->latest()->get();

        return view('file.my_files',$data);
    }
    public function inprocesslist(){
        $data['pate_title'] = "In Process Files";
        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->where('status','In Process')->latest()->get();

        return view('file.my_files',$data);
    }
    public function disposedlist(){
        $data['pate_title'] = "Completed Files";
         $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->where('status','Dispost')->latest()->get();

        return view('file.my_files',$data);
    }

    public function intransit(){
        $data['pate_title'] = "In Transit Files";
        $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',Auth::user()->section)->where('status','In Transit')->latest()->get();

       return view('file.my_files',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = Category::all();
        $data['masterfile'] = MesterFile::all();

        $lastFile = File::where('created_section', Auth::user()->section)
        ->orderBy('id', 'desc')
        ->first();

        $lastNumber = $lastFile ? explode('-', $lastFile->reference_no)[3] : 0;

        $data['reference_no'] = Auth::user()->sections->code
                        . '-'
                        . date('Y-m')
                        . '-'
                        . ($lastNumber + 1);

        if(Auth::user()->sections->code == "GB"){
            $data['section'] = Section::get();
            return view('file.create_letter',$data);
        }
        $data['section'] = Section::where('in_out','Internal')->get();
        return view('file.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return $request;


        $track_number = Auth::user()->sections->code .'-'. date('Y-m').'-'.(Letter::latest()->first()->id ?? 0) + 1; ;

        $files = File::create([
            'created_by'=>Auth::user()->id,
            'created_section'=>Auth::user()->section,
            'mester_file_id'=>1,
            'reference_no'=>$request->reference_no,
            'letter_no'=>$request->letter_no,
            'belt_no'=>$request->belt_no,
            'prefix'=> $prefix,
            'track_number'=>$track_number,
            'flag'=>$request->flag,
            'source'=>$request->source,
            'category_id'=>$request->case_type,
            'section_id'=>$request->to_section,
            'current_section'=>$request->to_section,
            'file_type'=>$request->file_type,
            'date'=>$request->date,
            'subject'=>$request->subject,
            'content'=>$request->content,
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
            'file_id'=> $files->id,
            'from_section'=>Auth::user()->section,
            'to_section'=>$request->to_section,
            'date'=>$request->date,
            'content'=>"Please Check",
        ]);
        // return $request;
        return redirect()->route('file.index');
    }

    public function letter_store(Request $request){
        // return $request;


        $track_number = Auth::user()->sections->code .'-'. date('Y-m').'-'.(File::latest()->first()->id ?? 0) + 1; ;

        $files = File::create([
            'created_by'=>Auth::user()->id,
            'created_section'=>Auth::user()->section,
            'from_section'=>$request->from_section,
            'to_section'=>$request->to_section,
            'reference_no'=>$request->reference_no,
            'letter_no'=>$request->letter_no,
            'belt_no'=>$request->belt_no,
            'track_number'=>$track_number,
            'flag'=>$request->flag,
            'name'=>$request->name,
            'source'=>$request->source,
            'category_id'=>$request->case_type,
            'current_section'=>$request->to_section,
            'file_type'=>$request->file_type,
            'date'=>$request->date,
            'letter_date'=>$request->letter_date,
            'subject'=>$request->subject,
            'content'=>$request->content,
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
            'file_id'=> $files->id,
            'from_section'=>Auth::user()->section,
            'to_section'=>$request->to_section,
            'date'=>$request->date,
            'content'=>"Please Check",
        ]);
        // return $request;
        return redirect()->route('file.index');
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
        $data = File::where('reference_no',$file_no)->where('file_type','File')->first();
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
