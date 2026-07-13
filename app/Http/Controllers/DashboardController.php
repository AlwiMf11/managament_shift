<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the application dashboard.
     */
    public function index()
    {
        $totalKaryawan = Employee::count();
        $totalJadwal = Shift::count();
        $shiftHariIni = Shift::with('employee')
            ->whereDate('date', Carbon::today())
            ->orderBy('start_time')
            ->get();

        return view('dashboard', compact('totalKaryawan', 'totalJadwal', 'shiftHariIni'));
    }
}
