<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the shifts.
     */
    public function index()
    {
        $shifts = Shift::with('employee')->latest('date')->get();

        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new shift.
     */
    public function create()
    {
        $employees = Employee::orderBy('name')->get();

        return view('shifts.create', compact('employees'));
    }

    /**
     * Store a newly created shift in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        Shift::create($request->all());

        return redirect()->route('shifts.index')
            ->with('success', 'Jadwal shift berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified shift.
     */
    public function edit(Shift $shift)
    {
        $employees = Employee::orderBy('name')->get();

        return view('shifts.edit', compact('shift', 'employees'));
    }

    /**
     * Update the specified shift in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        $request->validate($this->rules(), $this->messages());

        $shift->update($request->all());

        return redirect()->route('shifts.index')
            ->with('success', 'Jadwal shift berhasil diperbarui.');
    }

    /**
     * Remove the specified shift from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('shifts.index')
            ->with('success', 'Jadwal shift berhasil dihapus.');
    }

    /**
     * Get the validation rules for shift data.
     *
     * @return array
     */
    private function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'shift_name' => 'required|in:Pagi,Siang,Malam',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }

    /**
     * Get custom validation messages in Indonesian.
     *
     * @return array
     */
    private function messages()
    {
        return [
            'employee_id.required' => 'Karyawan wajib dipilih.',
            'employee_id.exists' => 'Karyawan yang dipilih tidak valid.',
            'shift_name.required' => 'Nama shift wajib dipilih.',
            'shift_name.in' => 'Nama shift harus Pagi, Siang, atau Malam.',
            'date.required' => 'Tanggal wajib diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'start_time.required' => 'Jam mulai wajib diisi.',
            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
        ];
    }
}
