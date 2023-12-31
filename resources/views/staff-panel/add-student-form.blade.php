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

                                            <!-- Father Name -->
                                            <div class="form-group mb-3">
                                                <label for="fatherName">Father Name:</label>
                                                <input type="text" name="father_name" class="form-control" id="fatherName" placeholder="Enter father name" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->father_name}}" @endif required>
                                                @error('father_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Mother Name -->
                                            <div class="form-group mb-3">
                                                <label for="motherName">Mother Name:</label>
                                                <input type="text" name="mother_name" class="form-control" id="motherName" placeholder="Enter mother name" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->mother_name}}" @endif required>
                                                @error('mother_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Mobile Number -->
                                            <div class="form-group mb-3">
                                                <label for="mobileNo">Mobile Number: </label>
                                                {{-- <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Mobile no is minimum 10 number" aria-hidden="true"></i> --}}
                                                <input type="number" oninput="checkMobileNo(this);" name="mobile_no" class="form-control" id="mobileNo" placeholder="Enter mobile number" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->mobile_no}}" @endif required>
                                                @error('mobile_no')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <span id="mobile-no-error" class="text-danger"></span>
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group mb-3">
                                                <label for="email">Email:</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->email}}" @endif required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- password --}}
                                             <!-- password -->
                                            <div class="form-group mb-3">
                                                <label for="email">Password:</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required />
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- confirm password -->
                                            <div class="form-group mb-3">
                                                <label for="email">Confirm Password:</label>
                                                <input type="password" name="password_confirmation" class="form-control" oninput="checkPassword();" id="confirm-password" placeholder="Enter confirm password" required>
                                                <span class="text-danger" id="password-error"></span>
                                            </div>
                                            {{-- password --}}

                                            @if(Route::currentRouteName() === 'add.student')
                                                <!-- password -->
                                                <div class="form-group mb-3">
                                                    <label for="email">Password:</label>
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required />
                                                    @error('password')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- confirm password -->
                                                <div class="form-group mb-3">
                                                    <label for="email">Confirm Password:</label>
                                                    <input type="password" name="password_confirmation" class="form-control" oninput="checkPassword();" id="confirm-password" placeholder="Enter confirm password" required>
                                                    <span class="text-danger" id="password-error"></span>
                                                </div>
                                            @endif

                                            <!-- Gender -->
                                            <div class="form-group mb-3">
                                                <label>Gender:</label>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="gender" id="male" value="male"
                                                    @if(Route::currentRouteName() === 'edit.student.view')
                                                        @if($studentDetail->gender === 'male') checked @endif
                                                    @endif required>
                                                    <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check">
                                                <input type="radio" class="form-check-input" name="gender" id="female" value="female"
                                                    @if(Route::currentRouteName() === 'edit.student.view')
                                                        @if($studentDetail->gender === 'female') checked @endif
                                                    @endif
                                                    required />
                                                <label class="form-check-label" for="female">Female</label>
                                                </div>
                                                <div class="form-check">
                                                <input type="radio" class="form-check-input" name="gender" id="other" value="other"
                                                    @if(Route::currentRouteName() === 'edit.student.view')
                                                        @if($studentDetail->gender === 'other') checked @endif
                                                    @endif
                                            required>
                                                <label class="form-check-label" for="female">Other</label>
                                                </div>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Class -->
                                            <div class="form-group mb-3">
                                                <label for="class">Class:</label>
                                                <select class="form-control" id="class" name="class" required>
                                                    <option value="" disabled selected>Select Class</option>
                                                    <option value="1">1st </option>
                                                    <option value="2">2nd </option>
                                                    <option value="3">3rd </option>
                                                    <option value="4">4th </option>
                                                    <option value="5">5th </option>
                                                    <option value="6">6th </option>
                                                    <option  value="7">7th </option>
                                                    <option  value="8">8th </option>
                                                    <option  value="9">9th </option>
                                                    <option   value="10">10th </option>
                                                    <option   value="11">11th  (Intermediate 1st Year)</option>
                                                    <option   value="12">12th  (Intermediate 2nd Year)</option>
                                                </select>
                                                @error('class')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Address -->
                                            <div class="form-group mb-3">
                                                <label for="address">Address:</label>
                                                <textarea  name="address" class="form-control" id="address" placeholder="Enter address" rows="3" required>@if(Route::currentRouteName() === 'edit.student.view'){{$studentDetail->address}} @endif</textarea>
                                                @error('address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @if(Route::currentRouteName() === 'edit.student.view')
                                                <input type="hidden" name="student_id" value="{{$studentDetail->id}}" />
                                            @endif
                                            <div class="text-center">
                                                <a href="{{ url('/index') }}" class="btn btn-dark mx-auto">Go Home</a>
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
            function checkPassword()
            {
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirm-password').value;

                if(password != confirmPassword){
                    document.getElementById('password-error').textContent = 'Password and confirm password does not match';
                }else{
                    document.getElementById('password-error').textContent = '';
                }
            }
            function checkMobileNo(mobileNo)
            {
                // var regex = /^[0-9]{11}$/;

                // Check if the mobile number is valid
                if (mobileNo.value.length != 10) {
                    document.getElementById('mobile-no-error').textContent = 'Mobile no must the 10 digits';
                    mobileNo.classList.add('is-invalid');
                }else{
                    document.getElementById('mobile-no-error').textContent = '';
                    mobileNo.classList.remove('is-invalid');
                }
            }

        </script>
        </div>

    </div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
 @endsection
