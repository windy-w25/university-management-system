<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\common_service;
use Auth;


class ModuleController extends Controller
{

    protected $common_service;

    public function __construct(common_service $common_service){
        $this->common_service = $common_service;
    }

    public function create()
    {    
        $modules  = $this->common_service->getAlldetails('module');
        $courses  = $this->common_service->getAlldetails('courses');
        $semesters  = $this->common_service->getAlldetails('semester');

       // dd( $courses->modules);

        return view('admin.module.create',compact('courses','semesters','modules'));

    }

    public function store(Request $request)
    {     

        $validator= Validator::make($request->all(),[
            'code'  => 'required|unique:module,code',
            'name'  => 'required|unique:module,name', 
            'credit'       => 'required|numeric|min:0.5|max:5', 
            'description'=> 'required', 
            'semester_id'  => 'required', 
            'status'  => 'required',
            'course_id'  => 'required',
            'type' => 'required',
            
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $course = $this->common_service->getUniversityData('courses',['id' =>$request->course_id],[]);

        $currentCredits = $course->totalCredits();
        $newTotalCredits = $currentCredits + $request->credits;

        if ($newTotalCredits > $course->max_credits) {
            return redirect()->back()->withErrors([
                'credits' => "Adding this module exceeds the maximum allowed credits ({$course->max_credits}).",
            ]);
        }

        $where = ['id' => $request->id];
        $data['code'] = $request->code;
        $data['name'] = $request->name;
        $data['credit'] = $request->credit;
        $data['description'] = $request->description;
        $data['semester_id'] = $request->semester_id;
        $data['status'] = $request->status;
        $data['course_id'] = $request->course_id;
        $data['type'] = $request->type;

        $module = $this->common_service->updateOrCreateData($where,$data,'module');

        session()->flash('type','success');
        session()->flash('message','Module Saved Successfully');

        return redirect()->back();

    }

    public function edit($id)
    {
        $courses  = $this->common_service->getAlldetails('courses');
        $semesters  = $this->common_service->getAlldetails('semester');
        $module = $this->common_service->getUniversityData('module',['id' =>$id],[]);

        if(!empty(Auth::user()) && !empty(Auth::user()->role) && Auth::user()->role == 'AcademicHead'){

            if ($module->status === 'publish') {
                $published_at = \Carbon\Carbon::parse($module->updated_at);
                if ($published_at->diffInHours(now()) > 6) {
                    return back()->withErrors('You cannot edit a module after 6 hours of publishing.');
                }
            }

        }

        return view('admin.module.edit',compact('semesters','courses','module'));
    }

    public function update(Request $request, $id)
    {

        $where = ['id' => $request->id];
        $data['code'] = $request->code;
        $data['name'] = $request->name;
        $data['credit'] = $request->credit;
        $data['description'] = $request->description;
        $data['semester_id'] = $request->semester_id;
        $data['status'] = $request->status;
        $data['course_id'] = $request->course_id;
        $data['type'] = $request->type;

        $this->common_service->updateOrCreateData($where,$data,'module');

        session()->flash('type','success');
        session()->flash('message','Module Updated Successfully');
        
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->common_service->DeleteUniversityData('module',$id);

        session()->flash('type','success');
        session()->flash('message','Module Deleted Successfully');
        
        return redirect()->back();

    }
}

