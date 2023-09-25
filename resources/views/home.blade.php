@extends('layouts.app')

@section('content')
    <style>

    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="row text-center">
                        <div class="col-lg-4 col-sm 12">
                            <div class="card bg-white">
                                <div class="card-header">
                                    Today Break
                                </div>
                                <div class="card-body h-300-scroll ">
                                    <ul class="p-0 text-black text-start">
                                        @foreach ($breaks as $break)
                                            <li class="bg-light border-bottom br-6 p-2 py-3 mb-3">
                                                Break start {{ convertDatabaseTime($break->start_time) }} end
                                                {{ $break->end_time ? convertDatabaseTime($break->end_time) : 'Ongoing' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 col-sm 12">
                            <div class="card bg-white">
                                <div class="card-header">
                                    Working Hours
                                </div>
                                <div class="card-body bg-white br-30 ">

                                    <ul class=" p-3">
                                        <li class="m-2">
                                            <a class="bg-light br-30 btn btn-outline-light text-black">
                                                <h6 class="date font-weight-900 mb-0" style="width: 100%;">
                                                    @if ($attendance && $attendance->check_out_time)
                                                        <!-- Calculate and display the work duration when checked in and out -->
                                                        {{ getWorkDuration($attendance->check_in_time, $attendance->check_out_time) }}
                                                    @elseif ($attendance && $attendance->check_in_time)
                                                        <!-- Live timer when checked in but not checked out -->
                                                        <span class="liveTimer"></span>
                                                    @endif
                                                </h6>
                                            </a>
                                        </li>
                                        @if ($attendance && $attendance->check_out_time === null)
                                        @else
                                            <li class="m-2">
                                                <a href="{{ route('attendance.check-in') }}" class="btn theme-button">Check
                                                    In</a>
                                            </li>
                                        @endif
                                        @if ($attendance && $attendance->check_out_time !== null)
                                        @elseif ($attendance && $attendance->check_out_time === null && $attendance->check_in_time !== null)
                                            <li class="m-2">
                                                <a href="{{ route('attendance.check-out') }}" class="btn theme-button">Check
                                                    Out</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <ul>
                                        <li>
                                            <form action="{{ route('break.store') }}" method="post">
                                                @csrf
                                                <div class="form-group d-flex">

                                                    <input type="text" class="form-control" name="note"
                                                        placeholder="Break note">
                                                    <button class="ms-2 btn theme-button">break</button>
                                                </div>
                                            </form>
                                        </li>
                                        <li class="m-2">
                                            <a href="{{ route('break.back') }}" class="btn theme-button">break Back</a>
                                        </li>
                                    </ul>




                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
