<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->latest()->first();

        if ($attendance && $attendance->check_out_time === null) {
            // Already checked in, show message or perform any other action
            return redirect()->back()->with('message', 'Already checked in.');
        }

        $newAttendance = new Attendance();
        $newAttendance->check_in_time = now();
        $newAttendance->user_id = $user->id;
        $newAttendance->save();

        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->latest()->first();

        if (!$attendance || $attendance->check_out_time !== null) {
            // Not checked in yet, show message or perform any other action
            return redirect()->back()->with('message', 'Not checked in yet.');
        }

        $attendance->check_out_time = now();
        $attendance->save();

        return redirect()->back();
    }
}
