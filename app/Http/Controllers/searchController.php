<?php

namespace App\Http\Controllers;

use App\agent;
use App\assign_ticket;
use App\case_type;
use App\ticket;
use App\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function ticket(Request $request){
//        dd($request->all());
        $assign_tickets=assign_ticket::with("ticket")->where("agent_id",$request->agent_name)->get();
        $staff_name=assign_ticket::with("agent","agent_pp")->where("agent_id",$request->agent_name)->first();
        $agent_tickets=[];
        foreach ($assign_tickets as $assign_ticket){
            $start_date=Carbon::create($request->from_date);
            $end_date=Carbon::create($request->to_date);
            $ticket=ticket::with("priority_type","cases","status_type")->where("id",'=',$assign_ticket->ticket->id)->where("status",$request->status)->where("priority",'=',$request->priority)->whereBetween("created_at",[$start_date,$end_date])->first();
            if($ticket!=null) {
                array_push($agent_tickets, $ticket);
            }
        }
        $allcases=case_type::all();
        return view("userAdmin.ticketSearch",compact("agent_tickets","staff_name","allcases"));
    }
}
