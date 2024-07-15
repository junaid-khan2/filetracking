<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'letter_id',
        'created_by',
        'created_section',
        'letter_no',
        'reference_no',
        'subject',
        'date',
        'content',
        'flag',
        'status',
        'dead_line',
        'track_count',
    ];


}
