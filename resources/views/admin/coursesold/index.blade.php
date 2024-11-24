@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Courses</h1>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Create New Course</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Faculty</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->faculty }}</td>
                <td>{{ $course->category }}</td>
                <td>{{ ucfirst($course->status) }}</td>
                <td>
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
