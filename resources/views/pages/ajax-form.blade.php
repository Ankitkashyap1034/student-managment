@extends('master')

@section('content')

    <h1 class="text-center">
    Add Student Form
        {{-- @if(Route::currentRouteName() === 'edit.student.view') Edit Student Form @endif --}}
    </h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="bg-light">
        <div class="container">
            <div class="pt-4">
                <form method="POST" class="form" id="student-form" enctype="multipart/form-data">
                   @csrf

                      <div class="form-group">
                        <label for="studentName">Student Profile Image:</label>
                        <input type="file" name="profile_img" class="form-control" id="profile_img" placeholder="Upload student profile image" required />
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
                        <label for="mobileNo">Mobile Number:</label>
                        <input type="number" name="mobile_no" class="form-control" id="mobileNo" placeholder="Enter mobile number" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->mobile_no}}" @endif required>
                        @error('mobile_no')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Email -->
                      <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" @if(Route::currentRouteName() === 'edit.student.view') value="{{$studentDetail->email}}" @endif required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

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
                          <input type="radio" class="form-check-input" name="gender" id="female" value="other"
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
                        <select class="form-control" id="classSelect" name="class" required>
                        <option value="" disabled selected>Select Class</option>
                        <option  value="1">1st</option>
                        <option  value="2">2nd</option>
                        <option  value="3">3rd</option>
                        <option  value="4">4th</option>
                        <option  value="5">5th</option>
                        <option  value="6">6th</option>
                        <option   value="7">7th</option>
                        <option   value="8">8th</option>
                        <option   value="9">9th</option>
                        <option  value="10">10th</option>
                        <option  value="11">11th (Intermediate 1st Year)</option>
                        <option  value="12">12th (Intermediate 2nd Year)</option>
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
    </section>
    <script>
        $(document).ready(function() {
            $('#student-form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/add-student/ajax/',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response.status == true){
                            Swal.fire({
                                title: "Good job!",
                                text: "Student added successfully",
                                icon: "success",
                                showConfirmButton: true,
                                allowOutsideClick: false,  // Prevent closing by clicking outside the modal
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/listing';
                                } else {
                                    // User clicked "Cancel" or closed the modal without confirming
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Fail');
                        console.log(xhr.status); // Log the HTTP status code
                        console.log(error);     // Log the error message
                    }
                });
            });
        });
    </script>
@endsection
