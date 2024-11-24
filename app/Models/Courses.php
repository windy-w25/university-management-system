<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{

    protected $fillable = [
        'name',
        'seo_url',
        'faculity_id',
        'category',
        'status',
    ];

    
    public function facality(){
        return $this->belongsTo('\app\Models\Faculity', 'faculity_id', 'id');
    }

    public function modules(){
        return $this->hasMany('\app\Models\Modules', 'course_id', 'id');
    }

    public function syllabus()
    {
        return $this->hasMany('\app\Models\Syllabus', 'course_id', 'id');
    }

    public function semester(){
        return $this->hasMany('\app\Models\Semester', 'course_id', 'id');
    }

    public function teachers(){
        return $this->hasMany('\app\Models\Teachers', 'course_id', 'id');
    }

    public function student(){
        return $this->hasMany('\app\Models\Student', 'course_id', 'id');
    }

    public function totalCredits()
    {
        return $this->modules()->sum('credit');
    }
}
