<?php

namespace App\Repositories;
use App\Models\Faculity;
use App\Models\Courses;
use App\Models\Semester;
use App\Models\Syllabus;
use App\Models\Modules;
use App\Models\Teachers;
use App\Models\Students;
use Exception;

class common_repository
{
    protected $faculity;
    protected $courses;
    protected $semester;
    protected $syllabus;
    protected $module;
    protected $teachers;
    protected $student;

    public function __construct(Faculity $faculity,Courses $courses,Semester $semester,Syllabus $syllabus,Modules $module,Teachers $teachers,Students $student)
    {
        $this->faculity = $faculity;
        $this->courses = $courses;
        $this->semester = $semester;
        $this->syllabus = $syllabus;
        $this->module = $module;
        $this->teachers = $teachers;
        $this->student = $student;
    }

    
    public function getAlldetails($table){
        try {
            return $this->$table->select('*')->get();
        } catch (Exception $exception) {
            dd($exception);
            return 0;
        }
    }

    public function updateOrCreateData($where,$data,$table){
        try {
            return $this->$table->updateOrCreate($where,$data);
        } catch (Exception $exception) {
            dd($exception);
            return 0;
        }
    }

    public function getUniversityData($table,$where,$relations=NULL){
        try {
            return $this->$table->select('*')->where($where)->with($relations)->first();
        } catch (Exception $exception) {
            dd($exception);
            return 0;
        }
    }

    public function DeleteUniversityData($table,$id){
        try {
            return $this->$table->where('id',$id)->delete();
        } catch (Exception $exception) {
            return 0;
        }
    }

    public function getSyllabusData($id){
        try {
            return $this->syllabus->findOrFail($id);
        } catch (Exception $exception) {
            return 0;
        }
    }


}
