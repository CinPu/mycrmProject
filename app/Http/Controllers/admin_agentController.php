<?php

namespace App\Http\Controllers;

use App\agent;
use App\assign_ticket;
use App\case_type;
use App\department;
use App\employee;
use App\solvedTime;
use App\ticket;
use App\User;
use App\user_employee;
use App\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class admin_agentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees=[];
        $agents=agent::with("user","dept")->where("admin_id",Auth::user()->id)->get();
        $authenticate_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
        $auth_emp=employee::where("id",$authenticate_user->emp_id)->first();
        $depts=department::where("admin_uuid",$auth_emp->admin_id)->get();
        $emp_user=user_employee::with("employee","user")->get();
        $ticket_admin=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
        $system_admin=User::where("id",$ticket_admin->employee->admin_id)->first();
        foreach ($emp_user as $emp){
            if($emp->employee->admin_id==$system_admin->id && !$emp->user->hasAnyRole("Agent") && Auth::user()->id!=$emp->user->id){
                array_push($employees,$emp);
            }
        }
        return view("userAdmin.agent",compact("agents","depts","employees"));
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
//            dd($request->all());
        if($request->agent_name!="item0") {
            $agent = new agent();
            $agent->agent_id = $request->agent_name;
            $agent->admin_id = Auth::user()->id;
            $agent->dept_id = $request->dept_id;
            $agent->save();
            $agent_role = User::where("id", $request->agent_name)->first();
            $agent_role->assignRole("Agent");
            return redirect()->back()->with("message", "New Agent Create Successful !");
        }else{
            return redirect()->back()->with("delete","You need to create employee first !");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agentDetail($id)
    {
        $agent = agent::with("dept")->whereId($id)->first();
        $allcases = case_type::all();
//        dd($complaint_type);
        $alltickets = [];
        $assigntickets = [];
        $assignagent = assign_ticket::where("agent_id", $agent->agent_id)->get();
        foreach ($assignagent as $assign_agent) {
            $assign_ticket = ticket::with("priority_type", "cases")->where("id", $assign_agent->ticket->id)->first();
            array_push($assigntickets, $assign_ticket);
        }
        array_push($alltickets, $assigntickets);
        $assigndepts = [];

        $agentuser = User::whereId($agent->agent_id)->first();
        $assign_by_depts = assign_ticket::where("dept_id", $agent->dept_id)->get();
        foreach ($assign_by_depts as $assign_by_dept) {
            $assign_dept = ticket::with("priority_type", "cases")->where("id", $assign_by_dept->ticket_id)->first();
            array_push($assigndepts, $assign_dept);
        }
//       dd($assigndepts);
//        foreach($assign_by_depts as $ass_dept){
//            if($ass_dept->ticket->user_id !=$agentuser->uuid){
//                array_push($assigndepts,$ass_dept);
//            }
//        }
        foreach ($assigndepts as $assigndept) {
            if ($assigndept->user_id != $agentuser->uuid) {
                array_push($alltickets, $assigndept);
            }
        }
        $agenttickets = ticket::with("cases", "priority_type")->where("user_id", $agentuser->uuid)->get();
        foreach ($agenttickets as $agentticket) {
            array_push($alltickets, $agentticket);
        }
        $closeticket = 0;
        $complete = 0;
        $openticket = 0;
        $pending = 0;
        $progress = 0;
        $new = 0;
        foreach ($agenttickets as $t) {
//            dd($t);
            if ($t->status == "Close") {
                $closeticket++;
            } elseif ($t->status == "Complete") {
                $complete++;
            } elseif ($t->status == "Open") {
                $openticket++;
            } elseif ($t->status == "Pending") {
                $pending++;
            } elseif ($t->status == "Inprogress") {
                $progress++;
            } elseif ($t->status == "New") {
                $new++;
            }
        }
        foreach ($assigntickets as $ass_ticket) {
//            dd($t);
            if ($ass_ticket->status == "Close") {
                $closeticket++;
            } elseif ($ass_ticket->status == "Complete") {
                $complete++;
            } elseif ($ass_ticket->status == "Open") {
                $openticket++;
            } elseif ($ass_ticket->status == "Pending") {
                $pending++;
            } elseif ($ass_ticket->status == "Inprogress") {
                $progress++;
            } elseif ($ass_ticket->status == "New") {
                $new++;
            }

        }
        foreach ($assigndepts as $dept_ticket) {
            if ($dept_ticket->status == "Close") {
                $closeticket++;
            } elseif ($dept_ticket->status == "Complete") {
                $complete++;
            } elseif ($dept_ticket->status == "Open") {
                $openticket++;
            } elseif ($dept_ticket->status == "Pending") {
                $pending++;
            } elseif ($dept_ticket->status == "Inprogress") {
                $progress++;
            }
        }
        $solved_time = solvedTime::with("priority_type")->where("agent_id", $agentuser->id)->get();
        $twenty_fivepercent=0;
        $fifty_percent=0;
        $seventy_fivepercent=0;
        $hundred_percent=0;
        $overtimeuse=0;
        $overtimeuse_ticket=[];
        foreach ($solved_time as $solvetime) {
            $limit_time=$solvetime->priority_type->hours*60+$solvetime->priority_type->minutes;
            if($solvetime->endTime!=null) {
                $spend_time = Carbon::parse($solvetime->endTime)->diffInMinutes(Carbon::parse($solvetime->startedTime));
                $percentage = ($spend_time / $limit_time) * 100;
                if ($percentage <= 25) {
                    $twenty_fivepercent++;
                } elseif ($percentage > 25 && $percentage <= 50) {
                    $fifty_percent++;
                } elseif ($percentage > 50 && $percentage <= 75) {
                    $seventy_fivepercent++;
                } elseif ($percentage > 75 && $percentage <= 100) {
                    $hundred_percent++;
                } else {
                    $overtimeuse++;
                    $solve_timerover=ticket::with("cases","status_type","sources_type","priority_type")->where("id",$solvetime->ticket_id)->first();
                    array_push($overtimeuse_ticket,$solve_timerover);
                }
            }
        }
        $profile_picture=user_employee::with("employee")->where("user_id",$agent->agent_id)->first();
        return view("Agent.agentdetail",compact("openticket","pending","progress","new","complete","closeticket","agenttickets","assigndepts","assigntickets","agentuser","agent","allcases","twenty_fivepercent","fifty_percent","seventy_fivepercent","hundred_percent","overtimeuse","profile_picture","overtimeuse_ticket"));
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
    public function setting(){
        $userInfo=User::where("id",Auth::user()->id)->first();
        return view("Agent.setting",compact("userInfo"));
    }
    public function agentInfo_update(Request $request){
        $user=User::where("id",Auth::user()->id)->first();
        $current_pas=Hash::make($request->current_password);
        if(password_verify($request->current_password,$user->password))
        {
            $user->name = Auth::user()->name;
            $user->email = Auth::user()->email;
            $user->password = Hash::make($request->new_password);
            $user->update();
        }else{
            return redirect()->back()->with("delete","Current Password Incorrect");
        }
        return redirect("/home")->with("message","Successful!");
    }
    public function ppchange(){
        if(Auth::user()->hasAnyRole("Admin")){
            $pp=Auth::user()->profile;
            return view("Agent.ppchange",compact("pp"));
        }else{
            $user_emp=user_employee::where("user_id",Auth::user()->id)->first();
            $user_pp = employee::where("id",$user_emp->emp_id)->first();
            $pp=$user_pp->profile;
            return view("Agent.ppchange",compact("pp"));
        }

    }
    public function profileChange(Request $request){
           if(Auth::user()->hasAnyRole("Admin")) {
               $user_pp = User::where("id", Auth::user()->id)->first();
               $image = $request->file("profile");
               $name = $image->getClientOriginalName();
               $request->profile->move(public_path() . '/profile/', $name);
               $user_pp->profile = $name;
               $user_pp->update();
               return redirect("/home")->with("message", "Profile Change Successful");
           }else{
               $user_emp=user_employee::where("user_id",Auth::user()->id)->first();
               $user_pp = employee::where("id",$user_emp->emp_id)->first();
               $image = $request->file("profile");
               $name = $image->getClientOriginalName();
               $request->profile->move(public_path() . '/profile/', $name);
               $user_pp->emp_profile = $name;
               $user_pp->update();
               return redirect("/home")->with("message", "Profile Change Successful");
           }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent=agent::where("id",$id)->first();
        $agent->delete();
        return redirect()->back()->with("delete","Delete Successful!");
    }
    public function agentTicket(){
        $tickets=ticket::with("priority_type","cases","status_type","sources_type")->where("user_id",Auth::user()->uuid)->get();
//            dd($tickets);
        $noOfmyticket=count($tickets);
        $userOfdepts=agent::with("dept")->where("agent_id",Auth::user()->id)->first();
        $assign=assign_ticket::with("ticket")->OrWhere("dept_id",$userOfdepts->dept_id)->OrWhere("agent_id",Auth::user()->id)->get();
        $assignticket=[];
        $ticket_assign_dept=[];
        foreach ($assign as $sign) {
            $ticket = ticket::with("priority_type", "cases", "status_type", "sources_type")->where("id", $sign->ticket_id)->first();
            if ($sign->type_of_assign == 0){
                array_push($assignticket, $ticket);
        }else{
                array_push($ticket_assign_dept, $ticket);
            }
        }
        $noOfassign=count($assignticket);

        $admin=User::where("id",$userOfdepts->admin_id)->first();
        $allcases = case_type::where("admin_uuid",$admin->uuid)->get();


//            dd($assingwithDepts);
        $noOfassign_withdept=count($ticket_assign_dept);
        $auth_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
        $system_admin=User::where("id",$auth_user->employee->admin_id)->first();
        $depts=department::where("admin_uuid",$system_admin->uuid)->get();
        $admin_agents=agent::with("user")->where("admin_id",$admin->id)->get();
        return view("Agent.agentTicket", compact("noOfassign","noOfassign_withdept","ticket_assign_dept","admin_agents","depts","noOfmyticket","tickets", "allcases","assignticket"));


    }
}
