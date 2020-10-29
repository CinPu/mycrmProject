<?php

namespace App\Http\Controllers;

use App\agent;
use App\company;
use App\department;
use App\department_head;
use App\employee;
use App\position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depts=department::with("department_head")->where("admin_uuid",Auth::user()->uuid)->get();
        $agents=agent::with("user")->where("admin_id",Auth::user()->id)->get();
        $positions=position::all();

        $lastProject        =   employee::orderBy('created_at', 'desc')->where("admin_id",Auth::user()->id)->first();
        $company=company::where("admin_id",Auth::user()->id)->first();
//        dd($company);
        if (isset($lastProject)) {
            // Sum 1 + last id
            $lastProject->employee_id ++;
            $emp_id = $lastProject->employee_id;
        } else {
            $emp_id= $company->company_short_form."-00001";
        }
        $employee=employee::with("employee_user","report_to_user","department","company","position")->where("admin_id",Auth::user()->id)->get();
//        dd($employee);
        return view("Employee.employee",compact("positions","depts","company","agents","emp_id","employee"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users=User::where("email",$request->email)->first();
        if($users==null) {
//        dd($request->all());
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->uuid = $request->uuid;
            $user->save();
            $employee = new employee();
            $employee->employee_id = $request->emp_id;
            $employee->report_to = $request->report_to;
            $employee->dept_id = $request->department;
            $employee->emp_id = $user->id;
            $employee->emp_post = $request->position;
            $employee->admin_id = Auth::user()->id;
            $employee->company_id = $request->company;
            $employee->join_date = $request->join_date;
            $employee->phone = $request->phone;
            $employee->save();
            $user->assignRole("Employee");
            return redirect()->back()->with("message","Successful");
        }else{
            return redirect()->back()->with("delete","Email already Exist");
        }


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
