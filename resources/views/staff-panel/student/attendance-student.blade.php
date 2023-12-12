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
                            <form action="{{route('attendance.year.month')}}" class="form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label>Select Year</label>
                                        <select name="year" class="form-control" id="year">
                                            @php
                                                $currentYear = date('Y');
                                            @endphp

                                            @for ($year = 2000; $year <= $currentYear; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Select Month</label>
                                        <select name="month" class="form-control"  id="selectMonth">
                                            @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <button type="submit" class="btn btn-fill btn-success mt-4">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <table id="attendance" class="table table-bordered table-striped">
                                <thead>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        <th style="width: 30px;">{{ $day }} - {{$monthName}} - {{ $selctYear }}</th>
                                    @endfor
                                </thead>
                                <tbody>
                                    @foreach($studentData as $studentData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$studentData->name}}</td>
                                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                                <td>
                                                    <form method="post" action="{{route('view.student.attendance')}}">
                                                        @csrf
                                                        <input name="day" value="{{$day}}" type="hidden"/>
                                                        <input name="student_id" value="{{$studentData->id}}" type="hidden"/>
                                                        <input name="month" value="{{$monthName}}" type="hidden"/>
                                                        <input name="year" value="{{$selctYear}}" type="hidden"/>
                                                        @php
                                                            $attendance = DB::table('attendance')->where('student_id', $studentData->id)
                                                                            ->where('day', $day)
                                                                            ->where('month',$monthName)
                                                                            ->where('year',$selctYear)->first();
                                                        @endphp
                                                        <select name="status" id="status">
                                                            <option  data-id="" value=""></option>
                                                            <option @if($attendance && $attendance->status == 'present') selected @endif value="present">P</option>
                                                            <option @if($attendance && $attendance->status == 'absent') selected @endif value="absent">A</option>
                                                            <option @if($attendance && $attendance->status == 'excused') selected @endif value="excused">E</option>
                                                        </select><br>
                                                        <button type="submit" class="bx bx-check mt-1 btn-success"></button>
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

    @if(Route::currentRouteName() == 'view.student.attendance')
        <script>
            $(document).ready(function() {
                var currentMonth = new Date().getMonth() + 1;

                // Set the selected option to the current month
                $('#selectMonth').val(currentMonth);
            });
        </script>

        <script>
            $(document).ready(function() {
                var currentYear = new Date().getFullYear();

                // Set the selected option to the current month
                $('#year').val(currentYear);
            });
        </script>
        @else
            <script>
                var currentMonth = @json($monthName);
                var currentYear = @json($selctYear);

                // create a fucntion to find the month number with help of month name
                function getMonthNumber(monthName) {
                    var months = {
                        'January': 1,
                        'February': 2,
                        'March': 3,
                        'April': 4,
                        'May': 5,
                        'June': 6,
                        'July': 7,
                        'August': 8,
                        'September': 9,
                        'October': 10,
                        'November': 11,
                        'December': 12
                    };

                    return months[monthName];
                }
                // use the fucntion to find the month number
                var currentMonthNumber = getMonthNumber(currentMonth);

                $(document).ready(function() {
                    $('#selectMonth').val(currentMonthNumber);
                });

                $(document).ready(function() {
                    $('#year').val(currentYear);
                });
            </script>
    @endif
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
