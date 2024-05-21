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
        'source',
        'category_id',
        'section_id',
        'prefix',
        'flag',
        'file_type',
        'track_number',
        'date',
        'subject',
        'content',
        'current_section',
        'status',
    ];

    public function misterFile()
    {
        return $this->hasOne(MesterFile::class, 'id', 'mester_file_id');
    }

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

    public function initiatedby(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function initiatedbysection(){
        return $this->hasOne(Section::class,'id','created_section');
    }
    public function recentSection(){
        return $this->hasOne(Section::class,'id','current_section');
    }





}
