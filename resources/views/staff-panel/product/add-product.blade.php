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
                            <div class="row mt-21">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <div class="card pt-4">
                                        <div class="card-header">
                                            <h1 class="text-center mt-3">
                                                Add Product
                                            </h1>
                                        </div>
                                        <div class="card-body">
                                            <div class="pt-4">
                                                <form method="POST" class="form" action="{{route('add.product.store')}}" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group mb-3">
                                                        <label for="studentName">Product Image:</label>
                                                        <input type="file" name="product_image" class="form-control" id="product-image" placeholder="Upload product image" required />
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


                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            {{-- </section> --}}
        </div>
        <script>

        </script>
        </div>

    </div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
 @endsection
