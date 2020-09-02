<?php

namespace App\Http\Controllers;

use App\agent;
use App\ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class piechartController extends Controller
{
    public function index(){

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
        $countallticket=count($tickets);
        $openticket=0;
        $closeticket=0;
        $complete=0;
        $pending=0;
        $progress=0;
        $new=0;
        $high=0;
        $urgent=0;
        $medium=0;
        $low=0;

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
            if($t->priority_type->priority=="Urgent"){
                $urgent ++;
            }elseif($t->priority_type->priority=="High"){
                $high ++;
            }elseif($t->priority_type->priority=="Medium"){
                $medium ++;
            }elseif($t->priority_type->priority=="Low"){
                $low ++;
            }
        }

        return view("userAdmin.chartReport",compact("new","openticket","pending","complete","progress","closeticket","urgent","high","medium","low"));

    }
    public function filterBy(Request $request){
        $filterResults=[];
        $startDate=Carbon::create($request->start_date)->startOfDay();
        $endDate=Carbon::create($request->end_date)->endOfDay();
        $tickets=ticket::with("priority_type","status_type")->where("user_id",Auth::user()->uuid)->get();
        foreach ($tickets as $ticket){
           if($startDate<$ticket->created_at&&$endDate>$ticket->created_at){
               array_push($filterResults,$ticket);
           }
        }
        $auth_adminAgents=agent::with("user")->where("admin_id",Auth::user()->id)->get();
        foreach ($auth_adminAgents as  $agent){
            $agent_tickets=ticket::with("priority_type","status_type")->where("user_id",$agent->user->uuid)->get();
            foreach ($agent_tickets as $agent_ticket){
                if($startDate<$agent_ticket->created_at&&$endDate>$agent_ticket->created_at){
                    array_push($filterResults,$agent_ticket);
                }
            }
        }
        $openticket=0;
        $closeticket=0;
        $complete=0;
        $pending=0;
        $progress=0;
        $new=0;
        $high=0;
        $urgent=0;
        $medium=0;
        $low=0;
        foreach ($filterResults as $ticket) {
            if($ticket->status_type->status=="Close"){
                $closeticket ++;
            }elseif($ticket->status_type->status=="Complete"){
                $complete ++;
            }elseif($ticket->status_type->status=="Open"){
                $openticket ++;
            }elseif($ticket->status_type->status=="Pending"){
                $pending ++;
            }elseif($ticket->status_type->status=="Inprogress"){
                $progress ++;
            }elseif($ticket->status_type->status=="New"){
                $new ++;
            }
            if($ticket->priority_type->priority=="Urgent"){
                $urgent ++;
            }elseif($ticket->priority_type->priority=="High"){
                $high ++;
            }elseif($ticket->priority_type->priority=="Medium"){
                $medium ++;
            }elseif($ticket->priority_type->priority=="Low"){
                $low ++;
            }
        }

        return view("userAdmin.filterPieChart",compact("new","openticket","pending","complete","progress","closeticket","urgent","high","medium","low","startDate","endDate"));

    }
}
