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
                            <h2 class="text-center mb-4">Student Attendance</h2>
                        @endif

                        <div class="table-responsive">
                            <table id="attendance" class="table table-bordered table-striped">
                                <thead>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <th>{{ $day }}-Dec</th>
                                    @endfor
                                </thead>
                                <tbody>
                                    @foreach($studentData as $studentData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$studentData->name}}</td>
                                            @for ($day = 1; $day <= 31; $day++)
                                                <td>
                                                    <form method="post" action="{{route('view.student.attendance')}}">
                                                        @csrf
                                                        <input name="day" value="{{$day}}" type="hidden"/>
                                                        <input name="student_id" value="{{$studentData->id}}" type="hidden"/>
                                                        @php
                                                            $attendance = DB::table('attendance_december')->where('student_id', $studentData->id)->where('day', $day)->first();
                                                        @endphp
                                                        <select name="status" id="status">
                                                            <option  data-id="" value=""></option>
                                                            <option @if($attendance && $attendance->status == 'present') selected @endif value="present">P</option>
                                                            <option @if($attendance && $attendance->status == 'absent') selected @endif value="absent">A</option>
                                                            <option @if($attendance && $attendance->status == 'excused') selected @endif value="excused">E</option>
                                                        </select>
                                                        <button type="submit" class="bx bx-check mt-1 btn-success   ">
                                                            {{-- <i class='bx bx-check'></i> --}}
                                                        </button>
                                                    </form>
                                                </td>
                                            @endfor
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

    {{-- script for data table --}}
    <script>
        $(document).ready(function() {
            $('#attendance').DataTable({
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
                text: "Attendance create Succesfully",
                icon: "success"
            });
        </script>
    @endif

    @if(session('update_success'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "Attendance update Succesfully",
                icon: "success"
            });
        </script>
    @endif
@endsection
