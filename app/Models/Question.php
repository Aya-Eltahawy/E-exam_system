<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class
Question extends Model
{
    use HasFactory;

    protected $fillable= [
        'content',
        'correct_answer',
        'difficulty_level',
        'chapter_id',
        'question_type',
        'subject_id',
        'is_training',
    ];

    public function chapter(){
        return $this->belongsTo(Chapter::class);

    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}

//class Chapter extends Model
//{
//    public function questions(){
//        return $this->hasMany(Question::class);
//    }
//}
//
//class Subject extends Model
//{
//    public function questions(){
//        return $this->hasMany(Question::class);
//    }
//}
