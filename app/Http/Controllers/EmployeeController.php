<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate($this->rules(), $this->messages());

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }

    /**
     * Get the validation rules for employee data.
     *
     * @return array
     */
    private function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
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
            'name.required' => 'Nama karyawan wajib diisi.',
            'position.required' => 'Posisi karyawan wajib diisi.',
            'department.required' => 'Departemen wajib diisi.',
            'phone.required' => 'No. telepon wajib diisi.',
            'phone.max' => 'No. telepon maksimal 20 karakter.',
        ];
    }
}
