<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\EmployeeRec;
use App\Http\Requests\EmployeeRecUpdate;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }
    public function display()
    {
        $employees = User::all();
        return view('admin.employee')->with( ['employees' => $employees] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRec $request)
    {
      $request->validated();
      $user =  User::create([
            'employee_id' => $request->employee_id,
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('admin.display')->with('success', 'Employee Has Been Created Successfully');
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
        $employee = User::find($id);
        $employee->employee_id = request('employee_id');
        $employee->username = request('username');
        $employee->first_name = request('first_name');
        $employee->last_name = request('last_name');
        $employee->position = request('position');
        $employee->password = Hash::make(request('password'));
        $save = $employee->save();

        if( $save ){
            return redirect()->route('admin.display')->with('success', 'Employee Has Been Updated Successfully');
          }else{
            return redirect()->route('admin.display')->with('error', 'Something went wrong, failed to update');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee)
    {
        $employee = user::where('id', $employee->id)->delete();
        return redirect()->route('admin.display')->with('success', 'Employee Has Been Deleted Successfully');
    }
}