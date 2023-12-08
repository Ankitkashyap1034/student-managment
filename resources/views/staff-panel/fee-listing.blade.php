@extends('master')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Student Listing</h2>

        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Student Class</th>
                    <th>Fee Amount</th>
                    <th>Payment Mode</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $feeDetails)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$feeDetails->student->name}}</td>
                            <td>{{$feeDetails->student->father_name}}</td>
                            <td>{{$feeDetails->fee_amount}}</td>
                            <td>{{$feeDetails->mobile_no}}</td>
                            <td>
                                {{$feeDetails->payment_mode}}
                                {{-- <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm viewStudent m-1" data-id="{{$feeDetails->id}}">View</button> --}}
                                {{-- <a href="{{url('/edit-student/'.$feeDetails->id)}}" class="btn btn-info btn-sm m-1">Edit</a>
                                <button type="button" data-id="{{$feeDetails->id}}" class="btn btn-danger btn-sm m-1 student-delete-button" data-target="#deleteModal" data-toggle="modal">Delete</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4 mb-5">
        <a href="{{ route('home.staff') }}" class="btn btn-primary mx-auto">Go Home</a>
        <a href="{{ url('/add-student') }}" class="btn btn-success mx-auto">Add Student</a>
    </div>

    {{-- modal --}}
    <div class="modal" id="myModal">
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
      {{-- model for delete student --}}

        <script>
            // $(document).ready(function() {
            //     $('.viewStudent').click(function() {
            //         var studentId = $(this).data('id');
            //         $.ajax({
            //             type: 'GET',
            //             url: '/student-details/' + studentId,
            //             success: function(response) {
            //                 if(response.status == true){
            //                     $('input[id="name"]').val(response.studentDetials.name);
            //                     $('input[id="fatherName"]').val(response.studentDetials.father_name);
            //                     $('input[id="motherName"]').val(response.studentDetials.mother_name);
            //                     $('input[id="email"]').val(response.studentDetials.email);
            //                     $('input[id="mobileNo"]').val(response.studentDetials.mobile_no);
            //                     $('input[id="class"]').val(response.studentDetials.class);
            //                     $("#gender").val(response.studentDetials.gender);
            //                     $("#address").val(response.studentDetials.address);
            //                     $('#profileImg').attr('src', "storage/student-profile-img/"+response.studentDetials.profile_img);
            //                 }
            //             },
            //             error: function(xhr, status, error) {
            //                 alert('Fail');
            //                 console.log(xhr.status); // Log the HTTP status code
            //                 console.log(error);     // Log the error message
            //             }
            //         });
            //     });
            // });
        // ajax reqeust to server for delete the student
        // $(document).ready(function() {
        //     $('.student-delete-button').click(function() {
        //         var studentId = $(this).data('id');

        //         $('#delete-confirm-button').click(function() {
        //             $.ajax({
        //             type: 'GET',
        //             url: '/delete-student/' + studentId,
        //             success: function(response) {
        //                 if(response.status == true){
        //                     $('#deleteModal').modal('hide');

        //                     Swal.fire({
        //                         title: "Good job!",
        //                         text: "Student deleted successfully",
        //                         icon: "success",
        //                         showConfirmButton: true,
        //                         allowOutsideClick: false,  // Prevent closing by clicking outside the modal
        //                     }).then((result) => {
        //                         if (result.isConfirmed) {
        //                             window.location.href = '/listing';
        //                         } else {
        //                             // User clicked "Cancel" or closed the modal without confirming
        //                         }
        //                     });

        //                 }
        //             },
        //                 error: function(xhr, status, error) {
        //                     alert('Fail');
        //                     console.log(xhr.status); // Log the HTTP status code
        //                     console.log(error);     // Log the error message
        //                 }
        //             });
        //         });

        //     });
        // });
        </script>

        {{-- script for data table --}}
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
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

