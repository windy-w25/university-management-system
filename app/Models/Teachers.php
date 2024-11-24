<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{

    protected $table = 'teachers'; 
    protected $fillable = [
        'course_id',
        'name',
    ];

    public function course(){
        return $this->hasMany('\app\Models\Courses', 'id', 'course_id');
    }

    // public function modules() {
    //     return $this->belongsToMany('\app\Models\Module', 'course_id', 'course_id');
    // }
    
}
