@extends('layouts.app')

@section('content')
    <style>
        .responsive-table {
            display: block;
            width: 100%;
            overflow-x: auto;
        }


        .br-30 {
            border-radius: 30px;
        }

        .responsive-table.table {
            width: 100%;
            border-collapse: collapse;
        }

        .responsive-table.table th,
        .responsive-table.table td {
            text-align: center;

        }

        .responsive-table.table th {
            background-color: #952aea;
            width: 1%;
            color: white;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Welcome {{ $currentUser->username }} </div> --}}


                    <div class="row">

                        <div class="col-12">
                            <div class="form-Control">
                                <select class="form-select" id="monthSelector">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                            {{ date('m') == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="">


                        {{-- $dayoff = [mon,sun]
                        $holiday  = [[date =>01-09-2023, note=>'abc'],[date =>04-09-2023, note=>'abc']] --}}

                        <table class="bg-white br-30 responsive-table table">
                            <thead>
                                <tr>
                                    <th class="fw-bold">Date</th>
                                    <th class="fw-bold">Check-in Time</th>
                                    <th class="fw-bold">Check-out Time</th>
                                    <th class="fw-bold">Hours</th>
                                    <th class="fw-bold">Note</th>
                                    <th class="fw-bold">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $startDate = Carbon::createFromDate(date('Y'), date('m'), 1)->startOfMonth();
                                    $endDate = $startDate->copy()->endOfMonth();
                                    $currentDate = $startDate;
                                @endphp
                                @while ($currentDate <= $endDate)
                                    <tr>
                                        <td>{{ $currentDate->format('d-F-Y') }} <br> {{ $currentDate->format('l') }} </td>
                                        @php
                                            $attendanceFound = false;
                                        @endphp
                                        @foreach ($attendance_all as $attendance)
                                            @if ($attendance->date == $currentDate->format('Y-m-d'))
                                                <td>{{ convertDatabaseTime($attendance->check_in_time) }}</td>
                                                <td>{{ convertDatabaseTime($attendance->check_out_time) ?? '-' }}</td>
                                                @if (isDurationGreaterThanOrEqualTo9Hours(getWorkDuration($attendance->check_in_time, $attendance->check_out_time)))
                                                    <td class="text-success">
                                                        {{ $attendance->check_out_time ? getWorkDuration($attendance->check_in_time, $attendance->check_out_time) : '00-00' }}
                                                    </td>
                                                @else
                                                    <td class="text-danger">
                                                        {{ $attendance->check_out_time ? getWorkDuration($attendance->check_in_time, $attendance->check_out_time) : '00-00' }}
                                                    </td>
                                                @endif
                                                <td>{{ $attendance->note }}</td>
                                                <td>
                                                    <!-- Button to trigger modal -->
                                                    <a href="#" class="btn btn-primary note-button"
                                                        data-attendance-id="{{ $attendance->id }}"
                                                        data-note="{{ $attendance->note ?? '' }}">
                                                        Discrepancy
                                                    </a>
                                                    <!-- Modal -->


                                                </td>
                                                @php
                                                    $attendanceFound = true;
                                                @endphp
                                            @break
                                        @endif
                                    @endforeach


                                    @if (!$attendanceFound)
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif



                                    </td>

                                </tr>
                                @php
                                    $currentDate->addDay();
                                @endphp
                            @endwhile
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="noteForm" action="{{ route('save.note') }}" method="post">
                @csrf
                <!-- Add a hidden input field for attendance_id -->
                <input type="hidden" id="attendanceIdInput" name="attendance_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title text-black" id="noteModalLabel">Late Mark Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="note" class=" text-black">Note:</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Note</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        loadCalendar();

        $('#monthSelector').change(function() {
            loadCalendar();
        });

        function loadCalendar() {
            var selectedMonth = $('#monthSelector').val();
            $.ajax({
                url: '{{ route('get.calendar.data') }}',
                method: 'POST',
                data: {
                    month: selectedMonth,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#calendarContainer').html(data);
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.note-button').click(function() {
            // Get the data from the clicked button
            var attendanceId = $(this).data('attendance-id');
            var existingNote = $(this).data('note');

            // Populate the modal form fields with the data
            $('#attendanceIdInput').val(attendanceId);
            $('#note').val(existingNote);

            // Show the modal
            $('#noteModal').modal('show');
        });


    });
</script>
@endsection
