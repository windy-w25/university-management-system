@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mt-4" style="font-weight: 500;">University Management System - IDM</h1>
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h3>4</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Student</h5>
                    <h3>1500</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

