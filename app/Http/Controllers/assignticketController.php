<?php

namespace App\Http\Controllers;

use App\agent;
use App\assign_ticket;
use App\assignwithdept;
use App\case_type;
use App\department;
use App\ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class assignticketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function isassign($name)
    {
        $tickets = [];
        //admin's agent all ticket select
        $agents = agent::with("user")->where("admin_id", Auth::user()->id)->get();
        foreach ($agents as $agent){
            $agents_tickets=ticket::with("priority_type","cases")->where("user_id",$agent->user->uuid)->get();
            //all agents' ticket add to tickets[]
            foreach ($agents_tickets as $agent_ticket) {
                array_push($tickets, $agent_ticket);
            }
//                }
        }
        //ticket for admin from user to admin
        $user_tickets=ticket::with("priority_type","cases")->where("user_id",Auth::user()->uuid)->get();
        foreach($user_tickets as $user_ticket){
            array_push($tickets,$user_ticket);
        }
        $unassign_tickets=[];
        $assign_tickets=[];
        $allcases=case_type::where("admin_uuid",Auth::user()->uuid)->get();
        $depts=department::where("admin_uuid",Auth::user()->uuid)->get();
        foreach ($tickets as $ticket){
            if($ticket->isassign==0){
            array_push($unassign_tickets,$ticket);
            }elseif($ticket->isassign==1){
            array_push($assign_tickets,$ticket);
            }
        }
        if($name==1) {
            $assign = "show active";
            $unassign="";
            return view("ticket.isassign", compact("allcases","agents","depts","assign_tickets","unassign_tickets","assign","unassign"));
        }else{
            $assign = "";
            $unassign="show active";
            return view("ticket.isassign", compact("allcases","agents","depts","assign_tickets","unassign_tickets","assign","unassign"));
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
        //
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
}
