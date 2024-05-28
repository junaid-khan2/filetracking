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
            'created_files as created_count' // This will count the created_files
        ])->get();
        //   return $data['sections'] ;
        return view('index',$data);
    }
    public function report(){
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
                $query->where('status', 'Dispost');
            },
            'created_files as created_count' // This will count the created_files
        ])->orderBy('created_count', 'DESC')->get();
        //   return $data['sections'] ;
        return view('reports.section_wise_report',$data);
    }

    public function reportSetionType($setion, $type){
        if($type == "Created"){
            $data['pate_title'] = "In Transit Files";
            $data['File'] =  File::with(['fileLog','attachment'])->where('created_section',$setion)->latest()->get();
        }else if($type == "Completed"){
            $data['pate_title'] = "In Transit Files";
            $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',$setion)->where('status',"Dispost")->latest()->get();
        }
        else{
            $data['pate_title'] = "In Transit Files";
            $data['File'] =  File::with(['fileLog','attachment'])->where('current_section',$setion)->where('status',$type)->latest()->get();
        }


       return view('reports.single_section',$data);
    }
}
