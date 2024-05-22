<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ] ;

    public function files(){
        return $this->hasMany(File::class,'current_section','id');
    }

    public function created_files()
    {
        return $this->hasMany(File::class, 'created_section', 'id');
    }
}
