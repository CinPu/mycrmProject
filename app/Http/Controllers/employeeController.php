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
        $employees=employee::with("employee_user","report_to_user","department","company","position")->where("admin_id",Auth::user()->id)->get();
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
        return view("Employee.employee",compact("positions","depts","company","employees","emp_id","roles"));
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
            $name = $image->getClientOriginalName();
            $request->profile->move(public_path() .'/profile/', $name);
            $employee->emp_profile = $name;
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
        $positions=position::all();
        $depts=department::with("department_head")->where("admin_uuid",Auth::user()->uuid)->get();
        $employees=employee::with("employee_user","report_to_user","department","company","position")->where("emp_id",$emp_id)->first();
        $allemp=employee::with("employee_user")->where("admin_id",Auth::user()->id)->get();
        return view("Employee.emp_edit",compact("employees","positions","depts","allemp"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $emp_id)
    {
//        dd($request->all());
            $user = User::where("id", $emp_id)->first();
            $user->name = $request->emp_name;
            $user->email = $request->email;
            $user->update();
            $employee = employee::where("emp_id", $emp_id)->first();
            $employee->employee_id = $request->emp_id;
            $employee->report_to = $request->report_to;
            $employee->dept_id = $request->department;
            $employee->emp_id = $user->id;
            $employee->emp_post = $request->emp_post;
            $employee->company_id = $request->company;
            $employee->join_date = Carbon::create($request->join_date);
            $employee->phone = $request->phone;
            if ($request->dept_head != null) {
                $employee->dept_head = $request->dept_head;
            }
            if ($request->address != null) {
                $employee->address = $request->address;
            }
            $employee->dob = $request->dob;
            $employee->update();
            return redirect()->back()->with("message", "Successful");
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
       $employee=employee::where("emp_id",$emp_id)->first();
//       dd($employee);
       $employee->delete();
        $user=User::where("id",$emp_id)->first();
       $user->delete();
       return redirect()->back()->with("delete","Employee Delete Successful!");
    }
    public function profile($emp_id){
        $emp_details=employee::with("report_to_user","company","position","dept")->where("id",$emp_id)->first();
//        dd($emp_details);
        if($emp_details->report_to_user->hasAnyRole("Admin")){
            $pp=$emp_details->report_to_user->profile;
        }else{
            $pp=$emp_details->emp_profile;
        }
        return view("Employee.profile",compact("emp_details","pp"));
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
        $employees=employee::with("position")->orWhere("emp_post",$request->position)->orWhere("employee_id",$request->employee_id)->orWhere("name",$request->employee_name)->orWhereBetween("join_date",[$start_date,$end_date])->get();
        return view("Employee.employeeFilterResult",compact("employees"));

    }
}
