<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use App\Models\MesterFile;
use App\Models\File;
use App\Models\FileLog;
use App\Models\Attachment;
use Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['File'] =  File::all();
        return $data;
        return view('mydesk.index');
    }
    public function mydesk()
    {
        $data['File'] =  File::with(['misterFile','fileLog','attachment'])->get();
        $data['created'] = FileLog::where('created_by',Auth::user()->id)->count();
        $data['disposed'] = FileLog::where('last_modified_by',Auth::user()->id)->where('status','Dispost')->count();
        $data['inprocess'] = FileLog::where('last_modified_by',Auth::user()->id)->where('status','In Process')->count();
        $data['intransit'] = FileLog::where('last_modified_by',Auth::user()->id)->where('status','In Transit')->count();
        // return $data;
        return view('mydesk.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = Category::all();
        $data['section'] = Section::all();
        $data['masterfile'] = MesterFile::all();
        return view('file.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $section = Section::where('id',Auth::user()->section)->first();
        $id = File::latest()->first() ?? 0;
        $prefix = $section->code.'-'.$id+1;
        $track_number = $section->code.'-' . date('Y-m') . '-' . $id+1;

        $files = File::create([
            'created_by'=>Auth::user()->id,
            'created_section'=>Auth::user()->section,
            'mester_file_id'=>$request->master_file,
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
            'date'=>$request->date
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
