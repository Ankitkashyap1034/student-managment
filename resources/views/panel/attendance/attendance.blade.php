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
                    <form action="{{route('attendance.year.month.student')}}" class="form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label style="color: black;">Select Year</label>
                                <select name="year" class="form-control" id="year">
                                    @php
                                        $currentYear = date('Y');
                                    @endphp

                                    @for ($year = 2000; $year <= $currentYear; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label style="color: black;">Select Month</label>
                                <select name="month" class="form-control"  id="selectMonth">
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 mt-2">
                                <button type="submit" class="btn btn-success mt-4">Submit</button>
                            </div>
                        </div>
                    </form>
                    <table id="attendance-table" class="table table-bordered table-striped">
                        {{-- <h4 style="color: black;">{{$studentDetails->name}}</h4> --}}
                        <thead>
                            {{-- <th>S.No</th> --}}
                            <th>Day</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= $daysInMonth; $i++ )
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="font-weight-bold">
                                        @php
                                            $attendanceDataForDay = $attendance->firstWhere('day', $i);
                                        @endphp

                                        @if($attendanceDataForDay)
                                            {{$attendanceDataForDay->status}}
                                        @else
                                            -------
                                        @endif
                                    </td>
                                </tr>
                            @endfor

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

    @if(Route::currentRouteName() == 'attendance.student.view')
        <script>
            $(document).ready(function() {
                var currentMonth = new Date().getMonth() + 1;

                // Set the selected option to the current month
                $('#selectMonth').val(currentMonth);
            });
        </script>

        <script>
            $(document).ready(function() {
                var currentYear = new Date().getFullYear();

                // Set the selected option to the current month
                $('#year').val(currentYear);
            });
        </script>
    @else
        <script>
            var currentMonth = @json($monthNumber);
            var currentYear = @json($selctedYear);

            $(document).ready(function() {
                $('#selectMonth').val(currentMonth);
            });

            $(document).ready(function() {
                $('#year').val(currentYear);
            });
        </script>
    @endif
@endsection
