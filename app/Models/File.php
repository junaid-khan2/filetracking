<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileLog;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'created_section',
        'mester_file_id',
        'category_id',
        'section_id',
        'from_section',
        'to_section',
        'letter_id',
        'reference_no',
        'letter_no',
        'belt_no',
        'name',
        'flag',
        'prefix',
        'file_type',
        'source',
        'track_number',
        'letter_date',
        'date',
        'subject',
        'content',
        'current_section',
        'status',
        'file_no',
        'file_name',
        'designation',
    ];


    public function fileLog(){
        return $this->hasMany(FileLog::class,'file_id','id');
    }
    public function attachment(){
        return $this->hasMany(Attachment::class,'file_id','id');
    }

    public function lastLog()
    {
        return $this->fileLog()->latest()->first();
    }

    public function modifyby()
    {
        $lastLog = $this->lastLog();

        if ($lastLog !== null) {
            return $lastLog->modifybyLog;
        } else {
            // Handle the case where there are no logs associated with the file
            return null;
        }
    }

    public function fileDetails(){
        return $this->hasOne(FileDetail::class,'file_id','id');
    }

    public function initiatedby(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function initiatedbysection(){
        return $this->hasOne(Section::class,'id','created_section');
    }
    public function recentSection(){
        return $this->hasOne(Section::class,'id','current_section');
    }

    public function letters()
    {
        return $this->belongsToMany(File::class, FileLetter::class, 'file_id', 'letter_id')->where('file_type', 'letter');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, FileLetter::class, 'letter_id', 'file_id')->where('file_type', 'file');
    }


}
