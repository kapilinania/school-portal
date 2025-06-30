@extends('layouts.student')

@section('title', 'Student - Dashboard')

@section('content')
 <!-- <div class="mt-4">
                        <h4>Exam Results</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Exam Name</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student->examResults as $result)
                                    <tr>
                                        <td>{{ $result->exam->exam_name }}</td>
                                        <td>
                                            @if($result->exam->teacher)
                                                {{ $result->exam->teacher->subjects->first()->name ?? 'No Subject' }} ({{ $result->exam->teacher->subjects->first()->pivot->section ?? '' }})
                                            @else
                                                {{ 'No Teacher Assigned' }}
                                            @endif
                                        </td>

                                        <td>{{ $result->exam->teacher->name }}</td>
                                        <td>
                                            @if ($result->result_generated)
                                                {{ $result->score }} / {{ $result->exam->total_points }}
                                            @else
                                                {{ __('Result will be updated soon') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> -->




<!-- -----side content goes here ---  -->

                   
<div class="mt-4">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Result</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Resules</li>
                    </ul>
                </div>
            </div>
        </div>

       
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Exams</h3>
                                </div>
                                
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                    <th>Exam Name</th>
                                    <th>Subjects</th>
                                    <th>Teacher</th>
                                    <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($student->examResults as $result)
                                    <tr>
                                        <td>{{ $result->exam->exam_name }}</td>
                                        <td>
                                            @if($result->exam->teacher)
                                                {{ $result->exam->teacher->subjects->first()->name ?? 'No Subject' }} ({{ $result->exam->teacher->subjects->first()->pivot->section ?? '' }})
                                            @else
                                                {{ 'No Teacher Assigned' }}
                                            @endif
                                        </td>
                                        
                                        <td>{{ $result->exam->teacher->name }}</td>
                                        <td>
                                            @if ($result->result_generated)
                                                {{ $result->score }} / {{ $result->exam->total_points }}
                                            @else
                                                {{ __('Result will be updated soon') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection