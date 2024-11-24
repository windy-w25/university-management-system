<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model

{
    protected $table = 'module';  
    
    protected $fillable = [
        'course_id',
        'semester_id',
        'syllabus_id',
        'code',
        'name',
        'description',
        'credit',
        'status',
        'teacher_id',
        'published_at',
    ];

    public function course(){
        return $this->belongsTo('\app\Models\Courses', 'course_id', 'id');
    }

    public function semester(){
        return $this->belongsTo('\app\Models\Semester', 'semester_id', 'id');
    }

    public function scopeMandatory($query)
    {
        return $query->where('type', 'mandatory');
    }

    public function scopeElective($query)
    {
        return $query->where('type', 'elective');
    }

}

