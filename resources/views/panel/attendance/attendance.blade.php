@extends('panel.master')

@section('content')
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="{{asset('storage/student-profile-img/'.$studentDetails->profile_img)}}" alt="">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal">{{Auth::user()->name}}</h5>
                            <span>Student</span>
                        </div>
                    </div>
                </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('home.student')}}">
                        <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">About</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('attendance.student.view')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-timeline"></i>
                        </span>
                        <span class="menu-title">Attendance</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{route('logout')}}">
                        <span class="menu-icon">
                        <i class="mdi mdi-logout text-danger"></i>
                        </span>
                        <span class="menu-title">Log out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                    <div class="navbar-profile">
                        <img class="img-xs rounded-circle" src="{{asset('storage/student-profile-img/'.$studentDetails->profile_img)}}" alt="">
                        <p class="mb-0 d-none d-sm-block navbar-profile-name">{{Auth::user()->name}}</p>
                    </div>
                </a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-format-line-spacing"></span>
            </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel" style="background-color: #ffffff; !important">
            <!-- partial -->
            <div class="container mt-5">
                    <h2 class="text-center mb-4">Student Attendance</h2>

                <div class="table-responsive">
                    <table id="attendance-table" class="table table-bordered table-striped">
                        <thead>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $attendanceData)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td style="color: #00dd6a;" class="font-weight-bold">{{$studentDetails->name}}</td>
                                    <td style="color: #00dd6a;" class="font-weight-bold">{{$attendanceData->day}}-Dec-2023</td>
                                    <td style="color: #00dd6a;" class="font-weight-bold">{{$attendanceData->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    {{-- script for data table --}}
    <script>
        $(document).ready(function() {
            $('#attendance-table').DataTable({
                searching: true,
                paging: true,
                ordering: true
                // Add other options as needed
            });
        });
    </script>
    {{-- script for data table --}}
@endsection
