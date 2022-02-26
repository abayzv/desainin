<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Employees = Employee::paginate('10');
        return view('employees.index', compact(['Employees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Companies = Company::all();
        return view('employees.create', compact(['Companies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $Validated = $request->validate([
        'firstName' => 'required',
        'lastName' => 'required',
        'company' => 'required'
      ]);
      
      Employee::create([
        'first_name' => $request->firstName,
        'last_name' => $request->lastName,
        'company_id' => $request->company,
        'phone' => $request->phone,
        'email' => $request->email,
      ]);

      return redirect('/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Companies = Company::all();
      $Employee = Employee::find($id);
      return view('employees.edit', compact(['Employee', 'Companies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $Validated = $request->validate([
        'firstName' => 'required',
        'lastName' => 'required',
        'company' => 'required'
      ]);

      Employee::where('id', $id)->update([
        'first_name' => $request->firstName,
        'last_name' => $request->lastName,
        'company_id' => $request->company,
        'phone' => $request->phone,
        'email' => $request->email,
      ]);
      return redirect(route('employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        return redirect('/employees');
    }
}

