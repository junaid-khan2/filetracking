<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'last_modified_by',
        'file_id',
        'from_section',
        'to_section',
        'date',
        'subject',
        'content',
        'status',
    ];

    public function modifybyLog(){
        return $this->hasOne(User::class,'id','last_modified_by');
    }
}
