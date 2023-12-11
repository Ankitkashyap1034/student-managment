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
                                User Details<hr>
                            </div>
                            <div class="card-body">
                                <!-- Replace the following with actual user details -->
                                <div class="text-center mb-2 border-2 pb-3">
                                    <img class="img-fluid" width="80px" src="{{asset('storage/staff-profile-img/'.$authStaff->profile_img)}}"/>
                                </div><hr>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h5 class="text-center">Name: </h5>
                                        <h5 class="text-center">Email: </h5>
                                        <h5 class="text-center">Mobile No: </h5>
                                        <h5 class="text-center">Address: </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-center">{{Auth::user()->name}}</h6>
                                        <h6 class="text-center">{{Auth::user()->email}}</h6>
                                        <h6 class="text-center">{{$authStaff->mobile_no}}</h6>
                                        <h6 class="text-center">{{$authStaff->address}}</h6>
                                    {{-- <h6 class="card-text text-center">{{Auth::user()->email}}</h6>--}}
                                    </div>
                                    <div class="text-center mt-4 mb-2 border-2 pb-3">
                                        <button class="btn btn-fill btn-success" type="button" data-toggle="modal" data-target="#edit-model" id="edit-staff" data-id="{{$authStaff->id}}">Edit</button>
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

     <div class="modal open" id="edit-model">
         <div class="modal-dialog">
             <div class="modal-content">
                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h4 class="modal-title">Edit profile details</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>

                 <form method="POST" class="form" action="{{route('store.profile.staff')}}">
                     <!-- Form for user details -->
                     @method('PUT')
                     @csrf
                     <!-- Modal Body -->
                     <div class="modal-body">

                         <div class="text-center mb-2 border-2 pb-3">
                             <img class="img-fluid" width="80px" src="{{asset('storage/staff-profile-img/'.$authStaff->profile_img)}}"/>
                         </div>

                         <div class="form-group mb-3">
                             <label for="name">Name:</label>
                             <input type="file" class="form-control" id="profile-img" name="profile_img" placeholder="Upload your profile image"/>
                             @error('name')
                             <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>

                         <div class="form-group mb-3">
                             <label for="name">Name:</label>
                             <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required value="{{$authStaff->name}}"/>
                             @error('name')
                                <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                         <div class="form-group mb-3">
                             <label for="fatherName">Email:</label>
                             <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required value="{{$authStaff->email}}"/>
                             @error('email')
                                <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>

                         <div class="form-group mb-3">
                             <label for="fatherName">Mobile No:</label>
                             <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter mobile no" required value="{{$authStaff->mobile_no}}"/>
                             @error('mobile_no')
                                <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>

                         <div class="form-group mb-3">
                             <label for="fatherName">Address: </label>
                             <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required value="{{$authStaff->address}}"/>
                             @error('address')
                                <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                         <input type="hidden" name="staff_id" value="{{$authStaff->id}}"/>
                         <input type="hidden" name="user_id" value="{{$authStaff->user_id}}"/>
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

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->
     @if(session('success'))
        <script>
             Swal.fire({
                 title: "Good job!",
                 text: "Profile update Successfully",
                 icon: "success"
             });
         </script>
     @endif
@endsection
