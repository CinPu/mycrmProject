<?php

namespace App\Http\Controllers;

use App\agent;
use App\rolemangeController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RolemangeControllerController extends Controller
{
    public function index(){
        $employees=[];
        $roles=Role::all();
        $agents=agent::with("user")->where("admin_id",Auth::user()->id)->get();
        foreach ($agents as $agent){
            array_push($employees,$agent->user);
        }
        return view("userAdmin.roleManagement",compact("employees","roles"));
    }
    public function roleManage($id){
        $user=User::whereId("$id")->first();
        $roles=Role::all();

        return view("SuperAdmin.home",compact("user","roles"));
    }
    public function insertRole(Request $request,$uid){
        $user=User::whereId($uid)->first();
        foreach ($request->rolename as $rolename) {
            $user->assignRole($rolename);
        }
        return redirect()->back()->with("success","Role Insert Successfully");
    }
    public function removeRole(Request $request,$uid){
        $user=User::whereId($uid)->first();
        foreach ($request->rolename as $rolename) {
            $user->removeRole($rolename);
        }
        return redirect()->back()->with("success","Role Remove Successfully");
    }
}
