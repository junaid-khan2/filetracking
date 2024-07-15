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

        'letter_id',

        'file_id',

        'from_section',

        'to_section',

        'date',

        'subject',

        'content',

        'status',

    ];



    public function attachment(){

        return $this->hasMany(Attachment::class,'file_log_id','id');

    }



    public function modifybyLog(){

        return $this->hasOne(User::class,'id','last_modified_by');

    }
    public function file(){

        return $this->hasOne(File::class,'id','file_id');

    }



    public function from(){

        return $this->hasOne(Section::class,'id','from_section');

    }

    public function to(){

        return $this->hasOne(Section::class,'id','to_section');

    }

}

