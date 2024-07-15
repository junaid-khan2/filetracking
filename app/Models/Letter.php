<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'created_section',
        'category_id',
        'from_section',
        'to_section',
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
        'no_of_pages',
        'dead_line',
        'status',
    ];

    public function file(){
        return $this->hasMany(File::class,'letter_id','id');
    }
}
