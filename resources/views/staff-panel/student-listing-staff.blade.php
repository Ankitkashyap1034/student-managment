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
                <div class="container mt-5">
                    @if(Route::currentRouteName() == 'listing.student.filter')
                        <h2 class="text-center mb-4">Student listing of class {{$class}}</h2>
                        @else
                        <h2 class="text-center mb-4">Student listing</h2>
                    @endif

                    <div class="table-responsive">
                        <table id="student-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Profile Image</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td >
                                            <img width="25%" src="{{asset('storage/student-profile-img/'.$student->profile_img)}}" alt="Student Profile Image">
                                        </td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->father_name}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->mobile_no}}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#show-details-model" class="btn btn-success btn-sm viewStudent m-1" data-id="{{$student->id}}">View</button>
                                            <a href="{{url('/edit-student/'.$student->id)}}" class="btn btn-info btn-sm m-1 editStudetModel" data-target="#show-edit-model" data-toggle="modal" data-id="{{$student->id}}">Edit</a>
                                            <button type="button" data-id="{{$student->id}}" class="btn btn-danger btn-sm m-1 student-delete-button" data-target="#deleteModal" data-toggle="modal">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-center mt-4 mb-5">
                    <a href="{{ url('/index') }}" class="btn btn-primary mx-auto">Go Home</a>
                    <a href="{{ url('/add-student') }}" class="btn btn-success mx-auto">Add Student</a>
                </div> --}}

                {{-- modal --}}
                <div class="modal open" id="show-details-model">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Student Details</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="text-center p-2">
                            <img id="profileImg" src="" class="img-fluid" alt="Student Profile Image">
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                          <!-- Form for user details -->
                          <form>
                            <div class="form-group">
                              <label for="name">Name:</label>
                              <input type="text" class="form-control" id="name" placeholder="Enter your name" readonly>
                            </div>
                            <div class="form-group">
                              <label for="fatherName">Father's Name:</label>
                              <input type="text" class="form-control" id="fatherName" placeholder="Enter your father's name" readonly>
                            </div>
                            <div class="form-group">
                              <label for="motherName">Mother's Name:</label>
                              <input type="text" class="form-control" id="motherName" placeholder="Enter your mother's name" readonly>
                            </div>
                            <div class="form-group">
                              <label for="email">Email:</label>
                              <input type="email" class="form-control" id="email" placeholder="Enter your email" readonly>
                            </div>
                            <div class="form-group">
                              <label for="mobileNo">Mobile No:</label>
                              <input type="text" class="form-control" id="mobileNo" placeholder="Enter your mobile number" readonly>
                            </div>
                            <div class="form-group">
                              <label for="class">Class:</label>
                              <input type="text" class="form-control" id="class" placeholder="Enter your class" readonly>
                            </div>
                            <div class="form-group">
                              <label for="gender">Gender:</label>
                              <select class="form-control" id="gender" disabled>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="address">Address:</label>
                              <textarea class="form-control" id="address" rows="3" placeholder="Enter your address" readonly></textarea>
                            </div>
                          </form>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          {{-- <button type="button" class="btn btn-primary">Save Changes</button> --}}
                        </div>

                      </div>
                    </div>
                  </div>
                  {{-- end model view student details --}}

                  {{-- model for delete student --}}
                    <div class="modal fade" id="deleteModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close-modal">No</button>
                                    <button type="button" id="delete-confirm-button" class="btn btn-danger">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal open" id="show-edit-model">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Student Details</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="text-center p-2">
                            <img id="edit-profile-img" src="" class="img-fluid" alt="Student Profile Image">
                        </div>

                        <form method="POST" class="form" action="{{route('edit.student.store')}}" enctype="multipart/form-data">
                            <!-- Form for user details -->
                            @method('PUT')
                            @csrf
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="studentName">Student Profile Image:</label>
                                    <input type="file" name="profile_img" class="form-control" id="profile_img" placeholder="Upload student profile image" />
                                    @error('profile_img')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="fatherName">Father's Name:</label>
                                    <input type="text" class="form-control" id="fatherName" name="father_name" placeholder="Enter your father's name" required>
                                    @error('father_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="motherName">Mother's Name:</label>
                                    <input type="text" class="form-control" id="motherName" name="mother_name" placeholder="Enter your mother's name" required>
                                    @error('mother_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mobileNo">Mobile No:</label>
                                    <input type="text" class="form-control" id="mobileNo" name="mobile_no" placeholder="Enter your mobile number" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="class">Class:</label>
                                    <select class="form-control" id="student_class" name="class" required>
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
                                <div class="form-group mb-3">
                                <label for="gender">Gender:</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">Address:</label>
                                    <textarea class="form-control" id="address_edit" rows="3" placeholder="Enter your address" required name="address"></textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="student_id" />
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- end model view student details --}}

                  {{-- model for delete student --}}
                    <div class="modal fade" id="deleteModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="close-modal">No</button>
                                    <button type="button" id="delete-confirm-button" class="btn btn-danger">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div>
       {{-- model for delete student --}}

    <script>
        $(document).ready(function() {
            $('.viewStudent').click(function() {
                var studentId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/student-details/' + studentId,
                    success: function(response) {
                        if(response.status == true){
                            $('input[id="name"]').val(response.studentDetials.name);
                            $('input[id="fatherName"]').val(response.studentDetials.father_name);
                            $('input[id="motherName"]').val(response.studentDetials.mother_name);
                            $('input[id="email"]').val(response.studentDetials.email);
                            $('input[id="mobileNo"]').val(response.studentDetials.mobile_no);
                            $('input[id="class"]').val(response.studentDetials.class);
                            $("#gender").val(response.studentDetials.gender);
                            $("#address").val(response.studentDetials.address);
                            $('#profileImg').attr('src', "{{ asset('storage/student-profile-img/') }}" + '/' + response.studentDetials.profile_img);

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

        // ajax for editing student details
        $(document).ready(function() {
            $('.editStudetModel').click(function() {
                var studentId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/student-details/' + studentId,
                    success: function(response) {
                        if(response.status == true){
                            $('input[name="name"]').val(response.studentDetials.name);
                            $('input[name="father_name"]').val(response.studentDetials.father_name);
                            $('input[name="mother_name"]').val(response.studentDetials.mother_name);
                            $('input[name="email"]').val(response.studentDetials.email);
                            $('input[name="mobile_no"]').val(response.studentDetials.mobile_no);
                            $('input[name="student_id"]').val(response.studentDetials.id);
                            $("#student_class").val(response.studentDetials.class).trigger('change');
                            $("#gender").val(response.studentDetials.gender).trigger('change');
                            $("#address_edit").val(response.studentDetials.address);
                            $("#edit-profile-img").attr('src', "{{ asset('storage/student-profile-img/') }}" + '/' + response.studentDetials.profile_img);
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
        // ajax reqeust to server for delete the student
        $(document).ready(function() {
            $('.student-delete-button').click(function() {
                var studentId = $(this).data('id');

                $('#delete-confirm-button').click(function() {
                    $.ajax({
                    type: 'GET',
                    url: '/delete-student/' + studentId,
                    success: function(response) {
                        if(response.status == true){
                            $('#deleteModal').modal('hide');
                            // $('#deleteModal').removeClass('show');
                            // $('#deleteModal').css('display', 'block');
                            // $('#deleteModal').attr('aria-hidden', 'true');


                            Swal.fire({
                                title: "Good job!",
                                text: "Student deleted successfully",
                                icon: "success",
                                showConfirmButton: true,
                                allowOutsideClick: false,  // Prevent closing by clicking outside the modal
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/staff/listing';
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
        });
    </script>

    {{-- script for data table --}}
    <script>
        $(document).ready(function() {
            $('#student-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    {{-- script for data table --}}

    @if(session('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "Student Add Succesfully",
            icon: "success"
        });
    </script>
    @endif
    @if(session('delete-succesfully'))
        <script>

        </script>
    @endif
    @if(session('edit-successfully'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "Student Edit Succesfully",
                icon: "success"
            });
        </script>
    @endif
@endsection
