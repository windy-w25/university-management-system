@extends('layouts.app')

@section('title', 'Syllabus')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Syllabus Setup</h1>
        </div>
    </div>

    @if(!empty(Auth::user()) && !empty(Auth::user()->role) && Auth::user()->role == 'Admin')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('admin.syllabus.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Sylabus Name</b></label>
                        <select name="version"  class="form-control">
                        @for ($year = now()->year; $year <= now()->year + 5; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                        @error('version')
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

                    
                    <button type="c" class="btn btn-primary" style="margin-top: 10px;">Save</button>
                    <br><br>

                    {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                    {{-- ---------------- X -------------------- --}}
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            @if(!empty(Auth::user()) && !empty(Auth::user()->role) && (Auth::user()->role == 'Admin' || Auth::user()->role == 'AcademicHead') )
                <div>
                    <a href="{{route('admin.syllabus.duplicate')}}">Duplicate syllabus</a>
                </div>
            @endif
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col">id</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">varsion</th>
                        <th scope="col">Status</th>
                        <!-- <th scope="col">Duplicate Syllabus</th> -->
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if(!empty($syllabus))
                        @php 
                        @endphp
                            @foreach ($syllabus as $syllabus)
                                <tr class="text-center">
                                    <td scope="row">{{$syllabus->id}}</th>
                                    <td class="text-dark">{{$syllabus->course->name}}</td>
                                    <td class="text-dark">{{$syllabus->version}}</td>
                                    <td class="text-dark">{{$syllabus->status}}</td>
                                    
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

