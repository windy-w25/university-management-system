@extends('layouts.app')

@section('title', 'Courses Edit')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Course Edit</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('admin.course.update',$course->id)}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><b>Course Name</b></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$course->name}}" placeholder="Type Department Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>SEO URL</b></label>
                        <input type="text" name="seo_url" class="form-control @error('seo_url') is-invalid @enderror" value="{{$course->seo_url}}" placeholder="Type Seo Url">
                        @error('seo_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <div class="form-group">
                        <label><b>Facality</b></label> 
                          <select name="faculity_id" class="form-control">
                                <option value="">--- Select Facality ---</option>
                            @foreach ($faculity as $faculity)
                                <option value="{{$faculity->id}}" {{ $faculity->id == $course->faculity_id ? 'selected="selected"' : '' }}>{{$faculity->faculity_name}}</option>
                            @endforeach
                          </select>
                        @error('facality_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 

                    </div>

                    <div class="form-group">
                        <label><b>Category</b></label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{$course->category}}" placeholder="Type Course Name">
                        @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label><b>Status</b></label>
                        <select name="status" class="form-control">
                            <option value="">--- Select Status ---</option>
                            <option value="draft" {{$course->status == 'draft' ? "selected" : "" }}>Draft</option>
                            <option value="publish" {{$course->status == 'publish' ? "selected" : "" }}>Publish</option>
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

