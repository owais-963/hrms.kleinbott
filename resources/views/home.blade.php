@extends('layouts.app')

@section('content')
    <style>

    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">Welcome {{ $currentUser->username }} </div> --}}


                    {{-- <div class="row">

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
                    </div> --}}

                    <div id="calendarContainer">


                    </div>
                </div>

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
@endsection
