<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'professor_id',
        'department_id',
        'level_id'];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
