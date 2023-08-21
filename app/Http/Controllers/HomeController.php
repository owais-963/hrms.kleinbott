<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)->latest()->first();
        $attendance_all = Attendance::where('user_id', $user->id)->latest()->get();
        return view('home', compact('attendance', 'attendance_all'));
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
}
