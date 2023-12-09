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
                    <div class="container pt-4">
                        <div class="col-lg-4 col-md-4 order-1">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <a href="{{route('listing.student.staff')}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img
                                                        src="{{asset('staff-panel/assets/img/icons/unicons/chart-success.png')}}"
                                                        alt="chart success"
                                                        class="rounded"
                                                        />
                                                    </div>
                                                    <div class="dropdown">
                                                        <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt3"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                        >
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Student</span>
                                                <h3 class="card-title mb-2">{{$studentCount}}</h3>
                                                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <a href="{{route('listing.fee')}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img
                                                        src="{{asset('staff-panel/assets/img/icons/unicons/wallet-info.png')}}"
                                                        alt="Credit Card"
                                                        class="rounded"
                                                        />
                                                    </div>
                                                </div>
                                                <span>Paid Fee</span>
                                                <h3 class="card-title text-nowrap mb-1">{{$paidFeeCount}}</h3>
                                                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
