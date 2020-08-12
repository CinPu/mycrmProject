<?php

namespace App\Http\Controllers;

use App\rolemangeController;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolemangeControllerController extends Controller
{
    public function roleManage($id){
        $user=User::whereId("$id")->first();
        $roles=Role::all();

        return view("SuperAdmin.home",compact("user","roles"));
    }
    public function insertRole(Request $request,$uid){
        $user=User::whereId($uid)->first();
        $user->assignRole($request->rolename);
        return redirect()->back()->with("success","Role Insert Successfully");
    }
    public function removeRole(Request $request,$uid){
        $user=User::whereId($uid)->first();
        $user->removeRole($request->rolename);
        return redirect()->back()->with("success","Role Remove Successfully");
    }
}
