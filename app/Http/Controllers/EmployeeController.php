<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::with('position')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('employees.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:employees',
            'phone' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
        ]);

        Employee::create($request->only(['name', 'email', 'phone', 'position_id']));

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        $employee->load('position');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'position_id' => 'required|exists:positions,id',
        ]);

        $employee->update($request->only(['name', 'email', 'phone', 'position_id']));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}