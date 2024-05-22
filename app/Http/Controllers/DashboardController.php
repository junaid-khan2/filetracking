<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Section;

class DashboardController extends Controller
{
    public function index(){
        $data['file'] = File::where('file_type','File')->count();
        $data['Letter'] = File::where('file_type','Letter')->count();
        $data['Application'] = File::where('file_type','Application')->count();
        $data['Diary'] = File::where('file_type','Diary')->count();


        $data['intransit'] = File::where('status','In Transit')->count();
        $data['inprocess'] = File::where('status','In Process')->count();
        $data['dispost'] = File::where('status','Dispost')->count();
        $data['created'] = File::where('status','Created')->count();
      
        $data['sections'] = Section::withCount([
            'files as transit_count' => function ($query) {
                $query->where('status', 'In Transit');
            },
            'files as in_process_count' => function ($query) {
                $query->where('status', 'In Process');
            },
            'files as disposed_count' => function ($query) {
                $query->where('status', 'Disposed');
            },
            'files as created_count'=>function($query){
                $query->where('status','Created');
            }
        ])->get();
        //   return $data;
        return view('index',$data);
    }
}
