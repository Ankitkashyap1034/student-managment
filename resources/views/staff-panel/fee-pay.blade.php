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
                                <h1>Pay Fee</h2><hr>
                            </div>
                            <div class="card-body">
                                <!-- Replace the following with actual user details -->
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="mobile-no" class="mb-1">Mobile No:</label>
                                            <input type="number" name="mobile_no" oninput="getStudentMobileNo(this)" class="form-control" id="mobile-no" placeholder="Enter Mobile no" required>
                                            @error('mobile_no')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <span class="text-danger" id="get-student-details"></span>
                                          </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Student Name:</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter student name" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Father Name:</label>
                                            <input type="text" name="father_name" class="form-control" id="fatherName" placeholder="Enter father name" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Select Student Class:</label>
                                            <select class="form-control" id="student-class" name="class" required>
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
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Fee in Ruppes:</label>
                                            <input type="number" name="fee_amount" class="form-control" id="fee-amount" placeholder="Enter Fee amount" required>
                                            @error('fee_amount')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Select Payment Mode:</label>
                                            <select class="form-control" id="payment-mode" name="payment_mode" required>
                                                <option value="" disabled selected>Select Payment Mode</option>
                                                <option value="online">Online </option>
                                                <option value="offline">Offline </option>
                                            </select>
                                            @error('payment_mode')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="name" class="mb-1">Enter Remark:</label>
                                            <input name="remark" class="form-control" id="remark" placeholder="Enter Remark" required />
                                            @error('remark')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-12 mb-2 mt-3">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                          </div>
                                    </div>
                                </div>
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

  <script>
    function getStudentMobileNo(mobileNo)
    {
        var mobile_no = mobileNo.value;

        $.ajax({
            type: 'GET',
            url: '/student-info/' + mobile_no,
            success: function(response) {
                if(response.status == true){
                    $('input[id="name"]').val(response.student.name);
                    $('input[id="father-name"]').val(response.student.father_name);
                    $("#student-class").val(response.student.class).trigger('change');
                    $("#get-student-details").text('');
                }else{
                    $('input[id="name"]').val('');
                    $("#student-class").val('').trigger('change');
                    $("#get-student-details").text('No student found with this mobile no');
                }
            },
            error: function(xhr, status, error) {
                // alert('Fail');
                // console.log(xhr.status); // Log the HTTP status code
                // console.log(error);     // Log the error message
            }
        });
    }
  </script>
@endsection
