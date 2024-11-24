@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
@php  
$courses = $teacher->course;
@endphp
<div class="container mx-auto p-6 bg-white shadow rounded">
    <!-- Course Information -->

    <!-- Syllabi -->
    @foreach ($courses as $course)
        <div class="mb-6">
            <h3 class="text-xl font-semibold">Courses: {{ $course->name }}</h3>
            
            <!-- Modules -->
            @if (!empty($course->syllabus))
                <ul class="list-disc list-inside ml-4">
                    @foreach ($course->syllabus as $syllabus)
                        <li>
                            {{ $syllabus->version }} Syllabus
                        </li>
                        @foreach ($syllabus->module as $module)
                        <p>{{ $module->name }} ({{ $module->credit }} Credits) </p>
                        @endforeach
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 italic">No Modules (Draft Mode)</p>
            @endif
        </div>
    @endforeach
</div>
@endsection
