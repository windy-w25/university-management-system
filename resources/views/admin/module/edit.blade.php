@extends('layouts.app')

@section('title', 'Modules')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Module Edit</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}

                <form action="{{route('admin.module.update',$module->id)}}" method="post">
                    @csrf

                    
                    <div class="form-group">
                        <label><b>Module Code</b></label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{$module->code}}" placeholder="Type Module Code">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Module Name</b></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$module->name}}" placeholder="Type Department Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label><b> Credit</b></label>
                        <input type="text" name="credit" class="form-control @error('credit') is-invalid @enderror" value="{{$module->credit}}" placeholder="Course Credit">
                        @error('credit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Description</b></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"  id="" rows="3">{{$module->description}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label><b>Courses</b></label>
                        <select name="course_id" class="form-control">
                                <option value="">--- Select Semester ---</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}" {{ $course->id == $module->course_id ? 'selected="selected"' : '' }}>{{$course->name}}</option>
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
                                <option value="{{$semester->id}}" {{ $semester->id == $module->semester_id ? 'selected="selected"' : '' }}>{{$semester->sem}}</option>
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
                            <option value="draft" {{$module->status == 'draft' ? "selected" : "" }}>Draft</option>
                            <option value="publish" {{$module->status == 'publish' ? "selected" : "" }}>Publish</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Update</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection

