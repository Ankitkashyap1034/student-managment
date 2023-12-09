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
                                                Add Category
                                            </h1>
                                        </div>
                                        <div class="card-body">
                                            <div class="pt-4">
                                                <form method="POST" class="form" action="{{route('add.category.store')}}">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="studentName">Category Name:</label>
                                                        <input type="text" name="category_name" class="form-control" id="category-name" placeholder="Enter the category name" required/>
                                                        @error('category_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="studentName">Order</label>
                                                        <input type="number" name="order" class="form-control" id="order" placeholder="Enter order" required>
                                                        @error('name')
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
