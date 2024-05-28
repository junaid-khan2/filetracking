<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Section;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::with('sections')->get();

        return view('users.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['sections'] = Section::all();
        return view('users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'section'=>$request->section,
        ]);

        if ($user) {
            return redirect()->route('users.index')->withSuccess('User Created Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong');
        }
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
        $data['sections'] = Section::all();
        $data['user'] = User::with('sections')->findOrFail($id);
        return view('users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_old =  User::findOrFail($id);
        if($request->password){
            $password = Hash::make($request->password);
        }else{
            $password = $user_old->password;
        }
        $user = User::findOrFail($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
            'role'=>$request->role,
            'section'=>$request->section,
        ]);

        if ($user) {
            return redirect()->route('users.index')->withSuccess('User Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->withSuccess('User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->withErrors('Error deleting user: ' . $e->getMessage());
        }
    }
}
