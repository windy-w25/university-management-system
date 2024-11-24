<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\common_service;


class AdminController extends Controller
{

    protected $common_service;

    public function __construct(common_service $common_service){
        $this->common_service = $common_service;
    }

    public function teacherCreate()
    {
        $courses  = $this->common_service->getAlldetails('courses');
        $teachers  = $this->common_service->getAlldetails('teachers');

        return view('admin.teacher',compact('courses','teachers'));

    }

    public function teacherStore(Request $request)
    {
        
        $where = ['id' => $request->id];
        $data['name'] = $request->name;
        $data['course_id'] = $request->course_id;

        $semester = $this->common_service->updateOrCreateData($where,$data,'teacher');

        session()->flash('type','success');
        session()->flash('message','Teachers Saved Successfully');

        return redirect()->back();

    }


    public function studentCreate()
    {
        $courses  = $this->common_service->getAlldetails('courses');
        $students  = $this->common_service->getAlldetails('student');

        return view('admin.student',compact('courses','students'));

    }

    public function studentStore(Request $request)
    {
        
        $where = ['id' => $request->id];
        $data['name'] = $request->name;
        $data['course_id'] = $request->course_id;

        $semester = $this->common_service->updateOrCreateData($where,$data,'student');

        session()->flash('type','success');
        session()->flash('message','Students Saved Successfully');

        return redirect()->back();

    }

    public function teacherView(Request $request)
    {

        $relations = ['course','course.syllabus'];
        $teacher = $this->common_service->getUniversityData('teachers',['id' =>$request->id],$relations);

        return view('admin.teacher_view',compact('teacher'));
   

    }

    public function studentView(Request $request)
    {

        $relations = ['course','course.syllabus','course.syllabus','course.syllabus.module'];
        $student = $this->common_service->getUniversityData('student',['id' =>$request->id],$relations);
         

        return view('admin.student_view',compact('student'));
   

    }

}
