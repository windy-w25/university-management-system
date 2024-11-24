@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Course</h1>
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Course Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="seo_url">SEO URL</label>
            <input type="text" name="seo_url" id="seo_url" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="faculty">Faculty</label>
            <input type="text" name="faculty" id="faculty" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
