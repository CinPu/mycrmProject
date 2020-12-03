<?php

namespace App\Http\Controllers;

use App\agent;
use App\assign_ticket;
use App\assignwithdept;
use App\case_type;
use App\comment;
use App\company;
use App\countdown;
use App\department;
use App\employee;
use App\Imports\ticket_import;
use App\priority;
use App\solvedTime;
use App\sources;
use App\status;
use App\ticket;
use App\ticketFollower;
use App\User;
use App\user_employee;
use App\user_information;
use App\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class ticketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

//        dd($id);
        $statuses = status::all();
        $sources = sources::all();
        //ticket create for agent start
        if (Auth::check()) {
            if (Auth::user()->hasAnyRole("Agent")) {
                $agent_admins = agent::where("agent_id", Auth::user()->id)->get();
                foreach ($agent_admins as $agent_admin) {
                    $admins = User::whereId($agent_admin->admin_id)->first();
//                    foreach ($admins as $admin) {
                    $cats = case_type::where("admin_uuid", $admins->uuid)->get();
                    $priorities = priority::where("admin_uuid", $admins->uuid)->get();
                    $user_infos = user_information::where("admin_id", $admins->uuid)->get();
//                    }
                }
                return view("ticket.create", compact("cats", "statuses", "sources", "id", "priorities", "user_infos"));
            /*
             * end of ticket create for agent
             */
            } elseif (Auth::user()->hasAnyRole("Admin")) {
                /*
                 * ticket create as admin start
                */
                $priorities = priority::where("admin_uuid", $id)->get();
                $cats = case_type::where("admin_uuid", $id)->get();
                return view("ticket.create", compact("cats", "statuses", "sources", "id", "priorities", "user_infos"));
            /*
             * end of admin
             */
            }elseif (Auth::user()->hasAnyRole("TicketAdmin")) {
                /*
                 *  ticket admin start
                */
                $priorities = priority::where("admin_uuid", $id)->get();
                $cats = case_type::where("admin_uuid", $id)->get();
                return view("ticket.create", compact("cats", "statuses", "sources", "id", "priorities", "user_infos"));
                /*
                 * end of admin
                 */
            }
            elseif (Auth::user()->hasAnyRole("Employee")) {
                $priorities = priority::where("admin_uuid", $id)->get();
                $cats = case_type::where("admin_uuid", $id)->get();
                return view("ticket.create", compact("cats", "statuses", "sources", "id", "priorities", "user_infos"));
            }
        } else {
            $priorities = priority::where("admin_uuid", $id)->get();
            $cats = case_type::where("admin_uuid", $id)->get();
            $user_infos = user_information::where("admin_id", $id)->get();
            return view("ticket.create", compact("cats", "statuses", "sources", "id", "priorities", "user_infos"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [

            'files' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'message' => 'required',

        ]);
//        dd(public_path().'/imgs/');
//        dd($request->all());
//        var_dump($request->uuid);
        //user info store
        $user_info = user_information::where("email", $request->email)->first();
        if ($user_info == null) {
            $user_info = new user_information();
            $user_info->name = $request->user_name;
            $user_info->email = $request->email;
            if (Auth::check()) {
                if (Auth::user()->hasAnyRole("Agent")) {
                    $agent_user = agent::where("agent_id", Auth::user()->id)->first();
                    $admin = User::where("id", $agent_user->admin_id)->first();
                    $user_info->admin_id = $admin->uuid;
                } elseif (Auth::user()->hasAnyRole("Admin")) {
                    $user_info->admin_id = Auth::user()->uuid;
                } else {
                    $user_info->admin_id = $id;
                }
            } else {
                $user_info->admin_id = $id;
            }
            $user_info->save();
        }
        $name = User::where("uuid", $request->uuid)->first();
        $emp=user_employee::with("employee")->where("user_id",$name->id)->first();
        $ticket = new ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->user_id = $request->uuid;
        $ticket->case_type = $request->case_type;
        if (Auth::check()) {
            if (Auth::user()->hasAnyRole("Agent")) {
                $agent_admin = agent::where("agent_id", $name->id)->first();
                $company_name = company::where("admin_id", $agent_admin->admin_id)->first();
            } elseif (Auth::user()->hasAnyRole("Admin")) {
                $company_name = company::where("admin_id", $name->id)->first();
            } else {
                $company_name = company::where("admin_id", $name->id)->first();
            }
        } else {
            $company_name = company::where("id", $emp->employee->company_id)->first();
        }
        $ticket->ticket_id = $company_name->company_name . " - " . strtoupper(Str::random(12));
        $ticket->status = $request->status;
        $ticket->product = $request->product;
        $ticket->userinfo_id = $user_info->id;
        $ticket->phone = $request->phone;
        $ticket->priority = $request->priority;
        $ticket->source = $request->source;
        $ticket->lat = $request->lat;
        $ticket->lng = $request->lng;
        $ticket->isassign = 0;
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/imgs/', $name);
                $data[] = $name;
            }
        }
        $ticket->photo = json_encode($data);
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
        return redirect()->back()->with("message", "Successful!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $statuses = status::all();

//        $ticket_info=ticket::all();
        $ticket_info = ticket::with("priority_type", "userinfo", "cases", "status_type", "sources_type")->where('ticket_id', $ticket_id)->firstOrFail();
//        dd($ticket_info);
        $countdown = countdown::where("ticket_id", $ticket_id)->first();
        if ($countdown == null) {
            $end = Carbon::now();
        } else {
            $count_time = countdown::where("ticket_id", $ticket_id)->first();
            $end = Carbon::create($count_time->endtime);
        }
        $photos = json_decode($ticket_info->photo);
//            dd($photos);
        $numberOfphotos = count($photos);
        $comments = $ticket_info->comment;
//        dd($ticket_info);
        $assigned_tickets = assign_ticket::where("ticket_id", $ticket_info->id)->first();
        if (Auth::user()->hasAnyRole("Admin")) {
            $admin = agent::with("user")->where("admin_id", Auth::user()->id)->get();
            $depts = department::where("admin_uuid", Auth::user()->uuid)->get();
            $employees = [];
            $emp_user = user_employee::with("employee")->get();
            foreach ($emp_user as $emps) {
                if ($emps->employee->admin_id == Auth::user()->id) {
                    array_push($employees, $emps);
                }
            }
            $followers = ticketFollower::with("emp")->where("ticket_id", $ticket_info->id)->get();
            return view("ticket.show", compact("photos", "numberOfphotos", "ticket_info", "comments", "admin", "depts", "end", "statuses", "employees", "followers"));
        }elseif (Auth::user()->hasAnyRole("TicketAdmin")) {
            $admin = agent::with("user")->where("admin_id", Auth::user()->id)->get();
            $auth_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
            $system_admin=User::where("id",$auth_user->employee->admin_id)->first();
            $depts = department::where("admin_uuid",$system_admin->uuid)->get();
            $employees = [];
            $emp_user = user_employee::with("employee")->get();
            foreach ($emp_user as $emps) {
                if ($emps->employee->admin_id ==$system_admin->id) {
                    array_push($employees, $emps);
                }
            }
            $followers = ticketFollower::with("emp")->where("ticket_id", $ticket_info->id)->get();
            return view("ticket.show", compact("photos", "numberOfphotos", "ticket_info", "comments", "admin", "depts", "end", "statuses", "employees", "followers"));
        } elseif (Auth::user()->hasAnyRole("Agent")) {

            $priority = priority::where("priority", $ticket_info->priority)->first();
//                dd($priority);
//
            $agents = agent::where("agent_id", Auth::user()->id)->get();
            foreach ($agents as $agent) {
                $admin = agent::with("user")->where("admin_id", $agent->admin_id)->get();
                $admin_user = User::whereId($agent->admin_id)->first();
                $depts = department::where("admin_uuid", $admin_user->uuid)->get();
            }
            $employees = [];
            $emp_users = user_employee::with("employee")->get(); //to get all employee for follower
            foreach ($emp_users as $emps) {
                $unfollowuser = ticketFollower::where("emp_id", $emps->user_id)->first();
                if ($emps->employee->admin_id == $admin_user->id && $unfollowuser == null) {
                    array_push($employees, $emps);
                }
            }
            $followers = ticketFollower::with("emp")->where("ticket_id", $ticket_info->id)->get();
            return view("ticket.show", compact("photos", "numberOfphotos", "ticket_info", "comments", "admin", "depts", "end", "statuses", "employees", "followers"));
        } else {
            $priority = priority::where("priority", $ticket_info->priority)->first();
//                dd($priority);
            $emp = user_employee::where("user_id", Auth::user()->id)->first(); //to get current login user's admin
            $admin_user = User::whereId($emp->employee->admin_id)->first();
            $depts = department::where("admin_uuid", $admin_user->uuid)->get();
            $employees = [];
            $emp_users = user_employee::with("employee")->get(); //to get all employee for follower
            foreach ($emp_users as $emps) {
                $unfollowuser = ticketFollower::where("emp_id", $emps->user_id)->first();
                if ($emps->employee->admin_id == $admin_user->id && $unfollowuser == null) {
                    array_push($employees, $emps);
                }
            }
            $followers = ticketFollower::with("emp")->where("ticket_id", $ticket_info->id)->get();
            return view("ticket.show", compact("photos", "numberOfphotos", "ticket_info", "comments", "depts", "end", "statuses", "employees", "followers"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function countdown($ticket_id)
    {
        $ticket_info = ticket::with("priority_type")->where('ticket_id', $ticket_id)->firstOrFail();
        $countdown = countdown::where("ticket_id", $ticket_id)->first();
        if ($countdown == null) {
            $countdownCreate = new countdown();
            $countdownCreate->ticket_id = $ticket_id;
            $countdownCreate->endtime = \Carbon\Carbon::now("Asia/Yangon")->addHour($ticket_info->priority_type->hours)->addMinutes($ticket_info->priority_type->minutes)->addSeconds($ticket_info->priority_type->seconds);
            $countdownCreate->save();
            $solveTime = new solvedTime();
            $solveTime->ticket_id = $ticket_info->id;
            $solveTime->startedTime = Carbon::now();
            $solveTime->agent_id = Auth::user()->id;
            $solveTime->priority = $ticket_info->priority;
            $solveTime->save();
        }
        return redirect("/tickets/$ticket_id");
    }

    public function statusChange(Request $request, $ticket_id)
    {
        $status = status::where("id", $request->status_change)->first();
        $statusOn = ticket::where("ticket_id", $ticket_id)->first();
        $statusOn->status = $request->status_change;
        $statusOn->updated_at = Carbon::now();
        $statusOn->update();
        $count = countdown::where("ticket_id", $ticket_id)->first();
        if ($count != null) {
            if ($status->status == "Complete") {
                $solveEndtime = solvedTime::where("ticket_id", $statusOn->id)->first();
                if ($solveEndtime->endTime == null) {
                    $solveEndtime->endTime = Carbon::now();
                    $solveEndtime->agent_id = Auth::user()->id;
                    $solveEndtime->update();
                }
            }
        }
        return redirect()->back();
    }

    public function assigned(Request $request)
    {
        if ($request->assignType == "agent") {
            $tickets = assign_ticket::all();
            $ticket_id = [];
            foreach ($tickets as $ticket) {
                array_push($ticket_id, $ticket->ticket_id);
            }
            for ($i = 0; $i < count($request->ticket_id); $i++) {
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
            return redirect()->back()->with("message", "Successful!");
        } elseif ($request->assignType == "dept") {
//            dd($request->all());
            $tickets = assignwithDept::all();
//            dd($tickets);
            $isassigned = [];
            foreach ($tickets as $ticket) {
                array_push($isassigned, $ticket->ticket_id);
            }
//            dd($request->all());

            for ($i = 0; $i < count($request->ticket_id); $i++) {
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

    public function reassign(Request $request)
    {
//        dd($request->all());
        if ($request->assignType == "agent") {
            $agentass = assign_ticket::where("ticket_id", $request->ticket_id)->first();
            if (isset($agentass)) {
                $agentass->agent_id = $request->assign_id;
                $agentass->update();
            } else {
                $agentass = new assign_ticket();
                $agentass->agent_id = $request->assign_id;
                $agentass->ticket_id = $request->ticket_id;
                $agentass->save();
                $deptass = assignwithdept::where("ticket_id", $request->ticket_id)->first();
                $deptass->delete();
            }

            return redirect()->back()->with("message", "Ticket Reassigned Successful!");
        } elseif ($request->assignType == "dept") {
            $deptass = assignwithdept::where("ticket_id", $request->ticket_id)->first();
//            dd($deptass);
            if (isset($deptass)) {
                $deptass->dept_id = $request->assign_id;
                $deptass->update();
            } else {
                $deptass = new assignwithdept();
                $deptass->dept_id = $request->assign_id;
                $deptass->ticket_id = $request->ticket_id;
                $deptass->save();
                $agentass = assign_ticket::where("ticket_id", $request->ticket_id)->first();
                $agentass->delete();
            }

        }
        return redirect()->back()->with("message", "Ticket Reassigned Successful!");
    }

    public function postcomment(Request $request)
    {

        $comments = new comment();
        $comments->ticket_id = $request->ticket_id;
        $comments->user_id = Auth::user()->id;
        $comments->comment = $request->comment;
        $comments->save();
        return redirect()->back();
    }

    public function cmtDelete($id)
    {
        $comment = comment::where("id", $id)->first();
        $comment->delete();
        return redirect()->back()->with("delete", "Comment Delete Successful");
    }

    public function follower(Request $request, $id)
    {

        for ($i = 0; $i < count($request->follower); $i++) {
            $ticket_follower = new ticketFollower();
            $ticket_follower->ticket_id = $id;
            $ticket_follower->emp_id = $request->follower[$i];
            $ticket_follower->save();
        }
        return redirect()->back()->with("message", "Successful");
    }

    public function removefollower($id)
    {
        $ticket_follower = ticketFollower::where("emp_id", $id)->first();
        $ticket_follower->delete();
        return redirect()->back();
    }

    public function ticktImport()
    {
        Excel::import(new ticket_import, request()->file('file'));
        return back();
    }

    public function dadbordCard($status)
    {
        $cardStatus = status::where("status", $status)->first();
        $tickets = ticket::with("priority_type", "cases", "status_type")->where("user_id", Auth::user()->uuid)->where("status", $cardStatus->id)->get();
        $assign_name = assign_ticket::with("agent", "agent_pp")->get();
        $assign_dept_name = assignwithdept::with("dept")->get();
        return view("userAdmin.dashbordcardLink", compact("tickets", "status", "assign_name", "assign_dept_name"));
    }
}
