<?php

namespace App\Http\Controllers;

use App\Jobs\sendCheckInEmailJob;
use App\Jobs\sendCheckOutEmailJob;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Add this import statement


class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $attendance = Attendance::where(['user_id' => $user->id, 'date' => Carbon::today()])->latest()->first();

        if ($attendance && $attendance->check_out_time === null) {
            // Already checked in, show message or perform any other action
            Session::flash('toast', ['type' => 'error', 'message' => 'Already checked in.']);
            return redirect()->back();
        }

        if (!$attendance) {
            // No check-in record exists for the current date, create a new one
            $newAttendance = Attendance::create([
                'check_in_time' => now(),
                'date' => Carbon::today(),
                'user_id' => $user->id,
            ]);

            dispatch(new sendCheckInEmailJob($newAttendance, $user->username));

            Session::flash('toast', ['type' => 'success', 'message' => 'Check-in successful!']);
            return redirect()->back();
        }


        Session::flash('toast', ['type' => 'error', 'message' => 'You have a pending check-in from a previous date.']);
        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->latest()->first();

        if (!$attendance || $attendance->check_out_time !== null) {
            Session::flash('toast', ['type' => 'error', 'message' => 'Not checked in yet or already checked out.']);
            return redirect()->back();
        }

        $attendance->update([
            'check_out_time' => now(),
        ]);

        dispatch(new sendCheckOutEmailJob($attendance, $user->username));

        Session::flash('toast', ['type' => 'success', 'message' => 'Check-out successful!']);
        return redirect()->back();
    }
}