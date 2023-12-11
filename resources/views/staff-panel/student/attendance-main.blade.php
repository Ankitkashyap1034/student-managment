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
                                                Seelct Student
                                            </h1>
                                        </div>
                                        <div class="card-body">
                                            <div class="pt-4">
                                                <form method="POST" class="form" action="{{route('view.student.attendance.id')}}">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="studentName">Student Name and class:</label>
                                                        <select type="text" name="student_id" class="form-control" id="student-id" placeholder="Enter the category name" required>
                                                            <option value="" disabled>Select student</option>
                                                            @foreach($data as $student)
                                                                <option value="{{$student->id}}">{{$student->name}} , Class:{{$student->class}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_name')
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
