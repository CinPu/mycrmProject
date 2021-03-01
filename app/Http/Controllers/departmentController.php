<?php

namespace App\Http\Controllers;

use App\agent;
use App\company;
use App\department;
use App\department_head;
use App\deptart_head;
use App\employee;
use App\Imports\dept_import;
use App\position;
use App\User;
use App\user_employee;
use App\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depts=department::with("department_head")->where("admin_uuid",Auth::user()->uuid)->get();
        $lastedept=department::with("department_head")->orderBy('created_at', 'desc')->where("admin_uuid",Auth::user()->uuid)->first();
        $company=company::where("admin_id",Auth::user()->id)->where("is_admin_company",1)->first();
//        dd($company);
        if (isset($lastedept)) {
            // Sum 1 + last id
            $lastedept->dept_id ++;
            $dept_id = $lastedept->dept_id;
        } else {
            $dept_id="Dept"."-00001";
        }
        $positions=position::all();

        $lastemployee        =   employee::orderBy('created_at', 'desc')->where("admin_id",Auth::user()->id)->first();
//        dd($company);
        if (isset($lastemployee)) {
            // Sum 1 + last id
            $lastemployee->employee_id ++;
            $emp_id = $lastemployee->employee_id;
        } else {
            $emp_id= "Emp"."-00001";
        }
        $employees=employee::with("report_to_user","department","company","position")->where("admin_id",Auth::user()->id)->get();
        $roles= $roles=Role::all();
        $report_to=[];
        foreach ($employees as $emp){
            $user_emp=user_employee::with("user")->where("emp_id",$emp->id)->first();
            if($user_emp!=null){
                array_push($report_to,$user_emp);
            }
        }
        return view("userAdmin.department",compact("depts","report_to","roles","dept_id","emp_id","positions","company"));
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
            $dept->dept_id=$request->dept_id;
            $dept->admin_uuid=Auth::user()->uuid;
            $dept->save();
        return redirect()->back()->with("message","Successful");
    }
    public function emp_dept_haad(Request $request){
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:employees",
            "name"=>"required",
            "phone"=>"required|min:11",

        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

//        dd($request->all());
        $users=User::where("email",$request->email)->first();
        if($users==null) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->uuid = $request->uuid;
            $user->save();
            $employee = new employee();
            $employee->employee_id = $request->emp_id;
            $employee->name = $request->name;
            $employee->marital_status = $request->marital_status;
            $employee->email = $request->email;
            $employee->report_to = Auth::user()->id;
            $employee->dept_id = $request->department;
            $employee->emp_post = $request->position;
            $employee->gender = $request->gender;
            $employee->nrc = $request->nrc;
            $image = $request->profile;
            if ($image != null) {
                $name = $image->getClientOriginalName();
                $request->profile->move(public_path() . '/profile/', $name);
                $employee->emp_profile = $name;
            }
            $employee->nationality = $request->nationality;
            $employee->admin_id = Auth::user()->id;
            $employee->company_id = $request->company;
            $employee->join_date = Carbon::create($request->join_date);
            $employee->phone = $request->phone;
            $employee->save();
            $user_emp = new user_employee();
            $user_emp->user_id = $user->id;
            $user_emp->emp_id = $employee->id;
            $user_emp->save();
            $user->assignRole("Employee");
            $dept=department::where("id","$request->department")->first();
            $lastuser = User::orderBy('created_at', 'desc')->first();
            $dept->dept_head=$lastuser->id;
            $dept->update();
            return redirect("/department")->with("message","Successful");
        }else{
            return redirect("/department")->with("delete","Email already Exist");
        }

    }
    public function dept_change(Request $request,$id)
    {
        $agent_emp=user_employee::where("user_id",$id)->first();
        $dept=employee::where("id",$agent_emp->emp_id)->first();
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
        $members=employee::where("dept_id",$id)->get();
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
        $dept->dept_head=$request->dept_head;
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
    public function import(){
        Excel::import(new dept_import(),request()->file('file'));
        return back();
    }
}
