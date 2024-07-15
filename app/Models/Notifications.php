<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
       'from_user',
       'to_user',
       'from_section',
       'to_section',
       'title',
       'content',
       'date',
       'is_read',
       'read_timestemp' 
    ];
}
