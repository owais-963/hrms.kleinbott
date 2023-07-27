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
        $attendance = Attendance::where(['user_id' => $user->id])->latest()->first();
        if ($attendance && $attendance->check_out_time != null) {
            // Already checked in, show message or perform any other action
            return redirect()->back()->with('error', 'Already checked in.');
            ;
        }

        if (!$attendance) {
            // No check-in record exists for the current date, create a new one
            $newAttendance = Attendance::create([
                'check_in_time' => Carbon::now(),
                'date' => Carbon::today(),
                'user_id' => $user->id,
            ]);

            dispatch(new sendCheckInEmailJob($newAttendance, $user->username));

            return redirect()->back()->with('success', 'Check-in successful');
        }


        return redirect()->back()->with('error', 'You have a pending check-in from a previous date.');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->latest()->first();

        if (!$attendance || $attendance->check_out_time !== null) {
            return redirect()->back()->with('error', 'Not checked in yet or already checked out.');
        }

        $attendance->update([
            'check_out_time' => now(),
        ]);

        dispatch(new sendCheckOutEmailJob($attendance, $user->username));

        return redirect()->back()->with('success', 'Check-out successful');
    }
}