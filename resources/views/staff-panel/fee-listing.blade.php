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
                        <table id="fee-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Student Class</th>
                                <th>Mobile No</th>
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
                                        <td>{{$feeDetails->student->class}}</td>
                                        <td>{{$feeDetails->mobile_no}}</td>
                                        <td>{{$feeDetails->fee_amount}}</td>
                                        <td>
                                            {{$feeDetails->payment_mode}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
            text: "Fee Add Succesfully",
            icon: "success"
        });
    </script>
    @endif
    {{-- @if(session('delete-succesfully'))
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
    @endif --}}
@endsection
