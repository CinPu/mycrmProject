<?php

namespace App\Http\Controllers;
use App\agent;
use App\assign_ticket;
use App\assignwithdept;
use App\case_type;
use App\company;
use App\department;
use App\employee;
use App\priority;
use App\status;
use App\ticket;
use App\ticketFollower;
use App\User;
use App\userprofile;
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

                return view("userAdmin.home");
                //end for admin user
            }elseif (Auth::user()->hasAnyRole("TicketAdmin")){
                //select admin's agent
                $tickets = [];
                //admin's agent all ticket select
                $agents = agent::with("user")->where("admin_id", Auth::user()->id)->get();
//                  dd($agents);
                foreach ($agents as $agent) {
                    $agents_tickets = ticket::with("priority_type", "cases", "status_type")->where("user_id", $agent->user->uuid)->get();
                    //all agents' ticket add to tickets[]
                    foreach ($agents_tickets as $agent_ticket) {
                        array_push($tickets, $agent_ticket);
                    }
                }
                //ticket for admin from user to admin
                $user_tickets = ticket::with("priority_type", "cases", "status_type")->where("user_id", Auth::user()->uuid)->get();
                foreach ($user_tickets as $user_ticket) {
                    array_push($tickets, $user_ticket);
                }
                //count ticket each status;
                $countAgent = count($agents);
                $countallticket = count($tickets);
                $openticket = 0;
                $closeticket = 0;
                $complete = 0;
                $pending = 0;
                $progress = 0;
                $new = 0;
                //end of ticket count
                $assigned = [];
                $unassigned = [];
                foreach ($tickets as $t) {
                    if ($t->status_type->status == "Close") {
                        $closeticket++;
                    } elseif ($t->status_type->status == "Complete") {
                        $complete++;
                    } elseif ($t->status_type->status == "Open") {
                        $openticket++;
                    } elseif ($t->status_type->status == "Pending") {
                        $pending++;
                    } elseif ($t->status_type->status == "Progress") {
                        $progress++;
                    } elseif ($t->status_type->status == "New") {
                        $new++;
                    }
                    if ($t->isassign == 0) {
                        array_push($unassigned, $t);
                    } elseif ($t->isassign == 1) {
                        array_push($assigned, $t);
                    }
                }
                $allcases = case_type::where("admin_uuid", Auth::user()->uuid)->get();
                $priorities = priority::where("admin_uuid", Auth::user()->uuid)->get();
                $statuses = status::all();

//            dd($tickets);
                $depts = department::where("admin_uuid", Auth::user()->uuid)->get();
                $assign_name = assign_ticket::with("employee")->get();
                $employee = employee::where("admin_id", Auth::user()->id)->get();
                $assign_dept_name = assignwithdept::with("dept")->get();
                return view("userAdmin.ticketdashboard", compact("agents", "assigned", "unassigned", "depts", "pending", "allcases", "progress", "countallticket", "tickets", "openticket", "closeticket", "complete", "new", "countAgent", "priorities", "statuses", "assign_name", "assign_dept_name", "employee"));
                //end for admin user


            }
            elseif (Auth::user()->hasAnyRole("Agent")) {
                    return view("Agent.home");
            }elseif (Auth::user()->hasAnyRole("Employee")){
                return view("Employee.employee_home");
            } else{
                return view("home");
            }
        }

    }
}
