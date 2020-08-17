<?php

namespace App\Http\Controllers;

use App\agent;
use App\assign_ticket;
use App\assignwithdept;
use App\case_type;
use App\comment;
use App\countdown;
use App\department;
use App\priority;
use App\ticket;
use App\User;
use App\user_information;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ticketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyRole("SuperAdmin")) {
            $tickets = ticket::all();
            $category = category::all();
            return view("ticket.index", compact("tickets", "category"));
        }
        //for admin user
        elseif (Auth::user()->hasAnyRole("Admin"))
        {

            //start user role
        }
        elseif(Auth::user()->hasAnyRole("Agent")){
            $tickets=ticket::with("priority_type")->where("user_id",Auth::user()->uuid)->get();
//            dd($tickets);
            $noOfmyticket=count($tickets);
            $category = case_type::all();
            $assignticket=assign_ticket::with("ticket")->where("agent_id",Auth::user()->id)->get();
//            dd($assignticket);
//            foreach ($assignticket as $assticket){
////                dd($assticket->ticket->priority);
//                $accept_tickets=priority::where("id",$assticket->ticket->priority)->get();
//            }
//            dd($accept_tickets);
//            $agent_ticket=$assignticket->ticket;
            $noOfassign=count($assignticket);
            $userOfdepts=admin_agent::with("dept")->where("agent_id",Auth::user()->id)->first();
            $admin=User::where("id",$userOfdepts->admin_id)->first();
//            dd($userOfdepts);
//            $assingwithDepts=[];
//            foreach ($userOfdepts as $userOfdept){
            $assingwithDepts=assigntodepartment::with("ticket")->where("dept_id",$userOfdepts->dept->id)->get();
//                array_push($assingwithDepts,$assingwithDept);
//            }
//            dd($assingwithDepts);
            $noOfassign_withdept=count($assingwithDepts);
            return view("ticket.agentTicket", compact("noOfassign","noOfmyticket","tickets", "category","assignticket","assingwithDepts","noOfassign_withdept","admin"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

//        dd($id);

        if(Auth::check()) {
            if (Auth::user()->hasAnyRole("Agent")) {
                $agent_admins = agent::where("agent_id", Auth::user()->id)->get();
                foreach ($agent_admins as $agent_admin) {
                    $admins = User::whereId($agent_admin->admin_id)->first();
//                    foreach ($admins as $admin) {
                    $cats = case_type::where("admin_uuid", $admins->uuid)->get();
                    $priorities=priority::where("admin_uuid",$admins->uuid)->get();
                    $user_infos=user_information::where("admin_id",$admins->uuid)->get();
//                    }
                }
                return view("ticket.create", compact("cats", "id","priorities","user_infos"));
            }elseif(Auth::user()->hasAnyRole("Admin")) {
                $priorities = priority::where("admin_uuid", $id)->get();
                $cats = case_type::where("admin_uuid", $id)->get();
                $user_infos = user_information::where("admin_id", $id)->get();
                return view("ticket.create", compact("cats", "id", "priorities", "user_infos"));
            }
        }else {
            $priorities=priority::where("admin_uuid",$id)->get();
            $cats = case_type::where("admin_uuid", $id)->get();
            $user_infos=user_information::where("admin_id",$id)->get();
            return view("ticket.create", compact("cats", "id","priorities","user_infos"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {

        $this->validate($request, [

            'files' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
//        dd(public_path().'/imgs/');
//        dd($request->all());
//        var_dump($request->uuid);
        $name=User::where("uuid",$request->uuid)->first();
        $ticket = new ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->user_id =$request->uuid;;
        $ticket->case_type = $request->case_type;
        $ticket->ticket_id =$name->name." - ". strtoupper(Str::random(12));
        $ticket->status = "New";
        $ticket->product=$request->product;
        $ticket->userinfo_id=$request->user_info_id;
        $ticket->phone=$request->phone;
        $ticket->priority = $request->priority;
        $ticket->source=$request->source;
        $ticket->isassign=0;
        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/imgs/', $name);
                $data[] = $name;
            }
        }
        $ticket->photo=json_encode($data);
        $ticket->save();
//        $user=User::all();
//        $users=[];
//        foreach ($user as $u) {
//            array_push($users,$u->email);
////
//        }
//        if(!in_array($request->email, $users)) {
//            $user=new User();
//            $user->email=$request->email;
//            $user->save();
//        }
        return redirect()->back()->with("message","Successful!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {

//        $ticket_info=ticket::all();
        $ticket_info=ticket::with("priority_type","userinfo")->where('ticket_id',$ticket_id)->firstOrFail();
//        dd($ticket_info);
        $countdown=countdown::where("ticket_id",$ticket_id)->first();
        if($countdown==null){
            $end=Carbon::now();
        }else{
            $count_time=countdown::where("ticket_id",$ticket_id)->first();
            $end=Carbon::create($count_time->endtime);
        }
        $photos=json_decode($ticket_info->photo);
//            dd($photos);
        $numberOfphotos=count($photos);
        $comments=$ticket_info->comment;
//        dd($ticket_info);
        $cat=$ticket_info->cases;
//        dd($ticket_info);
        $assigned_tickets=assign_ticket::where("ticket_id",$ticket_info->id)->first();
//        $assigned_dept=assigntodepartment::where("ticket_id",$ticket_info->id)->first();
//        $isassigned=$assigned_dept!=NULL ||$assigned_tickets!=NULL;
//        dd($isassigned);
//        if($assigned_tickets->isEmpty()){
//            $assigned_user="true";
//            $updated_at='';
//        }else {
//            foreach ($assigned_tickets as $assigned_ticket) {
//                $assigned_user = User::whereId($assigned_ticket->agent_id)->first();
//                $updated_at = $assigned_ticket->updated_at;
//            }
//        }
        if(Auth::user()->hasAnyRole("Admin")) {
            $admin = agent::with("user")->where("admin_id", Auth::user()->id)->get();
            $depts=department::where("admin_uuid",Auth::user()->uuid)->get();
//        dd($admin);
//            dd($admin);
//            $user=ticket::with("user")->where("ticket_id",$ticket_id)->get();
//            dd($user);
//            dd($assigned_user);
            return view("ticket.show", compact("photos","numberOfphotos","ticket_info", "comments", "cat", "admin","depts","end"));
        }else{

            $priority=priority::where("priority",$ticket_info->priority)->first();
//                dd($priority);
//
            $agents=agent::where("agent_id",Auth::user()->id)->get();
            foreach ($agents as $agent){
                $admin = agent::with("user")->where("admin_id", $agent->admin_id)->get();
                $admin_user=User::whereId($agent->admin_id)->first();
                $depts=department::where("admin_uuid",$admin_user->uuid)->get();
            }

            return view("ticket.show",compact("photos","numberOfphotos","ticket_info","comments","cat","admin","depts","end"));
        }
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
    public function countdown($ticket_id){

        $ticket_info=ticket::with("priority_type")->where('ticket_id',$ticket_id)->firstOrFail();
        $countdown=countdown::where("ticket_id",$ticket_id)->first();
        if($countdown==null) {
            $countdownCreate = new countdown();
            $countdownCreate->ticket_id = $ticket_id;
            $countdownCreate->endtime = \Carbon\Carbon::now("Asia/Yangon")->addHour($ticket_info->priority_type->hours)->addMinutes($ticket_info->priority_type->minutes)->addSeconds($ticket_info->priority_type->seconds);
            $countdownCreate->save();
        }
        return redirect("/tickets/$ticket_id");
    }
    public function statusChange(Request $request,$ticket_id){
        $statusOn = ticket::where("ticket_id", $ticket_id)->first();
//        dd($statusOn);
        $statusOn->status = $request->status_change;
        $statusOn->updated_at=Carbon::now();
        $statusOn->update();
        return redirect()->back();
    }
    public function assigned(Request $request){
        if($request->assignType=="agent"){
            $tickets=assign_ticket::all();
            $ticket_id = [];
                foreach ($tickets as $ticket) {
                    array_push($ticket_id, $ticket->ticket_id);
                }
                for($i=0;$i<count($request->ticket_id);$i++){
                if (!in_array($request->ticket_id[$i], $ticket_id)) {
                    $assign_ticket = new assign_ticket();
                    $assign_ticket->agent_id = $request->assign_id;
                    $assign_ticket->ticket_id = $request->ticket_id[$i];
                    $assign_ticket->save();
                    $ticket = ticket::where("id", $request->ticket_id[$i])->first();
                    $ticket->isassign = 1;
                    $ticket->update();
                }
            }
            return redirect()->back()->with("message","Successful!");
        }
        elseif($request->assignType=="dept"){
//            dd($request->all());
            $tickets=assignwithDept::all();
//            dd($tickets);
            $isassigned=[];
            foreach ($tickets as $ticket){
                array_push($isassigned,$ticket->ticket_id);
            }
//            dd($request->all());

            for($i=0;$i<count($request->ticket_id);$i++) {
                if (!in_array($request->ticket_id, $isassigned)) {
                    $assigntodept = new assignwithdept();
                    $assigntodept->dept_id = $request->assign_id;
                    $assigntodept->ticket_id = $request->ticket_id[$i];
//                dd($assigntodept);
                    $assigntodept->save();
                    $ticket = ticket::where("id", $request->ticket_id[$i])->first();
                    $ticket->isassign = 1;
                    $ticket->update();
                }
            }
//                dd($isassigned);
            return redirect()->back();
        }
    }
    public function reassign(Request $request){
//        dd($request->all());
        if($request->assignType=="agent") {
            $agentass = assign_ticket::where("ticket_id", $request->ticket_id)->first();
            if(isset($agentass)){
                $agentass->agent_id = $request->assign_id;
                $agentass->update();
            }else{
                $agentass=new assign_ticket();
                $agentass->agent_id=$request->assign_id;
                $agentass->ticket_id=$request->ticket_id;
                $agentass->save();
                $deptass=assignwithdept::where("ticket_id",$request->ticket_id)->first();
                $deptass->delete();
            }

            return redirect()->back()->with("message","Ticket Reassigned Successful!");
        }elseif ($request->assignType=="dept"){
            $deptass=assignwithdept::where("ticket_id",$request->ticket_id)->first();
//            dd($deptass);
            if (isset($deptass)){
                $deptass->dept_id=$request->assign_id;
                $deptass->update();
            }else{
                $deptass=new assignwithdept();
                $deptass->dept_id=$request->assign_id;
                $deptass->ticket_id=$request->ticket_id;
                $deptass->save();
                $agentass = assign_ticket::where("ticket_id", $request->ticket_id)->first();
                $agentass->delete();
            }

        }
        return redirect()->back()->with("message","Ticket Reassigned Successful!");
    }
    public function postcomment(Request $request){

        $comments=new comment();
        $comments->ticket_id=$request->ticket_id;
        $comments->user_id=Auth::user()->id;
        $comments->comment=$request->comment;
        $comments->save();
        return redirect()->back();
    }
}
