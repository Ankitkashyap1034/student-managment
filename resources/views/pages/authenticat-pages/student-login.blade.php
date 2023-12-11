@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Login Form -->
                <div class="login-container">
                    <h2 class="text-center mb-4">Student Login</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <a href="{{route('index')}}" class="btn btn-secondary btn-block">Go to homepage</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('login-faild'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Password does not match!",
            });
        </script>
    @endif
    @if(session('logout-successfull'))
        <script>
             Swal.fire({
                    title: "Good job!",
                    text: "Student logout Succesfully",
                    icon: "success"
                });
        </script>
    @endif
    @if(session('email-faild'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Email does not exist!",
            });
        </script>
    @endif
@endsection
