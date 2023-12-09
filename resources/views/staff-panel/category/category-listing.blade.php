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
                            <h2 class="text-center mb-4">Category listing</h2>
                        @endif

                        <div class="table-responsive">
                            <table id="fee-table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Category Name</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $categoryDetails)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$categoryDetails->category_name}}</td>
                                            <td>{{$categoryDetails->order}}</td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#edit-model" class="btn btn-success btn-sm editCategory m-1" data-id="{{$categoryDetails->id}}">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- model --}}
        <div class="modal open" id="edit-model">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form method="POST" class="form" action="{{route('edit.category.store')}}">
                        <!-- Form for user details -->
                        @method('PUT')
                        @csrf
                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Category Name:</label>
                                <input type="text" class="form-control" id="category-name" name="category_name" placeholder="Enter your category name" required>
                                @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="fatherName">Order:</label>
                                <input type="number" class="form-control" id="order" name="order" placeholder="Enter order" required>
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="category_id" />
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
        </div>
    {{-- model --}}

    {{-- script for data table --}}
    <script>
        $(document).ready(function() {
            $('#fee-table').DataTable({
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
                text: "Category Add Succesfully",
                icon: "success"
            });
        </script>
    @endif

    @if(session('success_update'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "Category update Succesfully",
                icon: "success"
            });
        </script>
    @endif
    <script>
        // for edit the category
         $(document).ready(function() {
            $('.editCategory').click(function() {
                var categoryId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/product/edit-category/' + categoryId,
                    success: function(response) {
                        if(response.status == true){
                            $('input[name="category_name"]').val(response.categoryDetails.category_name);
                            $('input[name="order"]').val(response.categoryDetails.order);
                            $('input[name="category_id"]').val(response.categoryDetails.id);
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
