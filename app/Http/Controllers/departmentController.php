<?php

namespace App\Http\Controllers;

use App\agent;
use App\company;
use App\department;
use App\department_head;
use App\deptart_head;
use App\employee;
use App\Imports\dept_import;
use App\position;
use App\User;
use App\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents=agent::with("user")->where("admin_id",Auth::user()->id)->get();
        $depts=department::with("department_head")->where("admin_uuid",Auth::user()->uuid)->get();
        $lastedept=   department::with("department_head")->orderBy('created_at', 'desc')->where("admin_uuid",Auth::user()->uuid)->first();
        $company=company::where("admin_id",Auth::user()->id)->first();
//        dd($company);
        if (isset($lastedept)) {
            // Sum 1 + last id
            $lastedept->dept_id ++;
            $dept_id = $lastedept->dept_id;
        } else {
            $dept_id= $company->company_short_form."-Dept"."-00001";
        }
        $positions=position::all();

        $lastemployee        =   employee::orderBy('created_at', 'desc')->where("admin_id",Auth::user()->id)->first();
        $company=company::where("admin_id",Auth::user()->id)->first();
//        dd($company);
        if (isset($lastemployee)) {
            // Sum 1 + last id
            $lastemployee->employee_id ++;
            $emp_id = $lastemployee->employee_id;
        } else {
            $emp_id= $company->company_short_form."-00001";
        }
        return view("userAdmin.department",compact("depts","agents","dept_id","emp_id","positions","company"));
    }
    public function set_dept_head(Request $request,$id){
        if($request->dept_head!=0) {
            $dept_head = department::where("id", $id)->first();
            $dept_head->dept_head = $request->dept_head;
            $dept_head->update();
            return redirect()->back()->with("message", "Setup Department Head Successful");
        }else{
            return redirect()->back()->with("delete","You need to create Agent First!");
        }
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
//        dd($request->all());
        $users=User::where("email",$request->email)->first();
        if($users==null) {
//        dd($request->all());
            $user = new User();
            $user->name = $request->dept_headName;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->uuid = $request->uuid;
            $user->save();
            $lastuser=User::orderBy('created_at', 'desc')->first();
            $dept=new department();
            $dept->dept_name=$request->dept_name;
            $dept->dept_id=$request->dept_id;
            $dept->admin_uuid=Auth::user()->uuid;
            $dept->dept_head=$user->id;
            $dept->save();

            $employee = new employee();
            $employee->employee_id = $request->emp_id;
            $employee->report_to = Auth::user()->id;
            $employee->dept_id =$dept->id;
            $employee->emp_id = $user->id;
            $employee->emp_post = $request->position;
            $employee->admin_id = Auth::user()->id;
            $employee->company_id = $request->company;
            $employee->join_date = $request->join_date;
            $employee->phone = $request->phone;
            $employee->dept_head=Auth::user()->id;
            $employee->save();
            $user->assignRole("Employee");
        }else{
            return redirect()->back()->with("delete","Your Email is already Exists");
        }

        return redirect()->back()->with("message","Successful");
    }
    public function dept_change(Request $request,$id)
    {
        $dept=employee::where("emp_id",$id)->first();
        $dept->dept_id=$request->dept_change;
        $dept->update();
        $agent_dept=agent::where("agent_id",$id)->first();
        $agent_dept->dept_id=$request->dept_change;
        $agent_dept->update();
        return redirect()->back()->with("message","Update Successful!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMember($id)
    {
        $members=employee::with("employee_user")->where("dept_id",$id)->get();
        $dept=department::where("id",$id)->first();
        $user_profile=userprofile::all();
//        dd($members);
        return view("userAdmin.deptMember",compact("members","dept","user_profile"));
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
        $dept=department::where("id",$id)->first();
        $dept->dept_name=$request->dept_name;
        $dept->update();
        return redirect()->back()->with("message","Your Upadated is Successful");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept=department::where("id",$id)->first();
        $dept->delete();
        return redirect()->back()->with("delete","Delete Successful");
    }
    public function import(){
        Excel::import(new dept_import(),request()->file('file'));
        return back();
    }
}
