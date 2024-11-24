@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
@php  
$syllabi = $student->course->syllabus;
@endphp
<div class="container mx-auto p-6 bg-white shadow rounded">
    <!-- Course Information -->
    <h2 class="text-2xl font-bold mb-4">Course: {{$student->course->name}}</h2>

    <!-- Syllabi -->
    @foreach ($syllabi as $syllabus)
        <div class="mb-6">
            <h3 class="text-xl font-semibold">Syllabus Year: {{ $syllabus->version }}</h3>
            
            <!-- Modules -->
            @if (!empty($syllabus->module))
                <ul class="list-disc list-inside ml-4">
                    @foreach ($syllabus->module as $module)
                        <li>
                            {{ $module->name }} ({{ $module->credit }} Credits) 
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 italic">No Modules (Draft Mode)</p>
            @endif
        </div>
    @endforeach

    <h2 style="margin-top: 50px;text-decoration: double;font-weight: 800;">Student Creadit</h2>

    

</div>
@endsection
