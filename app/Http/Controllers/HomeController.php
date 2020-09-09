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
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $user=Auth::user();
//        $user->assignRole("SuperAdmin");
        if(Auth::check()) {
            if (Auth::user()->hasAnyRole("SuperAdmin")) {
                $alluser=User::all();
                $roles=Role::all();
                return view("SuperAdmin.home",compact("alluser","roles"));
            } elseif (Auth::user()->hasAnyRole("Admin")) {
                //select admin's agent
                $tickets = [];
                //admin's agent all ticket select
                $agents = agent::with("user")->where("admin_id", Auth::user()->id)->get();
//                dd($agents);
                foreach ($agents as $agent){
                    $agents_tickets=ticket::with("priority_type","cases","status_type")->where("user_id",$agent->user->uuid)->get();
                    //all agents' ticket add to tickets[]
                    foreach ($agents_tickets as $agent_ticket) {
                        array_push($tickets, $agent_ticket);
                    }
//                }
                }
                //ticket for admin from user to admin
                $user_tickets=ticket::with("priority_type","cases","status_type")->where("user_id",Auth::user()->uuid)->get();
                foreach($user_tickets as $user_ticket){
                    array_push($tickets,$user_ticket);
                }
                //count ticket each status;
                $countAgent=count($agents);
                $countallticket=count($tickets);
                $openticket=0;
                $closeticket=0;
                $complete=0;
                $pending=0;
                $progress=0;
                $new=0;
                $assigned=[];
                $unassigned=[];
                foreach ($tickets as $t) {
                    if($t->status_type->status=="Close"){
                        $closeticket ++;
                    }elseif($t->status_type->status=="Complete"){
                        $complete ++;
                    }elseif($t->status_type->status=="Open"){
                        $openticket ++;
                    }elseif($t->status_type->status=="Pending"){
                        $pending ++;
                    }elseif($t->status_type->status=="Inprogress"){
                        $progress ++;
                    }elseif($t->status_type->status=="New"){
                        $new ++;
                    }
                    if($t->isassign==0){
                        array_push($unassigned,$t);
                    }elseif($t->isassign==1){
                        array_push($assigned,$t);
                    }
                }
                $allcases=case_type::where("admin_uuid",Auth::user()->uuid)->get();

//            dd($tickets);
                $depts=department::where("admin_uuid",Auth::user()->uuid)->get();
                return view("userAdmin.home",compact("agents","assigned","unassigned","depts","pending","allcases","progress","countallticket","tickets","openticket","closeticket","complete","new","countAgent"));
                //end for admin user
            } elseif (Auth::user()->hasAnyRole("Agent")) {

                $tickets=ticket::with("priority_type","cases","status_type","sources_type")->where("user_id",Auth::user()->uuid)->get();
//            dd($tickets);
                $noOfmyticket=count($tickets);

                $assign=assign_ticket::with("ticket")->where("agent_id",Auth::user()->id)->get();
                $assignticket=[];
                foreach ($assign as $sign){
                    $ticket=ticket::with("priority_type","cases","status_type","sources_type")->where("id",$sign->ticket_id)->first();
                    array_push($assignticket,$ticket);
                }
                $noOfassign=count($assignticket);
                $userOfdepts=agent::with("dept")->where("agent_id",Auth::user()->id)->first();
                $admin=User::where("id",$userOfdepts->admin_id)->first();
                $allcases = case_type::where("admin_uuid",$admin->uuid)->get();
                $assingwithDepts=assignwithdept::with("ticket")->where("dept_id",$userOfdepts->dept->id)->get();

//            dd($assingwithDepts);
                $noOfassign_withdept=count($assingwithDepts);
                $depts=department::where("admin_uuid",$admin->uuid)->get();
                $admin_agents=agent::with("user")->where("admin_id",$admin->id)->get();
                return view("Agent.home", compact("noOfassign","noOfassign_withdept","assingwithDepts","admin_agents","depts","noOfmyticket","tickets", "allcases","assignticket"));

            }else{
                return view("home");
            }
        }else{

        }

    }
}
