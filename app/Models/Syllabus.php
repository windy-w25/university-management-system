<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{

    protected $table = 'syllabus'; 
    protected $fillable = [
        'course_id',
        'version',
        'status',
        'published_at',
    ];

    public function course(){
        return $this->belongsTo('\app\Models\Courses', 'course_id', 'id');
    }

    public function module()
    {
        return $this->hasMany('\app\Models\Modules', 'course_id', 'id');
    }
}
