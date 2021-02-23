<?php

namespace App\Http\Controllers;

use App\agent;
use App\ticket;
use App\User;
use App\user_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userinfo=user_information::where("admin_id",Auth::user()->uuid)->get();
        return view("userAdmin.userinformation",compact("userinfo"));
    }
    public function sendinghistory($id)
    {
        $sentTickets=ticket::with("userinfo","cases")->where("userinfo_id",$id)->get();
        return view("userAdmin.sentHistory",compact("sentTickets"));
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
    public function store(Request $request,$id)
    {
        $user=user_information::all();
        $users=[];
        foreach ($user as $u) {
            array_push($users,$u->email);
//
        }
        if(!in_array($request->email, $users)) {
            $user_info=new user_information();
            $user_info->name=$request->user_name;
            $user_info->email=$request->email;
            if(Auth::check()){
                if(Auth::user()->hasAnyRole("Agent")) {
                    $agent_user = agent::where("agent_id", Auth::user()->id)->first();
                    $admin = User::where("id", $agent_user->admin_id)->first();
                    $user_info->admin_id = $admin->uuid;
                }elseif(Auth::user()->hasAnyRole("Admin")){
                    $user_info->admin_id=Auth::user()->uuid;
                }
            }else {
                $user_info->admin_id = $request->id;
            }
            $user_info->save();
            return redirect()->back()->with("message","Add New User Successful!");
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
    public function test(Request $request){
        dd($request->all());
    }
}
