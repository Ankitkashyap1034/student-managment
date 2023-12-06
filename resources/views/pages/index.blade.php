@extends('master')

@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row pt-4">
                <div class="d-flex justify-content-center col-lg-3 order-2 order-lg-1">
                    <a href="{{route('add.student')}}" class="btn btn-primary shadow mr-2">Add Student</a>
                </div>
                <div class="d-flex justify-content-center col-lg-3 order-2 order-lg-1">
                    <a href="{{route('login.student')}}" class="btn btn-primary shadow mr-2">Student Login</a>
                </div>
                <div class="d-flex justify-content-center col-lg-3 order-2 order-lg-1">
                    <a href="{{route('listing')}}" class="btn btn-primary shadow mr-2">Listing</a>
                </div>
                <div class="d-flex justify-content-center col-lg-3 order-2 order-lg-1">
                    <a href="{{route('ajax.form')}}" class="btn btn-primary shadow mr-2">Form Submit With Ajax</a>
                </div>
                <div class="col-lg-12 order-2 order-lg-1 text-center pt-2">
                    <img src="https://static.javatpoint.com/blog/images/student-management-system.png" width="800px"/>
                </div>
        </div>
    </div>
    </section>
@endsection
