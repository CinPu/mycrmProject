<?php

namespace App\Http\Controllers;

use App\agent;
use App\department;
use App\department_head;
use App\deptart_head;
use App\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents=agent::with("user")->where("admin_id",Auth::user()->id)->get();
        $depts=department::with("department_head")->where("admin_uuid",Auth::user()->uuid)->get();
        return view("userAdmin.department",compact("depts","agents"));
    }
    public function set_dept_head(Request $request,$id){
        if($request->dept_head!=0) {
            $dept_head = department::where("id", $id)->first();
            $dept_head->dept_head = $request->dept_head;
            $dept_head->update();
            return redirect()->back()->with("message", "Setup Department Head Successful");
        }else{
            return redirect()->back()->with("delete","You need to create Agent First!");
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
        $dept=new department();
        $dept->dept_name=$request->dept_name;
        $dept->admin_uuid=Auth::user()->uuid;
        $dept->dept_head=Auth::user()->id;
        $dept->save();
        return redirect()->back()->with("message","Successful");
    }
    public function dept_change(Request $request,$id)
    {
        $dept=employee::where("emp_id",$id)->first();
        $dept->dept_id=$request->dept_change;
        $dept->update();
        $agent_dept=agent::where("agent_id",$id)->first();
        $agent_dept->dept_id=$request->dept_change;
        $agent_dept->update();
        return redirect()->back()->with("message","Update Successful!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMember($id)
    {
        $members=agent::with("user")->where("dept_id",$id)->get();
        $dept=department::where("id",$id)->first();
//        dd($members);
        return view("userAdmin.deptMember",compact("members","dept"));
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
        $dept=department::where("id",$id)->first();
        $dept->dept_name=$request->dept_name;
        $dept->update();
        return redirect()->back()->with("message","Your Upadated is Successful");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept=department::where("id",$id)->first();
        $dept->delete();
        return redirect()->back()->with("delete","Delete Successful");
    }
}
