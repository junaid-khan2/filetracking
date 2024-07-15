<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'created_section',
        'file_id',
        'letter_id'
        
    ];

    public function initiatedby(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function initiatedbysection(){
        return $this->hasOne(Section::class,'id','created_section');
    }
}
