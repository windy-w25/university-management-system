@extends('layouts.app')

@section('title', 'Semester')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Semester Setup</h1>
        </div>
    </div>

    @if(!empty(Auth::user()) && !empty(Auth::user()->role) && Auth::user()->role == 'Admin')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('admin.semester.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Semeter Name</b></label>
                        <input type="text" name="sem" class="form-control" value="{{old('sem')}}" placeholder="Type semester Name">
                        @error('sem')
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
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col">id</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Course</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if(!empty($semester))
                            @foreach ($semester as $semester)
                                <tr class="text-center">
                                    <td scope="row"><a href="{{route('admin.semester.view',$semester->id)}}">{{$semester->id}}</th>
                                    <td class="text-dark">{{$semester->sem}}</td>
                                    <td class="text-dark">{{$semester->course->name}}</td>
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

