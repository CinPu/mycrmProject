<?php

namespace App\Http\Controllers;

use App\company;
use App\customer;
use App\employee;
use App\position;
use App\user_employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole("Admin")){
            $companies=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
            $company=company::where("admin_id",Auth::user()->id)->where("is_admin_company",1)->first();
            $allclients=customer::with("customer_position","customer_company")->where("admin_company_id",$company->id)->get();
        }elseif (Auth::user()->hasAnyRole("TicketAdmin")||Auth::user()->hasAnyRole("Employee"))
            {
            $authenticate_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
            $companies=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
            $auth_emp=employee::where("id",$authenticate_user->emp_id)->first();
            $allclients=customer::with("customer_position","customer_company")->where("admin_id",$auth_emp->admin_id)->get();
            }
        return  view("client.clients",compact("allclients","companies"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

//        dd($lastcustomer);
        if(Auth::user()->hasAnyRole("Employee")||Auth::user()->hasAnyRole("TicketAdmin")){

            $auth_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
            $lastcompany=company::orderBy('id', 'desc')->where("admin_id",$auth_user->employee->admin_id)->where("is_admin_company",0)->first();
            $authenticate_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
            $admin_company=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",1)->first();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
            $companies=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
        }else{
            $admin_company=company::where("admin_id",Auth::user()->id)->first();
            $lastcompany=company::orderBy('id', 'desc')->where("admin_id",Auth::user()->id)->where("is_admin_company",0)->first();
            $companies=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();

        }
        if (isset($lastcustomer)) {
            // Sum 1 + last id
            $lastcustomer->customer_id ++;
            $client_id = $lastcustomer->customer_id;
        } else {
            $client_id="Client"."-00001";
        }

        if (isset($lastcompany)) {
            // Sum 1 + last id
            $lastcompany->company_id ++;
            $company_id = $lastcompany->company_id;
        } else {
            $company_id="Company"."-00001";
        }
        $position=position::all();
//dd($company);
        return  view("client.clientadd",compact("client_id","position","companies","company_id","admin_company","id"));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"=>"required",
            "phone"=>"required|min:11",
            "department"=>"required",
            "report_to"=>"required",
            "email" => "required|email|unique:customers",
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        $client=new customer();
        $image=$request->file("profile");
        if($image!=null) {
            $name = $image->getClientOriginalName();
            $request->profile->move(public_path() . '/profile/', $name);
            $client->profile = $name;
        }
        $client->customer_name=$request->name;
        $client->customer_id=$request->customer_id;
        $client->email=$request->email;
        $client->phone=$request->phone;
        $client->position=$request->position;
        $client->department=$request->department;
        $client->company_id=$request->company_id;
        $client->address=$request->address;
        $client->admin_id=Auth::user()->id;
        $client->report_to=$request->report_to;
        $client->admin_company_id=$request->admin_company;
        $client->save();
        if($request->type=="ajax"){
            return response()->json([
                'contact' => "success",
            ]);
        }else {
            if ($request->id == 0) {
                return redirect("/client")->with("message", "Customer Create Success");
            } elseif ($request->id == 1) {
                return redirect("/lead/create")->with("message", "Customer Create Success and select new customer name");
            }
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
        if(Auth::user()->hasAnyRole("Admin")){
            $companies=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
        }else{
            $authenticate_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
            $companies=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
        }
        $customer=customer::with("customer_company","customer_position","user")->where("id",$id)->first();
        $position=position::all();
        return view("client.client-profile",compact("customer","companies","position"));
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
//        dd($request->all());
        $client=customer::where("id",$id)->first();
        $image=$request->file("profile");
        if($image!=null) {
            $name = $image->getClientOriginalName();
            $request->profile->move(public_path() . '/profile/', $name);
            $client->profile = $name;
        }
        $client->customer_name=$request->name;
        $client->customer_id=$request->customer_id;
        $client->email=$request->email;
        $client->phone=$request->phone;
        $client->position=$request->position;
        $client->department=$request->department;
        $client->company_id=$request->company_id;
        $client->address=$request->address;
        $client->report_to=$request->report_to;
        $client->update();
        return redirect()->back()->with("message","Customer Edit Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client=customer::where("id",$id)->first();
       $client->delete();
       return  redirect()->back()->with("delete","Customer Delete Success");
    }
    public function filter(Request $request)
    {
            if($request->client_id!=null && $request->client_name!=null && $request->company!="Select Company") {
                $filter_results=customer::with("customer_position", "customer_company")->where("customer_id",$request->client_id)->orWhere("customer_name",$request->client_name)->orWhere("company_id",$request->company)->get();
//            dd($filter_results);
            }elseif ($request->client_id==null && $request->client_name==null && $request->company=="Select Company"){
                return redirect()->back();
            }
            else{
                if ($request->client_id==null && $request->client_name!=null && $request->company!="Select Company"){
                 $filter_results=customer::with("customer_position", "customer_company")->orWhere("customer_name",$request->client_name)->orWhere("company_id",$request->company)->get();
//            dd($filter_results);
                }elseif($request->client_id!=null && $request->client_name==null && $request->company!="Select Company"){
                    $filter_results=customer::with("customer_position", "customer_company")->where("customer_id",$request->client_id)->orWhere("company_id",$request->company)->get();
//                    dd($filter_results);
                }elseif ( $request->client_id!=null && $request->client_name!=null && $request->company=="Select Company"){
                    $filter_results=customer::with("customer_position", "customer_company")->where("customer_id",$request->client_id)->orWhere("customer_name",$request->client_name)->get();
//                    dd($filter_results);
                }elseif ( $request->client_id!=null && $request->client_name==null && $request->company=="Select Company"){
                    $filter_results=customer::with("customer_position", "customer_company")->where("customer_id",$request->client_id)->get();
//                    dd($filter_results);
                }elseif ( $request->client_id==null && $request->client_name!=null && $request->company=="Select Company"){
                    $filter_results=customer::with("customer_position", "customer_company")->where("customer_name",$request->client_name)->get();
//                    dd($filter_results);
                }elseif ( $request->client_id==null && $request->client_name==null && $request->company!="Select Company"){
                    $filter_results=customer::with("customer_position", "customer_company")->where("company_id",$request->company)->get();
//                    dd($filter_results);
                }
            }
        return view("client.filterResult",compact("filter_results"));
    }
}
