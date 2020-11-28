<?php

namespace App\Http\Controllers;

use App\agent;
use App\company;
use App\department;
use App\department_head;
use App\employee;
use App\Imports\employee_import;
use App\position;
use App\ticket;
use App\ticketFollower;
use App\User;
use App\user_employee;
use App\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response o
     */
    public function index()
    {
        $depts=department::with("department_head")->where("admin_uuid",Auth::user()->uuid)->get();
        $employees=employee::with("report_to_user","department","company","position")->where("admin_id",Auth::user()->id)->get();
        $positions=position::all();
        $lastemployee        =   employee::orderBy('created_at', 'desc')->where("admin_id",Auth::user()->id)->first();
        $company=company::where("admin_id",Auth::user()->id)->first();
        if (isset($lastemployee)) {
            // Sum 1 + last id
            $lastemployee->employee_id ++;
            $emp_id = $lastemployee->employee_id;
        } else {
            $emp_id= $company->company_short_form."-00001";
        }
        $roles= $roles=Role::all();
        $report_to=[];
        foreach ($employees as $emp){
            $user_emp=user_employee::with("user")->where("emp_id",$emp->id)->first();
            if($user_emp!=null){
                array_push($report_to,$user_emp);
            }
        }

        return view("Employee.employee",compact("positions","depts","company","employees","emp_id","roles","report_to"));
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
            $employee = new employee();
            $employee->employee_id = $request->emp_id;
            $employee->name=$request->name;
            $employee->marital_status=$request->marital_status;
            $employee->email=$request->email;
            $employee->report_to = $request->report_to;
            $employee->dept_id = $request->department;
            $employee->emp_post = $request->position;
            $employee->gender=$request->gender;
            $employee->nrc=$request->nrc;
            $image = $request->profile;
            if($image!=null) {
                $name = $image->getClientOriginalName();
                $request->profile->move(public_path() . '/profile/', $name);
                $employee->emp_profile = $name;
            }
            $employee->nationality=$request->nationality;
            $employee->admin_id = Auth::user()->id;
            $employee->company_id = $request->company;
            $employee->join_date = Carbon::create($request->join_date);
            $employee->phone = $request->phone;
            $employee->dept_head=$request->dept_head;
            $employee->save();
            if($request->login=="on") {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->uuid = $request->uuid;
                $user->save();
                $user->assignRole("$request->role");
                $user_emp=new user_employee();
                $user_emp->user_id=$user->id;
                $user_emp->emp_id=$employee->id;
                $user_emp->save();
            }
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
    public function edit($emp_id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$edit_type,$emp_id)
    {

        $employee=employee::where("id",$emp_id)->first();
//        dd($employee);
        if($edit_type=="profile"){
            $employee->employee_id=$request->emp_id;
            $employee->name=$request->name;
            $employee->email=$request->email;
            $employee->phone= $request->phone;
            if($request->join_date!=null) {
                $employee->join_date = Carbon::create($request->join_date);
            }
            $employee->dept_id=$request->dept;
            $employee->emp_post=$request->position;
            $employee->report_to=$request->report_to;
            $employee->address=$request->address;
            $image = $request->profile;
            if($image!=null) {
                $name = $image->getClientOriginalName();
                $request->profile->move(public_path() . '/profile/', $name);
                $employee->emp_profile = $name;
            }
            $employee->update();
            return redirect()->back()->with("message", "Successful");
        }elseif ($edit_type=="personal"){
            $employee->nrc=$request->nrc;
            $employee->nationality=$request->nationality;
            $employee->gender=$request->gender;
            if($request->dob!=null) {
                $employee->dob = $request->dob;
            }
            $employee->religion=$request->religion;
            $employee->marital_status=$request->marital_status;
            $employee->update();
            return redirect()->back()->with("message", "Successful");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($emp_id)
    {
//
       $employee=employee::where("id",$emp_id)->first();
       $employee->delete();
       return redirect()->back()->with("delete","Employee Delete Successful!");
    }
    public function profile($emp_id){
        $emp_details=employee::with("report_to_user","company","position","dept")->where("id",$emp_id)->first();
//        dd($emp_details);
        if($emp_details->report_to_user->hasAnyRole("Admin")){
            $pp=$emp_details->report_to_user->profile;
        }else{
            $user_emp=user_employee::with("employee")->where("user_id",$emp_details->report_to)->first();
            $pp=$user_emp->employee->emp_profile;
        }
        $admin=User::where("id",$emp_details->admin_id)->first();
        $positions=position::get();
        $depts=department::where("admin_uuid",$admin->uuid)->get();
        $employees=employee::with("report_to_user")->where("admin_id",Auth::user()->id)->get();
        $report_to=[];
        foreach ($employees as $emp){
            $user_emp=user_employee::with("user")->where("emp_id",$emp->id)->first();
            if($user_emp!=null && $user_emp->emp_id!=$emp_id){
                array_push($report_to,$user_emp);
            }
        }
        return view("Employee.profile",compact("emp_details","pp","positions","depts","report_to"));
    }
    public function tagticket(){
        $followingTickets=ticketFollower::where("emp_id",Auth::user()->id)->get();
        $follow_tickets=[];
        foreach ($followingTickets as $ticket){
            $ticket=ticket::with("priority_type","cases","status_type")->where("id",$ticket->ticket_id)->first();
           array_push($follow_tickets,$ticket);
        }
        $user_emp=user_employee::where("user_id",Auth::user()->id)->first();
        $admin_uuid=employee::with("admin")->where("id",$user_emp->emp_id)->first();

        return view("Employee.employeeTagticket",compact("follow_tickets","admin_uuid"));
    }
    public function emp_Import(){
        Excel::import(new employee_import(),request()->file('file'));
        return back();
    }
    public function filterResult(Request $request){
        $date=explode("-",$request->daterange);
        $start_date=Carbon::create($date[0]);
        $end_date=Carbon::create($date[1]);
        $employees=employee::with("position")->orWhere("emp_post",$request->position)->orWhere("employee_id",$request->employee_id)->orwhere('name', 'LIKE', "%$request->employee_name%")
            ->orWhereBetween("join_date",[$start_date,$end_date])->get();
        return view("Employee.employeeFilterResult",compact("employees"));

    }
}
