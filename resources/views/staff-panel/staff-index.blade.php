@extends('staff-panel.master')
@section('content')
 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
        @include('staff-panel.layouts.aside')
      <!-- Layout container -->
      <div class="layout-page">
        <div class="content-wrapper">
            <div class="container">
                 <!-- Centered Card -->
                 <div class="row justify-content-center mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                User Details<hr>
                            </div>
                            <div class="card-body">
                                <!-- Replace the following with actual user details -->
                                <div class="text-center mb-2">
                                    <img class="img-fluid" width="80px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJbd87QavjazVx5tJ9sLdp_p2oqfGoN1KUjw&usqp=CAU"/>
                                </div>
                                <h5 class="card-title">{{Auth::user()->name}}</h5>
                                <p class="card-text">{{Auth::user()->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Centered Card -->
            </div>
        </div>
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

@endsection
