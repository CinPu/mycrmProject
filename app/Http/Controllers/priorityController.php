<?php

namespace App\Http\Controllers;

use App\priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class priorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priorities = priority::where("admin_uuid", Auth::user()->uuid)->get();
        $isyellow=0;
        $isred=0;
        $isgreen=0;
            $isblue=0;

      foreach ($priorities as $priority){
        if ($priority->color=="primary") {
            $isblue=1;
        } elseif ($priority->color == "success") {
            $isgreen = 1;
        } elseif ($priority->color == "danger") {
            $isred = 1;
        } elseif ($priority->color == "warning") {
            $isyellow = 1;
        }
    }

        return view("userAdmin.priority",compact("priorities","isblue",'isgreen','isred','isyellow'));
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
        $priority=new priority();
        $priority->priority=$request->priority;
        $priority->color=$request->color;
        $priority->admin_uuid=Auth::user()->uuid;
        $priority->hours=$request->hour;
        $priority->minutes=$request->min;
        $priority->seconds=$request->sec;
        $priority->save();
        return redirect()->back()->with("message","Successful!");
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
        $priority=priority::where("id",$id)->first();
        if($request->hour==0 && $request->min==0 && $request->sec==0){
            $priority->priority=$request->priority;
            if($request->color!=null){
                $priority->color=$request->color;
            }
            $priority->update();
            return redirect()->back()->with("message","Priority Name Update Successful!");
        }else{
            $priority->priority=$request->priority;
            $priority->hours=$request->hour;
            $priority->minutes=$request->min;
            $priority->seconds=$request->sec;
            if($request->color!=null){
                $priority->color=$request->color;
            }
            $priority->update();
            return redirect()->back()->with("message","Updated Successful!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priority=priority::where("id",$id)->first();
        $priority->delete();
        return redirect()->back()->with("delete","Delete Successful!");
    }
}
