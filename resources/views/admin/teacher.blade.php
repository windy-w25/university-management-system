@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Teachers Setup</h1>
        </div>
    </div>
    
    @if(!empty(Auth::user()) && !empty(Auth::user()->role) && Auth::user()->role == 'Admin')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('admin.teacher.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Name</b></label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Type Teachers Name">
                        @error('name')
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
                        <th scope="col">teachers Name</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if(!empty($teachers))
                            @foreach ($teachers as $teacher)
                                <tr class="text-center">
                                    <td scope="row"> <a href="{{ route('admin.teacher.view',$teacher->id) }}"> {{$teacher->id}} </a></td>
                                    <td class="text-dark">{{$teacher->name ?? ''}}</td>
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

