<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            return;
        }

        $shiftTimes = [
            'Pagi' => ['06:00', '14:00'],
            'Siang' => ['14:00', '22:00'],
            'Malam' => ['22:00', '06:00'],
        ];

        $shiftNames = array_keys($shiftTimes);
        $today = Carbon::today();

        foreach ($employees as $index => $employee) {
            $shiftName = $shiftNames[$index % count($shiftNames)];
            [$start, $end] = $shiftTimes[$shiftName];

            Shift::create([
                'employee_id' => $employee->id,
                'shift_name' => $shiftName,
                'date' => $today->format('Y-m-d'),
                'start_time' => $start,
                'end_time' => $end,
            ]);

            $shiftNameBesok = $shiftNames[($index + 1) % count($shiftNames)];
            [$startBesok, $endBesok] = $shiftTimes[$shiftNameBesok];

            Shift::create([
                'employee_id' => $employee->id,
                'shift_name' => $shiftNameBesok,
                'date' => $today->copy()->addDay()->format('Y-m-d'),
                'start_time' => $startBesok,
                'end_time' => $endBesok,
            ]);
        }
    }
}
