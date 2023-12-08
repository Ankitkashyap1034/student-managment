@extends('master')

@section('content')

    <h1 class="text-center">
        @if(Route::currentRouteName() === 'add.student')   Add Student Form @endif
        @if(Route::currentRouteName() === 'edit.student.view') Edit Student Form @endif
    </h1>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <section class="bg-light mb-2">
        <div class="container">
            <div class="pt-4">
                <form method="POST" class="form" action="@if(Route::currentRouteName() === 'add.student')  {{route('store.student')}} @endif @if(Route::currentRouteName() === 'edit.student.view') {{route('edit.student.store')}} @endif" enctype="multipart/form-data">
                    @if(Route::currentRouteName() === 'edit.student.view') @method('PUT') @endif
                    @csrf
                      @if(Route::currentRouteName() === 'edit.student.view')
                        <div class="col-md-12 d-flex justify-content-center">
                            <div class="text-center p-2">
                                <img id="profileImg" width="50%" src="{{asset('storage/student-profile-img/'.$studentDetail->profile_img)}}" class="img-fluid" alt="Student Profile Image" />
                            </div>
                        </div>
                      @endif

                      <div class="form-group">
                        <label for="studentName">Student Profile Image:</label>
                        <input type="file" name="profile_img" class="form-control" id="profile_img" placeholder="Upload student profile image" @if(Route::currentRouteName() === 'add.student') required @endif />
                        @error('profile_img')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="studentName">Student Name:</label>
                        <input type="text" name="name" class="form-control" id="studentName" placeholder="Enter student name" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->name}}" @endif required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Father Name -->
                      <div class="form-group">
                        <label for="fatherName">Father Name:</label>
                        <input type="text" name="father_name" class="form-control" id="fatherName" placeholder="Enter father name" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->father_name}}" @endif required>
                        @error('father_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Mother Name -->
                      <div class="form-group">
                        <label for="motherName">Mother Name:</label>
                        <input type="text" name="mother_name" class="form-control" id="motherName" placeholder="Enter mother name" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->mother_name}}" @endif required>
                        @error('mother_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Mobile Number -->
                      <div class="form-group">
                        <label for="mobileNo">Mobile Number: </label>
                        {{-- <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="right" title="Mobile no is minimum 10 number" aria-hidden="true"></i> --}}
                        <input type="number" oninput="checkMobileNo(this);" name="mobile_no" class="form-control" id="mobileNo" placeholder="Enter mobile number" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->mobile_no}}" @endif required>
                        @error('mobile_no')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <span id="mobile-no-error" class="text-danger"></span>
                      </div>

                      <!-- Email -->
                      <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->email}}" @endif required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      @if(Route::currentRouteName() === 'add.student')
                        <!-- password -->
                        <div class="form-group">
                            <label for="email">Password:</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- confirm password -->
                        <div class="form-group">
                            <label for="email">Confirm Password:</label>
                            <input type="password" name="password_confirmation" class="form-control" oninput="checkPassword();" id="confirm-password" placeholder="Enter confirm password" required>
                            <span class="text-danger" id="password-error"></span>
                        </div>
                      @endif

                      <!-- Gender -->
                      <div class="form-group">
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
                          required>
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
                      <div class="form-group">
                        <label for="class">Class:</label>
                        <select class="form-control" id="class" name="class" required>
                            <option value="" disabled selected>Select Class</option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '1' ? 'selected' : '' }} @endif value="1">1st </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '2' ? 'selected' : '' }} @endif value="2">2nd </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '3' ? 'selected' : '' }} @endif value="3">3rd </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '4' ? 'selected' : '' }} @endif value="4">4th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '5' ? 'selected' : '' }} @endif value="5">5th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '6' ? 'selected' : '' }} @endif value="6">6th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '7' ? 'selected' : '' }} @endif  value="7">7th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '8' ? 'selected' : '' }} @endif  value="8">8th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '9' ? 'selected' : '' }} @endif  value="9">9th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '10' ? 'selected' : '' }} @endif  value="10">10th </option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '11' ? 'selected' : '' }} @endif  value="11">11th  (Intermediate 1st Year)</option>
                            <option @if(Route::currentRouteName() === 'edit.student.view') {{ $studentDetail->class === '12' ? 'selected' : '' }} @endif  value="12">12th  (Intermediate 2nd Year)</option>
                        </select>
                        @error('class')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Address -->
                      <div class="form-group">
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
    </section>
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
@endsection
