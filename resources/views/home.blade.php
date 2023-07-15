@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome  {{ Auth::user()->name }}</div>

                    <div class="card-body">
                        <div class="container">
                            <h2>Check-in/Check-out System</h2>

                            @if (session('message'))
                                <div class="alert alert-info">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if ($attendance && $attendance->check_out_time === null)
                                <p>Checked in: {{ $attendance->check_in_time }}</p>
                            @else
                                <form method="POST" action="{{ route('attendance.check-in') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Check-in</button>
                                </form>
                            @endif

                            @if ($attendance && $attendance->check_out_time !== null)
                                <p>Checked out: {{ $attendance->check_out_time }}</p>
                            @elseif ($attendance && $attendance->check_out_time === null && $attendance->check_in_time !== null)
                                <form method="POST" action="{{ route('attendance.check-out') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Check-out</button>
                                </form>
                            @endif
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
