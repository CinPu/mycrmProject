<?php

namespace App\Http\Controllers;

use App\agent;
use App\assign_ticket;
use App\assignwithdept;
use App\case_type;
use App\department;
use App\ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $agents=agent::with("user","dept")->where("admin_id",Auth::user()->id)->get();
        $depts=department::where("admin_uuid",Auth::user()->uuid)->get();
        return view("userAdmin.agent",compact("agents","depts"));
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
       $agent=new User();
       $agent->name=$request->name;
       $agent->email=$request->email;
       $agent->password=Hash::make($request->password);
       $agent->uuid=$request->uuid;
       $agent->save();
       $agent->assignRole("Agent");
       $agent_dept=new agent();
       $agent_dept->agent_id=$agent->id;
       $agent_dept->admin_id=Auth::user()->id;
       $agent_dept->dept_id=$request->dept;
       $agent_dept->save();
       return redirect()->back()->with("message","New Agent Create Successful");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agentDetail($id)
    {

        $agent=agent::with("dept")->whereId($id)->first();
        $allcases=case_type::all();
//        dd($complaint_type);
        $alltickets=[];
        $assigntickets=assign_ticket::with("ticket")->where("agent_id",$agent->agent_id)->get();
//        dd($assigntickets);
        foreach ($assigntickets as $assignticket){
            array_push($alltickets,$assignticket);
        }
//        dd($assigntickets);
        $assigndepts=[];

        $agentuser=User::whereId($agent->agent_id)->first();
        $assign_by_depts=assignwithdept::with("ticket")->where("dept_id",$agent->dept_id)->get();
        foreach($assign_by_depts as $ass_dept){
            if($ass_dept->ticket->user_id !=$agentuser->uuid){
                array_push($assigndepts,$ass_dept);
            }
        }
        foreach ($assigndepts as $assigndept){
            if ($assigndept->user_id!=$agentuser->uuid) {
                array_push($alltickets, $assigndept);
            }
        }
        $agenttickets=ticket::with("cases")->where("user_id",$agentuser->uuid)->get();
        foreach ($agenttickets as $agentticket){
            array_push($alltickets,$agentticket);
        }
        $closeticket=0;
        $complete=0;
        $openticket=0;
        $pending=0;
        $progress=0;
        $new=0;
        foreach ($agenttickets as $t) {
//            dd($t);
            if($t->status=="Close"){
                $closeticket ++;
            }elseif($t->status=="Complete"){
                $complete ++;
            }elseif($t->status=="Open"){
                $openticket ++;
            }elseif($t->status=="Pending"){
                $pending ++;
            }elseif($t->status=="Inprogress"){
                $progress ++;
            }elseif($t->status=="New"){
                $new ++;
            }
        }
        foreach ($assigntickets as $ass_ticket) {
//            dd($t);
            if($ass_ticket->ticket->status=="Close"){
                $closeticket ++;
            }elseif($ass_ticket->ticket->status=="Complete"){
                $complete ++;
            }elseif($ass_ticket->ticket->status=="Open"){
                $openticket ++;
            }elseif($ass_ticket->ticket->status=="Pending"){
                $pending ++;
            }elseif($ass_ticket->ticket->status=="Inprogress"){
                $progress ++;
            }elseif($ass_ticket->ticket->status=="New"){
                $new ++;
            }

        }
        foreach ($assigndepts as $dept_ticket) {
            if ($assigndept->ticket->user_id != $agentuser->uuid) {
                if ($dept_ticket->ticket->status == "Close") {
                    $closeticket++;
                } elseif ($dept_ticket->ticket->status == "Complete") {
                    $complete++;
                } elseif ($dept_ticket->ticket->status == "Open") {
                    $openticket++;
                } elseif ($dept_ticket->ticket->status == "Pending") {
                    $pending++;
                } elseif ($dept_ticket->ticket->status == "Inprogress") {
                    $progress++;
                }
            }
        }
//        dd($openticket);
        return view("Agent.agentdetail",compact("agentuser","assigntickets","assigndepts","agenttickets","agent","complete","closeticket","openticket","progress","pending","new","allcases"));
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
        $agent=agent::where("id",$id)->first();
        $agent->delete();
        return redirect()->back()->with("delete","Delete Successful!");
    }
}
