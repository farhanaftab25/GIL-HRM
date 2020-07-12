<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::latest('id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate([
            'employee_id' => 'required|unique:employees|max:255',
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:employees',
            'cnic' => 'required|integer|digits:13',
            'phone_number' => 'required|numeric|digits:11',
            'address' => 'required',
            'salary' => 'required|integer',
            'designation_id' => 'required',
            'avatar' => 'required|file'
        ]);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars', 'public');
        }
        $employee = Employee::create($attributes);
        return redirect(route('employees.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Employee $employee)
    {
        $attributes = request()->validate([
            'employee_id' => ['required', 'max:255', Rule::unique('employees')->ignore($employee)],
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($employee)],
            'cnic' => 'required|integer|digits:13',
            'phone_number' => 'required|numeric|digits:11',
            'address' => 'required',
            'salary' => 'required|integer',
            'designation_id' => 'required',
            'avatar' => 'required|file'
        ]);

        if (request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars', 'public');
        }
        $employee->update($attributes);
        return redirect(route('employees.show', $employee->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Storage::disk('public')->delete($employee->avatar);
        $employee->delete();
        return redirect(route('employees.index'))->with('message', 'Successfully Deleted');
    }
}
