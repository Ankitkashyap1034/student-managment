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
                    {{-- <form action="{{route('logout')}}" method="post"> --}}
                        {{-- @csrf --}}
                        <a class="nav-link" href="{{route('logout')}}">
                            <span class="menu-icon">
                            <i class="mdi mdi-logout text-danger"></i>
                            </span>
                            <span class="menu-title">Log out</span>
                        </a>
                    {{-- </form> --}}
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
        <div class="main-panel">
            <!-- partial -->
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <!-- Student Profile -->
                        <div class="card" style="background-color: whitesmoke;">
                            <div class="card-header" style="background-color: black;">
                                Student Profile
                            </div>
                            <div class="card-body">

                                <!-- Profile Image -->
                                <div class="text-center mb-4">
                                    <img src="{{asset('storage/student-profile-img/'.$studentDetails->profile_img)}}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                                </div>

                                <!-- Profile Details -->
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Name:</strong> {{Auth::user()->name}}</li>
                                    <li class="list-group-item"><strong>Email: </strong>  {{Auth::user()->email}}</li>
                                    <li class="list-group-item"><strong>Mobile No: </strong>  {{$studentDetails->mobile_no}}</li>
                                    <li class="list-group-item"><strong>Father Name: </strong>  {{$studentDetails->father_name}}</li>
                                    <li class="list-group-item"><strong>Mother Name: </strong>  {{$studentDetails->mother_name}}</li>
                                    <li class="list-group-item"><strong>Gender: </strong>  {{$studentDetails->gender}}</li>
                                    <li class="list-group-item"><strong>Class: </strong>  {{$studentDetails->class}}</li>
                                    <li class="list-group-item"><strong>Address: </strong>  {{$studentDetails->address}}</li>
                                    <!-- Add more profile details as needed -->
                                </ul>

                            </div>
                        </div>
                        <!-- End Student Profile -->

                    </div>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
