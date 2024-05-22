<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileLog;
use App\Models\Section;
use App\Models\Attachment;
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
        $data['File'] =  File::with(['fileLog','attachment','initiatedbysection','recentSection'])->where('id',$id)->first();
        $data['section'] = Section::all();
        return view('file.forword',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // return $request;
        $file = File::find($request->file_id)->update([
            'current_section' => $request->section,
            'status'=>"In Transit"
        ]);
        $log = FileLog::create([
            'last_modified_by'=> Auth::user()->id,
            'file_id'=> $request->file_id,
            'from_section'=>$request->from_section,
            'to_section'=>$request->section,
            'content'=>$request->content,
            'date'=>date('Y-m-d'),
            'status'=>"In Transit"
        ]);

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $fileNameToStore = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/attachment'), $fileNameToStore);
                // You can perform database operations here if needed
                $attachment = Attachment::create([
                    'file_log_id'=> $log->id,
                    'path'=> 'uploads/attachment/',
                    'source'=>$fileNameToStore
                ]);
            }
        }

        return redirect()->route('mydesk');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['File'] =  File::with(['misterFile','attachment'])->findOrFail($id);
        $data['FileLog'] = FileLog::where('file_id',$data['File']->id)->with('attachment','from','to')->get();
        $data['created'] = FileLog::where('created_by',Auth::user()->id)->count();
        $data['disposed'] = FileLog::where('last_modified_by',Auth::user()->id)->where('status','Dispost')->count();
        $data['inprocess'] = FileLog::where('last_modified_by',Auth::user()->id)->where('status','In Process')->count();
        $data['intransit'] = FileLog::where('last_modified_by',Auth::user()->id)->where('status','In Transit')->count();
        // return $data;
        return view('file.track',$data);
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
       // return $request;
       $file = File::find($id)->update([
            'status'=>"In Process"
        ]);
        return back();
    }
    public function desposed(string $id)
    {
       // return $request;
       $file = File::find($id)->update([
            'status'=>"Dispost"
        ]);
        return back();
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
