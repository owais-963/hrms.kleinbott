<?php

namespace App\Http\Controllers;

use App\Jobs\EndBreakJob;
use App\Jobs\sendCheckInEmailJob;
use App\Jobs\sendCheckOutEmailJob;
use App\Jobs\StartBreakJob;
use App\Models\Attendance;
use App\Models\User;
use App\Models\UserBreak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Add this import statement


class AttendanceController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->latest()->first();
        $breaks = UserBreak::where([
            'attendance_id' => $attendance->id,
            'user_id' => $user->id,
        ])->latest()->get();


        $attendance_all = Attendance::where('user_id', $user->id)->latest()->get();
        return view('attendance', compact('attendance', 'attendance_all'));
    }
    public function getCalendarData(Request $request)
    {
        $selectedMonth = $request->input('month', date('m'));
        $startDate = Carbon::createFromDate(date('Y'), $selectedMonth, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $attendance_all = Attendance::where('user_id', Auth::user()->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();
        // dd($attendance_all);

        return view('calendar_data', compact('attendance_all', 'selectedMonth'));
    }
    public function checkIn(Request $request)
    {
        $user = User::with('shift')->find(Auth::user()->id);

        $attendance = Attendance::where(['user_id' => $user->id, 'date' => Carbon::today()])->latest()->first();
        if ($attendance && $attendance->check_out_time != null) {
            // Already checked in, show message or perform any other action
            return redirect()->back()->with('error', 'Already checked in.');;
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
            'check_out_time' => Carbon::now(),
        ]);

        dispatch(new sendCheckOutEmailJob($attendance, $user->username));

        return redirect()->back()->with('success', 'Check-out successful');
    }

    function save_note(Request $request)
    {
        $user = Auth::user();
        $attendance = Attendance::find($request->attendance_id);

        $attendance->update([
            'note' => $request->note,
        ]);
   
        return redirect()->back()->with('success', 'note successful');

        // dispatch(new sendCheckOutEmailJob($attendance, $user->username));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Find the latest attendance record for the current day
        $attendance = Attendance::where(['user_id' => $user->id, 'date' => Carbon::today()])->latest()->first();

        // Check if a check-in has been made for the current day
        if ($attendance && $attendance->check_in_time !== null) {
            // Check if a break is already ongoing
            $break = UserBreak::where(['user_id' => $user->id, 'attendance_id' => $attendance->id,])->latest()->first();

            if ($break && $break->break_start_time && !$break->break_end_time) {
                return redirect()->back()->with('error', 'You have a pending break from a previous date.');
            }

            // Create a new UserBreak instance for the current user and date
            $break =    UserBreak::create([
                'attendance_id' => $attendance->id,
                'user_id' => $user->id,
                'start_time' => Carbon::now(),
                'note' => $request->note,
            ]);

            StartBreakJob::dispatch($break, $user); // Replace $user with the actual user

            return redirect()->back()->with('success', 'Break started successfully.');
        } else {
            return redirect()->back()->with('error', 'You cannot start a break without first checking in.');
        }
    }


    public function back(Request $request)
    {
        $user = Auth::user();

        // Find the latest attendance record for the current day
        $attendance = Attendance::where(['user_id' => $user->id, 'date' => Carbon::today()])->latest()->first();

        // Check if a check-in has been made for the current day
        if ($attendance && $attendance->check_in_time !== null) {
            // Check if a break is ongoing
            $break = UserBreak::where(['user_id' => $user->id, 'attendance_id' => $attendance->id,])->latest()->first();
            if ($break && $break->start_time && !$break->end_time) {
                // Update the ongoing break with the end time
                $break->update([
                    'end_time' =>  Carbon::now(),
                ]);
                EndBreakJob::dispatch($break, $user); // Replace $user with the actual user

                return redirect()->back()->with('success', 'Break ended successfully.');
            } else {
                return redirect()->back()->with('error', 'There is no ongoing break to end.');
            }
        } else {
            return redirect()->back()->with('error', 'You cannot end a break without first checking in.');
        }
    }
}
