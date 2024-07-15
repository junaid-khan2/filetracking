<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;

class SectionAssignmentController extends Controller
{
    public function index(){
        $data['users'] = User::where('role','Admin')->get();
        return view('users.admin_section',$data);
    }
    public function showAssignForm()
    {
        $users = User::where('role','Admin')->get();
        $sections = Section::all();

        return view('users.assign_section', compact('users', 'sections'));
    }

    public function assignSections(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'section_ids' => 'required|array',
            'section_ids.*' => 'exists:sections,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->multiSection()->syncWithoutDetaching($request->section_ids);

        return redirect()->back()->with('success', 'Sections assigned successfully.');
    }

    public function editSections(User $user)
    {
        $sections = Section::all();
        $users = User::where('role','Admin')->get();
        return view('users.edit-sections', compact('users','user', 'sections'));
    }
    public function updateSections(Request $request, User $user)
    {
        $request->validate([
            'section_ids' => 'required|array',
            'section_ids.*' => 'exists:sections,id',
        ]);

        $user->multiSection()->sync($request->section_ids);

        return redirect()->route('assign.sections.list')->with('success', 'Sections updated successfully.');
    }
}
