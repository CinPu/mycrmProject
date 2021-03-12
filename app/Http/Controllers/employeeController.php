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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
       if(Auth::user()->hasAnyRole("Admin"))
       {
           $employees=employee::with("report_to_user","department","company","position")->where("admin_id",Auth::user()->id)->get();
       }else{
           $emp_user=user_employee::where("user_id",Auth::user()->id)->first();
           $admin=employee::where("id",$emp_user->id)->first();
           $employees=employee::with("report_to_user","department","company","position")->where("admin_id",$admin->admin_id)->get();
       }
        $positions=position::all();
        $lastemployee        =   employee::orderBy('created_at', 'desc')->where("admin_id",Auth::user()->id)->first();
        $company=company::where("admin_id",Auth::user()->id)->where("is_admin_company",1)->first();
        if (isset($lastemployee)) {
            // Sum 1 + last id
            $lastemployee->employee_id ++;
            $emp_id = $lastemployee->employee_id;
        } else {
            $emp_id= "Emp"."-00001";
        }
        $roles= $roles=Role::all();
        $report_to=[];
        foreach ($employees as $emp){
            $user_emp=user_employee::with("user")->where("emp_id",$emp->id)->first();
            if($user_emp!=null){
                array_push($report_to,$user_emp);
            }
        }
if(Auth::user()->hasAnyRole("Admin")){
    return view("Employee.employee",compact("positions","depts","company","employees","emp_id","roles","report_to"));
}else{
    return view("Employee.allemp",compact("employees","positions"));
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

            $validator = Validator::make($request->all(), [
                "email" => "required|email|unique:employees",
                "name"=>"required",
                "phone"=>"required|min:11",

            ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
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
            if($employee->dept_id!=$request->dept) {
                $employee->dept_id = $request->dept;
                $user_emp=user_employee::where("emp_id",$emp_id)->first();
                $agent=agent::where("agent_id",$user_emp->user_id)->first();
                $agent->dept_id=$request->dept;
                $agent->update();
            }
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
        $user_emp=user_employee::where("emp_id",$emp_id)->first();
       $user=User::where("id",$user_emp->user_id)->first();
       $user->delete();
       $employee=employee::where("id",$emp_id)->first();
       $employee->delete();
       return redirect()->back()->with("delete","Employee Delete Successful!");
    }
    public function profile($emp_id){
        $emp_details=employee::with("report_to_user","company","position","dept")->where("id",$emp_id)->first();
//        dd($emp_details);
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
        if($emp_details->report_to_user->hasAnyRole("Admin")){
            $pp=$emp_details->report_to_user->profile;
        }else{
            $user_emp=user_employee::with("employee")->where("user_id",$emp_details->report_to)->first();
            $pp=$user_emp->employee->emp_profile;
        }

        return view("Employee.profile",compact("emp_details","pp","positions","depts","report_to"));
    }
    public function tagticket(){
        $user_Emp=\App\user_employee::with("employee","user")->get();
        $authuser=\App\user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
        $ticket_admin=[];
        foreach ($user_Emp as $tikerAdmin){
            if($tikerAdmin->user->hasAnyRole("TicketAdmin") && $tikerAdmin->employee->admin_id==$authuser->employee->admin_id){
                array_push($ticket_admin,$tikerAdmin);
            }
        }
        $followingTickets=ticketFollower::where("emp_id",Auth::user()->id)->get();
        $follow_tickets=[];
        foreach ($followingTickets as $ticket){
            $ticket=ticket::with("priority_type","cases","status_type")->where("id",$ticket->ticket_id)->first();
           array_push($follow_tickets,$ticket);
        }
        $user_emp=user_employee::where("user_id",Auth::user()->id)->first();
        $admin_uuid=employee::with("admin")->where("id",$user_emp->emp_id)->first();

        return view("Employee.employeeTagticket",compact("follow_tickets","admin_uuid","ticket_admin"));
    }
    public function emp_Import(){
        Excel::import(new employee_import(),request()->file('file'));
        return back();
    }
    public function filterResult(Request $request){
//        dd($request->all());
        $start_date=Carbon::create($request->start_date);
        $end_date=Carbon::create($request->end_date);
        if($request->position!="empty" && $request->employee_id!=null&& $request->employee_name!=null && $request->start_date!=null && $request->end_date!=null) {
            $employees = employee::with("position")->where("emp_post", $request->position)->where("employee_id", $request->employee_id)->where('name', $request->employee_name)
                ->whereBetween("join_date", [$start_date, $end_date])->get();

            }elseif ($request->position=="empty" && $request->employee_id==null&& $request->employee_name==null && $request->start_date==null && $request->end_date==null){
            return redirect()->back();
        }else{
            if ($request->position=="empty" && $request->employee_id!=null&& $request->employee_name!=null && $request->start_date!=null){
//                    dd("search by id name and join_date");
                $employees = employee::with("position")->where("employee_id", $request->employee_id)->where('name', $request->employee_name)
                    ->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position=="empty" && $request->employee_id==null&& $request->employee_name==null && $request->start_date!=null){
//                dd("search by date");
                $employees = employee::with("position")->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position=="empty" && $request->employee_id==null&& $request->employee_name!=null && $request->start_date==null){
//                dd("search name");
                $employees = employee::with("position")->where('name', $request->employee_name)->get();
            }elseif  ($request->position=="empty" && $request->employee_id!=null&& $request->employee_name==null && $request->start_date==null){
//                dd("search by id");
                $employees = employee::with("position")->where("employee_id", $request->employee_id)->get();
            }elseif  ($request->position!="empty" && $request->employee_id==null&& $request->employee_name==null && $request->start_date==null){
//                dd("search by position");
                $employees = employee::with("position")->where("emp_post", $request->position)->get();
            } elseif  ($request->position!="empty" && $request->employee_id==null&& $request->employee_name!=null && $request->start_date!=null){
//           dd("search by position, name ,and join date");
                $employees = employee::with("position")->where("emp_post", $request->position)->where('name', $request->employee_name)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position!="empty" && $request->employee_id!=null&& $request->employee_name==null && $request->start_date!=null){
//                dd("search by position,id and join date");
                $employees = employee::with("position")->where("emp_post", $request->position)->where("employee_id", $request->employee_id)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position!="empty" && $request->employee_id!=null&& $request->employee_name!=null && $request->start_date==null){
//                dd("search by position ,id and name");
                $employees = employee::with("position")->where("emp_post", $request->position)->where("employee_id", $request->employee_id)->where('name', $request->employee_name)->get();
            }elseif  ($request->position=="empty" && $request->employee_id==null&& $request->employee_name!=null && $request->start_date!=null){
//                dd("search by name and join date");
                $employees = employee::with("position")->where('name', $request->employee_name)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position=="empty" && $request->employee_id!=null&& $request->employee_name==null && $request->start_date!=null){
//                dd("search by id and join date");
                $employees = employee::with("position")->where("employee_id", $request->employee_id)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position=="empty" && $request->employee_id!=null&& $request->employee_name!=null && $request->start_date==null){
//                dd("search by id and name");
                $employees = employee::with("position")->where("employee_id", $request->employee_id)->where('name', $request->employee_name)->get();
            }elseif  ($request->position=="empty" && $request->employee_id==null&& $request->employee_name!=null && $request->start_date!=null){
//                dd("name and join date");
                $employees = employee::with("position")->where('name', $request->employee_name)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position!="empty" && $request->employee_id==null&& $request->employee_name==null && $request->start_date!=null){
//                dd("date and position");
                $employees = employee::with("position")->where("emp_post", $request->position)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position!="empty" && $request->employee_id==null&& $request->employee_name!=null && $request->start_date==null){
//                dd("search by position and name");
                $employees = employee::with("position")->where("emp_post", $request->position)->where('name', $request->employee_name)->get();
            }elseif  ($request->position=="empty" && $request->employee_id!=null&& $request->employee_name==null && $request->start_date!=null){
//                dd("search by id and date");
                $employees = employee::with("position")->where("employee_id", $request->employee_id)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position!="empty" && $request->employee_id==null&& $request->employee_name==null && $request->start_date!=null){
//                dd("position and date");
                $employees = employee::with("position")->where("emp_post", $request->position)->whereBetween("join_date", [$start_date, $end_date])->get();
            }elseif  ($request->position!="empty" && $request->employee_id!=null&& $request->employee_name==null && $request->start_date==null){
//                dd("position and id");
                $employees = employee::with("position")->where("emp_post", $request->position)->where("employee_id", $request->employee_id)->get();
            }

        }
        return view("Employee.employeeFilterResult",compact("employees"));

    }
}
