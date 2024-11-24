<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{

    protected $table = 'semester'; 
    protected $fillable = [
   'sem',
        'course_id'
    ];

    public function course(){
        return $this->belongsTo('\app\Models\Courses', 'course_id', 'id');
    }

    public function module()
    {
        return $this->hasMany('\app\Models\Modules', 'semester_id', 'id');
    }
}

