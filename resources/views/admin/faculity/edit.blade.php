@extends('layouts.app')

@section('title', 'Faculity')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Faculity Edit</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{route('admin.faculity.update',$faculity->id)}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><b>Faculity Name</b></label>
                        <input type="text" name="faculity_name" class="form-control" value="{{$faculity->faculity_name}}">
                        @error('faculity_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror 
                    </div>

                    
                    <button type="submit" class="btn btn-primary">Update</button>

                    {{-- --------- Check in Flash Message -------- --}}
                        @include('dashboard.flashMessage.message')
                    {{-- ---------------- X -------------------- --}}
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection