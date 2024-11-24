@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Course Setup</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                {{-- ---------------- X -------------------- --}}


                <form action="{{route('admin.course.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Course Name</b></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Type Course Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>SEO URL</b></label>
                        <input type="text" name="seo_url" class="form-control @error('seo_url') is-invalid @enderror" value="{{old('seo_url')}}" placeholder="Type Seo Url">
                        @error('seo_url')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>
                    
                    <!-- <div class="form-group">
                        <label><b>Course Credit</b></label>
                        <input type="text" name="credit" class="form-control @error('credit') is-invalid @enderror" value="{{old('credit')}}" placeholder="Course Credit">
                        @error('credit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div> -->
              
                    <div class="form-group">
                        <label><b>Facality</b></label>
                        <select name="faculity_id" class="form-control">
                                <option value="">--- Select Facality ---</option>
                            @foreach ($faculity as $faculity)
                                <option value="{{$faculity->id}}">{{$faculity->faculity_name}}</option>
                            @endforeach
                          </select>
                        @error('faculity_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    <div class="form-group">
                        <label><b>Category</b></label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{old('category')}}" placeholder="Type Course Name">
                        @error('category')
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
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                    <br><br>
                </form>

            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Facality</th>
                        <th scope="col">Status</th>
                        <th scope="col">Category</th>
                        <th scope="col" colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @foreach ($courses as $key => $item)
                            <tr class="text-center">
                                <td scope="row">{{$item->id}}</th>
                                <td class="text-dark">{{$item->name}}</td>
                                <td class="text-dark">{{!empty($item->facality ) ? $item->facality->faculity_name :''}}</td>
                                <td class="text-dark">{{$item->status}}</td>
                                <td class="text-dark">{{$item->category}}</td>
                                <td>
                                    <a href="{{route('admin.course.edit',$item->id)}}" class="btn btn-success">Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="col-md-1"></div>
        </div>  
    </div>
@endsection

