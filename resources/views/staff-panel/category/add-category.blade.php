@extends('staff-panel.master')
@section('content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
        <!-- Menu -->
            @include('staff-panel.layouts.aside')
            <div class="layout-page mt-4">
                <div class="content-wrapper">
                        <div class="container">
                            <div class="card pt-4">
                                <div class="card-header">
                                    <h1 class="text-center mt-3">
                                        Add Student Form
                                    </h1>
                                </div>
                                <div class="card-body">
                                    <div class="pt-4">
                                        <form method="POST" class="form" action="{{route('store.student')}}" enctype="multipart/form-data">
                                            {{-- @if(Route::currentRouteName() === 'edit.student.view') @method('PUT') @endif --}}
                                            @csrf
                                            {{-- @if(Route::currentRouteName() === 'edit.student.view')
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <div class="text-center p-2">
                                                        <img id="profileImg" width="50%" src="{{asset('storage/student-profile-img/'.$studentDetail->profile_img)}}" class="img-fluid" alt="Student Profile Image" />
                                                    </div>
                                                </div>
                                            @endif --}}

                                            <div class="form-group mb-3">
                                                <label for="studentName">Student Profile Image:</label>
                                                <input type="file" name="profile_img" class="form-control" id="profile_img" placeholder="Upload student profile image" @if(Route::currentRouteName() === 'add.student') required @endif />
                                                @error('profile_img')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="studentName">Student Name:</label>
                                                <input type="text" name="name" class="form-control" id="studentName" placeholder="Enter student name" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->name}}" @endif required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            {{-- </section> --}}
        </div>
        <script>
            // function checkPassword()
            // {
            //     var password = document.getElementById('password').value;
            //     var confirmPassword = document.getElementById('confirm-password').value;

            //     if(password != confirmPassword){
            //         document.getElementById('password-error').textContent = 'Password and confirm password does not match';
            //     }else{
            //         document.getElementById('password-error').textContent = '';
            //     }
            // }
            // function checkMobileNo(mobileNo)
            // {
            //     // var regex = /^[0-9]{11}$/;

            //     // Check if the mobile number is valid
            //     if (mobileNo.value.length != 10) {
            //         document.getElementById('mobile-no-error').textContent = 'Mobile no must the 10 digits';
            //         mobileNo.classList.add('is-invalid');
            //     }else{
            //         document.getElementById('mobile-no-error').textContent = '';
            //         mobileNo.classList.remove('is-invalid');
            //     }
            // }

        </script>
        </div>

    </div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
 @endsection
