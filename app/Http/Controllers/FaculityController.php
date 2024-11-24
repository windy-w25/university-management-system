<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\common_service;


class FaculityController extends Controller
{

    protected $common_service;

    public function __construct(common_service $common_service){
        $this->common_service = $common_service;
    }

    public function index()
    {     
        $faculity = $this->common_service->getAlldetails('faculity');
        return view('admin.faculity.index',compact('faculity'));

    }

    public function store(Request $request)
    {     
        
        $validator= Validator::make($request->all(),[
            'faculity_name'  => 'required|unique:faculity,faculity_name,'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $where = ['id' => $request->id];
        $data['faculity_name'] = $request->faculity_name;

        $facality = $this->common_service->updateOrCreateData($where,$data,'faculity');

        session()->flash('type','success');
        session()->flash('message','Facality Saved Successfully');

        return redirect()->back();

    }

    public function edit($id)
    {
        $faculity = $this->common_service->getUniversityData('faculity',['id' =>$id],[]);
        return view('admin.faculity.edit',compact('faculity'));
    }

    public function update(Request $request, $id)
    {
        $faculity = $this->common_service->getUniversityData('faculity',['id' =>$id],[]);
        $validator= Validator::make($request->all(),[
            'faculity_name'  => 'required|unique:faculity,faculity_name,'.$faculity->faculity_name 
        ]);

        if($validator->fails())
        {
          //  dd($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $where = ['id' => $request->id];
        $data['faculity_name'] = $request->faculity_name;

        $this->common_service->updateOrCreateData($where,$data,'faculity');

        session()->flash('type','success');
        session()->flash('message','Facality Updated Successfully');
        
        return redirect()->back();
    }

    public function delete($id)
    {
        $faculity = $this->common_service->DeleteUniversityData('faculity',$id);

        session()->flash('type','success');
        session()->flash('message','Facality Deleted Successfully');
        
        return redirect()->back();

    }
}
