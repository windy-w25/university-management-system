@extends('layouts.app')

@section('title', 'Semester View')

@section('content')
<div class="container mx-auto p-6 bg-white shadow rounded">
    <!-- Semester Information -->
    <h1 class="text-2xl font-bold mb-4">Semester: {{ $semester->sem }}</h1>

    <!-- Mandatory Modules -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold">Mandatory Modules</h2>
        @if (!empty($mandatoryModules))
            <ul class="list-disc list-inside ml-4">
                @foreach ($mandatoryModules as $module)
                    <li>
                        {{ $module->name }} ({{ $module->credit }} Credits)
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 italic">No Mandatory Modules</p>
        @endif
        <p class="font-semibold mt-2">Total Mandatory Credits: {{ $totalMandatoryCredits }}</p>
    </div>

    <!-- Elective Modules -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold">Elective Modules</h2>
        @if (!empty($electiveModules))
            <ul class="list-disc list-inside ml-4">
                @foreach ($electiveModules as $module)
                    <li>
                        {{ $module->name }} ({{ $module->credit }} Credits)
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 italic">No Elective Modules</p>
        @endif
        <p class="font-semibold mt-2">Total Elective Credits: {{ $totalElectiveCredits }}</p>
    </div>

    <!-- Total Credits -->
    <div class="mt-4">
        <h3 class="text-xl font-bold">Total Credits for Semester: {{ $totalCredits }}</h3>
    </div>
</div>
@endsection
