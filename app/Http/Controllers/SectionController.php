<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\User;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sections'] = Section::all();
        return view('sections.index',$data);
    }

    public function getSectionsBySource(Request $request)
    {
        $source = $request->get('source');
        $sections = Section::where('in_out', $source)->get();
        return response()->json(['sections' => $sections]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $section = Section::create([
            'name'=>$request->name,
            'code'=>$request->code,
            'in_out'=>$request->in_out,
        ]);

        if ($section) {
            return redirect()->route('sections.index')->withSuccess('User Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    public function getUsersBySection(string $id){
        return User::where('section',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['sections'] = Section::findOrFail($id);
        return view('sections.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = Section::findOrFail($id)->update([
            'name'=>$request->name,
            'code'=>$request->code,
            'in_out'=>$request->in_out,
        ]);

        if ($section) {
            return redirect()->route('sections.index')->withSuccess('User Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();
            return redirect()->route('sections.index')->withSuccess('Section deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('sections.index')->withErrors('Error deleting Section: ' . $e->getMessage());
        }
    }
}
