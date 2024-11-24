<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\common_service;
use App\Models\Syllabus;


class CourseController extends Controller
{

    protected $common_service;

    public function __construct(common_service $common_service){
        $this->common_service = $common_service;
    }

    public function create()
    {    
        $faculity = $this->common_service->getAlldetails('faculity');
        $courses  = $this->common_service->getAlldetails('courses');
        //dd( $courses->pluck('teachers') );
        return view('admin.course.create',compact('courses','faculity'));

    }

    public function store(Request $request)
    {     
        
        $validator= Validator::make($request->all(),[
            'name'  => 'required|unique:courses,name', 
            'faculity_id'=> 'required', 
            'category'  => 'required', 
            'status'  => 'required', 
            'seo_url'  => 'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $where = ['id' => $request->id];
        $data['name'] = $request->name;
        $data['seo_url'] = $request->seo_url;
        $data['faculity_id'] = $request->faculity_id;
        $data['category'] = $request->category;
        $data['status'] = $request->status;

        $facality = $this->common_service->updateOrCreateData($where,$data,'courses');

        session()->flash('type','success');
        session()->flash('message','Facality Saved Successfully');

        return redirect()->back();

    }

    public function edit($id)
    {
        $faculity = $this->common_service->getAlldetails('faculity');
        $course = $this->common_service->getUniversityData('courses',['id' =>$id],[]);

        if(!empty(Auth::user()) && !empty(Auth::user()->role) && Auth::user()->role == 'AcademicHead'){

            if ($course->status === 'publish') {
                $published_at = \Carbon\Carbon::parse($course->updated_at);
                if ($published_at->diffInHours(now()) > 6) {
                    return back()->withErrors('You cannot edit a module after 6 hours of publishing.');
                }
            }

        }

        return view('admin.course.edit',compact('faculity','course'));
    }

    public function update(Request $request, $id)
    {
        $courses = $this->common_service->getUniversityData('courses',['id' =>$id],[]);

        $where = ['id' => $request->id];
        $data['name'] = $request->name;
        $data['seo_url'] = $request->seo_url;
        $data['faculity_id'] = $request->faculity_id;
        $data['category'] = $request->category;
        $data['status'] = $request->status;

        $this->common_service->updateOrCreateData($where,$data,'courses');

        session()->flash('type','success');
        session()->flash('message','Facality Updated Successfully');
        
        return redirect()->back();
    }

    public function delete($id)
    {
        $faculity = $this->common_service->DeleteUniversityData('courses',$id);

        session()->flash('type','success');
        session()->flash('message','Facality Deleted Successfully');
        
        return redirect()->back();

    }

    public function semesterCreate()
    {
        $courses  = $this->common_service->getAlldetails('courses');
        $semester  = $this->common_service->getAlldetails('semester');

        return view('admin.course.semester',compact('courses','semester'));

    }

    public function semesterStore(Request $request)
    {
        
        $where = ['id' => $request->id];
        $data['sem'] = $request->sem;
        $data['course_id'] = $request->course_id;

        $semester = $this->common_service->updateOrCreateData($where,$data,'semester');

        session()->flash('type','success');
        session()->flash('message','semester Saved Successfully');

        return redirect()->back();

    }

    public function semesterView(Request $request)
    {
        $semester = $this->common_service->getUniversityData('semester',['id' =>$request->id],['module']);

        $mandatoryModules = $semester->module->where('type', 'mandatory');
        $electiveModules = $semester->module->where('type', 'elective');
        $totalMandatoryCredits = $mandatoryModules->sum('credit');
        $totalElectiveCredits = $electiveModules->sum('credit');
        $totalCredits = $semester->module->sum('credit');
      //  dd($semester,$totalMandatoryCredits,$totalElectiveCredits);

        return view('admin.course.semester_view',compact('totalCredits','semester','totalMandatoryCredits','totalElectiveCredits','mandatoryModules','electiveModules'));

    }

    public function syllabusCreate()
    {
        $courses  = $this->common_service->getAlldetails('courses');
        $syllabus  = $this->common_service->getAlldetails('syllabus');

        return view('admin.course.syllabus',compact('courses','syllabus'));

    }

    public function syllabusStore(Request $request)
    {
        
        $where = ['id' => $request->id];
        $data['version'] = $request->version;
        $data['course_id'] = $request->course_id;
        $data['published_at'] = \Carbon\Carbon::now();;

        $semester = $this->common_service->updateOrCreateData($where,$data,'syllabus');

        session()->flash('type','success');
        session()->flash('message','Syllabus Saved Successfully');

        return redirect()->back();

    }

    public function syllabusDuplicate(Request $request)
    {
        

       // $syllabus = $this->common_service->getSyllabusData($request->id);
        // $syllabus = Syllabus::with('module')->findOrFail($request->id);

        $syllabus = Syllabus::where('status','publish')->orderBy('published_at','desc')->with('module')->first();
        if( !$syllabus){
            return  redirect()->back()->with('fail', 'Syllabus duplicated failed.');
        }
        $newSyllabus = $syllabus->replicate();
        $newSyllabus->version = now()->year+1;
        $newSyllabus->status = 'draft';
        $newSyllabus->save();

        foreach ($syllabus->module as $module) {
            $newModule = $module->replicate();
            $newModule->id = $newSyllabus->id;
            $newModule->status = 'draft';
            $newModule->save();
        }

    
        return  redirect()->back()->with('success', 'Syllabus duplicated successfully.');

    }

    
}

