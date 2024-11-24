<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculity extends Model
{
    protected $table = 'faculity';  

    protected $fillable = [
        'faculity_name',
    ];

    public function Courses(){
        return $this->hasMany('\app\Models\Course', 'faculity_id', 'id');
    }
}
