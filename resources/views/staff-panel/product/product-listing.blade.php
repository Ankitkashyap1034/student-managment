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
                                    <th style="width: 25%;">Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $productDetails)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>
                                                @foreach ($productDetails->product_images as $productImage)
                                                    <img width="10%" src="{{asset('storage/product-img/'.$productImage)}}" alt="Product Image">
                                                @endforeach
                                            </td>
                                            <td>{{$productDetails->product_name}}</td>
                                            <td>{{$productDetails->category->category_name}}</td>
                                            <td>{{$productDetails->quantity}}</td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#edit-model" class="btn btn-success btn-sm editProduct m-1" data-id="{{$productDetails->id}}">Edit</button>
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

            {{-- model --}}
            <div class="modal open" id="edit-model">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Product</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="text-center p-2" id="edit-product-img-container">
                            <img id="edit-product-img" width="20%" src="" class="img-fluid" alt="Student Profile Image">
                        </div>

                        <form method="POST" class="form" action="{{route('edit.product.store')}}" enctype="multipart/form-data">
                            <!-- Form for user details -->
                            @method('PUT')
                            @csrf
                            <!-- Modal Body -->
                            <div class="modal-body">

                                <div class="form-group mb-3">
                                    <label for="studentName">Product Image:</label>
                                    <input type="file" name="product_image" class="form-control" id="product_image" placeholder="Upload product image" />
                                    @error('product_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="studentName">Product Name:</label>
                                    <input type="text" name="product_name" class="form-control" id="product-name" placeholder="Enter the product name" required/>
                                    @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="studentName">Product Category:</label>
                                    <select class="form-control" id="category" name="category_id" required>
                                        <option value="" disabled selected>Select catrgory</option>
                                        @foreach ($categeries as $categeryDetails)
                                            <option value="{{$categeryDetails->id}}">{{$categeryDetails->category_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="studentName">Product Quantity:</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter the product quantity" required/>
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="studentName">Product description:</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Enter the product description" required/>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="product_id" />
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
        {{-- model --}}
    </div>

    <script>
        // for edit the category
         $(document).ready(function() {
            $('.editProduct').click(function() {
                var productId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/product/edit-product/' + productId,
                    success: function(response) {
                        if(response.status == true){
                            $('input[name="product_name"]').val(response.productDetails.product_name);
                            $('input[name="order"]').val(response.productDetails.order);
                            $('input[name="quantity"]').val(response.productDetails.quantity);
                            $('input[name="product_id"]').val(response.productDetails.id);
                            $('input[name="description"]').val(response.productDetails.description);
                            var productImages = response.productDetails.product_images;
                            $("#edit-product-img").attr('src', "{{ asset('storage/product-img/') }}" + '/' + productImages[0]);

                            for (var i = 1; i < productImages.length; i++) {
                                var newImage = $("<img>").attr('src', "{{ asset('storage/product-img/') }}" + '/' + productImages[i]);
                                // Append the new image element to the container
                                $("#edit-product-img-container").append(newImage);
                            }

                            $("#category").val(response.productDetails.category_id).trigger('change');
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
                text: "Product Add Succesfully",
                icon: "success"
            });
        </script>
    @endif

    @if(session('update_success'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "Product update Succesfully",
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
                    url: '/product/edit-product/' + categoryId,
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
