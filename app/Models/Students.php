<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{

    protected $table = 'student'; 
    protected $fillable = [
        'course_id',
        'name',
    ];

    public function course(){
        return $this->belongsTo('\app\Models\Courses', 'course_id', 'id');
    }

    
    public function module(){
        return $this->belongsToMany('\app\Models\Module', 'course_id', 'course_id');
    }

    
}