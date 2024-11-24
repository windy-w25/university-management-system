@extends('layouts.app')

@section('title', 'Faculity')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Facality Setup</h1>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('admin.faculity.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label><b>Faculity Name</b></label>
                        <input type="text" name="faculity_name" class="form-control" value="{{old('faculity_name')}}" placeholder="Type faculity Name">
                        @error('faculity_name')
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                      <tr class="text-center">
                        <th scope="col">id</th>
                        <th scope="col">Faculity Name</th>
                        <th scope="col" colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @if(!empty($faculity))
                            @foreach ($faculity as $key=>$faculity)
                                <tr class="text-center">
                                    <td scope="row">{{$faculity->id}}</th>
                                    <td class="text-dark">{{$faculity->faculity_name}}</td>
                                    <td>
                                        <a href="{{route('admin.faculity.edit',$faculity->id)}}" class="btn btn-success">Edit</a>
                                        <a href="{{route('admin.faculity.delete',$faculity->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure to delete ?')">Delete</a>
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

