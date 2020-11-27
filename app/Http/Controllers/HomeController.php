<?php

namespace App\Http\Controllers;
use App\agent;
use App\assign_ticket;
use App\assignwithdept;
use App\case_type;
use App\company;
use App\department;
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
            } elseif (Auth::user()->hasAnyRole("Agent")) {

            return view("Agent.home");
            }elseif (Auth::user()->hasAnyRole("Employee")){
                return view("Employee.employee_home");
            } else{
                return view("home");
            }
        }

    }
}
