@extends('layouts.app')

@section('title', 'Modules')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Module Setup</h1>
        </div>
    </div>

    @if(!empty(Auth::user()) && !empty(Auth::user()->role) && (Auth::user()->role == 'Admin' || Auth::user()->role == 'AcademicHead'))
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('admin.module.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><b>Module Code</b></label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code')}}" placeholder="Type Module Code">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Module Name</b></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Type Module Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b> Credit</b></label>
                        <input type="text" name="credit" class="form-control @error('credit') is-invalid @enderror" value="{{old('credit')}}" placeholder="Course Credit">
                        @error('credit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                                        
                    <div class="form-group">
                        <label><b>Description</b></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"  id="" rows="3">{{old('description')}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Courses</b></label>
                        <select name="course_id" class="form-control">
                                <option value="">--- Select Semester ---</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                          </select>
                        @error('course_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Semester</b></label>
                        <select name="semester_id" class="form-control">
                                <option value="">--- Select Semester ---</option>
                            @foreach ($semesters as $semester)
                                <option value="{{$semester->id}}">{{$semester->sem}}</option>
                            @endforeach
                          </select>
                        @error('semester_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Status</b></label>
                        <select name="status" class="form-control">
                            <option value="">--- Select Status ---</option>
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label><b>Type</b></label>
                        <select name="type" class="form-control">
                            <option value="">--- Select Status ---</option>
                            <option value="mandatory">Mandatory</option>
                            <option value="elective">Elective</option>
                        </select>
                        @error('Type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Module Name</th>
                        <th scope="col">Creadit</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if(!empty($modules))
                        @foreach ($modules as $module)
                            <tr class="text-center">
                                <td scope="row">{{$module->id}}</th>
                                <td class="text-dark">{{$module->name}}</td>
                                <td class="text-dark">{{$module->credit}}</td>
                                <td class="text-dark">{{$module->status}}</td>
                                <td>
                                    <a href="{{route('admin.module.edit',$module->id)}}" class="btn btn-success">Edit</a>
                                    @if($module->status === 'draft')
                                    <a href="{{route('admin.module.delete',$module->id)}}" class="btn btn-danger"  onclick="return confirm('Are You Sure to delete ?')">Delete</a>
                                    @else
                                    <a href="javascript:void(0)" class="btn btn-danger" disabled="disabled">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>
            </div>
            <div class="col-md-1"></div>
        </div>  
    </div>
@endsection

