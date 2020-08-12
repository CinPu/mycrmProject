<?php

namespace App\Http\Controllers;

use App\agent;
use App\department;
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
        $depts=department::where("admin_uuid",Auth::user()->uuid)->get();
        return view("userAdmin.department",compact("depts"));
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
        $dept->save();
        return redirect()->back()->with("message","Successful");
    }
    public function dept_change(Request $request,$id)
    {
        $dept=agent::where("id",$id)->first();
        $dept->dept_id=$request->dept_change;
        $dept->update();
        return redirect()->back()->with("message","Update Successful!");

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
