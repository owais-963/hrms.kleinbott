@section('css')
@endsection
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

<table class="bg-white br-30 responsive-table table">
    <thead>
        <tr>
            <th class="fw-bold">Date</th>
            <th class="fw-bold">Check-in Time</th>
            <th class="fw-bold">Check-out Time</th>
            <th class="fw-bold">Hours</th>
            <th class="fw-bold">Action</th>
        </tr>
    </thead>

    <tbody>
        @php
            $startDate = Carbon::createFromDate(date('Y'), $selectedMonth, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();
            $currentDate = $startDate;
        @endphp
        @while ($currentDate <= $endDate)
            <tr>
                <td>{{ $currentDate->format('d-F-Y') }} <br> {{ $currentDate->format('l') }} </td> @php
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
            @endif

            <td>-</td>


            </td>

        </tr>
        @php
            $currentDate->addDay();
        @endphp
    @endwhile
</tbody>
</table>


@section('js')
@endsection
