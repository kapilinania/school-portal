@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.master')

@section('title', 'Admin- Dashboard')

@section('content')

<style>
    .read-more, .read-less {
        color: blue;
        cursor: pointer;
        text-decoration: underline;
    }
    .dashboard_header a:hover{
        border: 1px solid #3D5EE1;
        border-radius: 15px;
        
    }
</style>


    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">
                            @if (Auth::check())
                                <p>Welcome, {{ Auth::user()->name }}!</p>
                            @endif

                        </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widgets -->
        <div class="row dashboard_header">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card  bg-comman w-100">
                    <a href="{{ route('admin.students.index') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Students</h6>
                                    <h3>{{ $studentCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('admin.teachers.index') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Teacher</h6>
                                    <h3>{{ $teacherCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/dash-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('admin.sections.index') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Classes</h6>
                                    <h3>{{ $sectionCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/dash-icon-03.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <a href="{{ route('admin.subjects.index') }}">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Subject</h6>
                                    <h3>{{ $subjectCount }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/dash-icon-04.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Repeat for other cards -->
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Teacher and Student</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Teacher</li>
                                    <li><span class="circle-green"></span>Student</li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="pieChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Sections and Subject</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Sections</li>
                                    <li><span class="circle-green"></span>Subjects</li>
                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="nextpieChart"></div>
                    </div>
                </div>
            </div>
            <!-- Repeat for other charts -->
        </div>

        <!-- Student Table -->
        <div class="row">
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Recent Students</h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table star-student table-hover table-center table-borderless table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th class="text-center">Birth Date</th>
                                        {{-- <th class="text-center">Father Name</th> --}}
                                        <th class="text-end">Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentStudents as $student)
                                        <tr>
                                            <td class="text-nowrap">
                                                <div>{{ $student->admission_no }}</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('storage/' . ($student->photo ?? 'default-avatar.jpg')) }}"
                                                        width="25" alt="Star Students">
                                                    {{ $student->name }}
                                                </a>
                                            </td>
                                            <td class="text-center">{{ $student->dob ?? 'N/A' }}</td>
                                            {{-- <td class="text-center">{{ $student->father_name ?? 'N/A' }}</td> --}}
                                            <td class="text-end">
                                                <div>{{ $student->mobile_number ?? 'N/A' }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Repeat for other sections -->
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">All Activity</h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus">
                                <a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="activity-groups" style="max-height: 300px; overflow-y: auto;">
                            @if(!empty($logs))
                                @foreach($logs as $log)
                                    <div class="activity-awards">
                                        <div class="award-boxs">
                                            <img src="{{ asset('assets/img/icons/award-icon-01.svg') }}" alt="Log Icon">
                                        </div>
                                        <div class="award-list-outs">
                                            {{-- <h4>System Log</h4> --}}
                                            <h5>
                                                <span class="truncated-message" id="truncated-message-{{ $log->id }}">
                                                    {{ Str::limit($log->message, 50, '...') }} <!-- Truncated message -->
                                                </span>
                                                <span class="full-message" id="full-message-{{ $log->id }}" style="display:none;">
                                                    {{ $log->message }} <!-- Full message -->
                                                </span>
                                                <a href="javascript:void(0);" onclick="toggleLog('{{ $log->id }}')" style="color: blue; cursor: pointer; text-decoration: underline;">
                                                    <span id="read-more-{{ $log->id }}">Read More</span>
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="award-time-list">
                                            <span>{{ $log->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No important logs available.</p>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Social Media -->
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill fb sm-box">
                    <div class="social-likes">
                        <p>Like us on facebook</p>
                        <h6>0</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="{{ asset('assets/img/icons/social-icon-01.svg') }}" alt="Social Icon">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill twitter sm-box">
                    <div class="social-likes">
                        <p>Follow us on twitter</p>
                        <h6>0</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="{{ asset('assets/img/icons/social-icon-02.svg') }}" alt="Social Icon">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill insta sm-box">
                    <div class="social-likes">
                        <p>Follow us on instagram</p>
                        <h6>0</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="{{ asset('assets/img/icons/social-icon-03.svg') }}" alt="Social Icon">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card flex-fill linkedin sm-box">
                    <div class="social-likes">
                        <p>Follow us on linkedin</p>
                        <h6>0</h6>
                    </div>
                    <div class="social-boxs">
                        <img src="{{ asset('assets/img/icons/social-icon-04.svg') }}" alt="Social Icon">
                    </div>
                </div>
            </div>
            <!-- Repeat for other social media -->
        </div>
    </div>
    <footer>
        <p>Copyright © 2024.</p>
    </footer>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#teachers-table').DataTable();
            $('#students-table').DataTable();
        });
        function toggleLog(logId) {
        var truncatedMessage = document.getElementById('truncated-message-' + logId);
        var fullMessage = document.getElementById('full-message-' + logId);
        var readMoreText = document.getElementById('read-more-' + logId);
        
        if (fullMessage.style.display === "none") {
            truncatedMessage.style.display = "none"; // Hide truncated message
            fullMessage.style.display = "inline"; // Show full message
            readMoreText.innerHTML = "Hide"; // Change link text to "Hide"
        } else {
            truncatedMessage.style.display = "inline"; // Show truncated message
            fullMessage.style.display = "none"; // Hide full message
            readMoreText.innerHTML = "Read More"; // Change link text back to "Read More"
        }
    }
    </script>
    <script>
        var options = {
            chart: {
                type: 'pie',
                height: 350,
                toolbar: {
                    show: true, // Enables the toolbar with download option
                    tools: {
                        download: true, // Download option
                    }
                }
            },
            labels: @json($pieChartData['labels']),
            series: @json($pieChartData['series']),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pieChart"), options);
        chart.render();

        // Function to download the chart
        document.getElementById('download-chart').addEventListener('click', function() {
            chart.dataURI().then((uri) => {
                var link = document.createElement('a');
                link.href = uri.imgURI;
                link.download = 'teachers_vs_students_chart.png';
                link.click();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: @json($nextChartData['labels']),
                series: @json($nextChartData['series']),
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#nextpieChart"), options);
            chart.render();
        });
    </script>

@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection
