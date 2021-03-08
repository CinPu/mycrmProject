<?php

namespace App\Http\Controllers;

use App\camping_type;
use App\company;
use App\customer;
use App\deal;
use App\employee;
use App\position;
use App\product;
use App\product_category;
use App\product_tax;
use App\user_employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyRole("Employee") || Auth::user()->hasAnyRole("TicketAdmin")) {
            $authenticate_user = user_employee::with("employee")->where("user_id", Auth::user()->id)->first();
            $admin_company = company::where("admin_id", $authenticate_user->employee->admin_id)->where("is_admin_company",1)->first();
            $alldeals=deal::with("customer_company","customer","employee")->where("admin_company",$admin_company->id)->get();
            $allemployees = employee::where("admin_id", $authenticate_user->employee->admin_id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $orgs=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
            $companies=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
            $products=product::with("category","taxes")->where("company_id",$admin_company->id)->get();
        }else{
            $admin_company = company::where("admin_id", Auth::user()->id)->where("is_admin_company",1)->first();
            $alldeals=deal::with("customer_company","customer","employee")->where("admin_company",$admin_company->id)->get();
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $companies=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
            $products=product::with("category","taxes")->where("company_id",$admin_company->id)->get();

        }
        return  view("Deal.index",compact("alldeals","allemployees","allcustomers","companies","products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasAnyRole("Employee") || Auth::user()->hasAnyRole("TicketAdmin")) {
            $authenticate_user = user_employee::with("employee")->where("user_id", Auth::user()->id)->first();
            $admin_company = company::where("admin_id", $authenticate_user->employee->admin_id)->where("is_admin_company",1)->first();
            $allemployees = employee::where("admin_id", $authenticate_user->employee->admin_id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
            $companies=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
            $products=product::with("category","taxes")->where("company_id",$admin_company->id)->get();
        } else {
            $admin_company = company::where("admin_id", Auth::user()->id)->where("is_admin_company",1)->first();
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $companies=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
            $products=product::with("category","taxes")->where("company_id",$admin_company->id)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
        }
        $lastcompany=company::orderBy('id', 'desc')->where("admin_id",Auth::user()->id)->where("is_admin_company",0)->first();
        if (isset($lastcompany)) {
            // Sum 1 + last id
            $lastcompany->company_id ++;
            $company_id = $lastcompany->company_id;
        } else {
            $company_id="Company"."-00001";
        }

        if (isset($lastcustomer)) {
            // Sum 1 + last id
            $lastcustomer->customer_id ++;
            $client_id = $lastcustomer->customer_id;
        } else {
            $client_id=" Client"."-00001";
        }

        $position=position::all();
        $taxes=product_tax::all();
        $lasttax=product_tax::orderBy('id', 'desc')->first();
        $allcat=product_category::all();
        $lastcat=product_category::orderBy('id', 'desc')->first();

        return  view("Deal.create",compact("products","taxes","lasttax","lastcat","allcat","lasttax","allemployees","admin_company","companies","position","client_id","company_id","allcustomers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$type)
    {
//        dd($request->all());
       $deal=new deal();
       if($type=="quick"){
           $deal->name=$request->name;
           $deal->amount=$request->amount;
           $deal->unit=$request->currency;
           $deal->org_name=$request->org_name;
           $deal->close_date=Carbon::create($request->close_date);
           $deal->pipeline=$request->pipeline;
           $deal->sale_stage=$request->sale_stage;
           $deal->assign_to=$request->assign_to;
           $deal->lead_source=$request->lead_source;
           $deal->probability=$request->propability;
           $deal->admin_company=$request->admin_company;
           $deal->save();
           return response()->json([
               'mission'=>"complete"
           ]);
       }else{
           $deal->name=$request->name;
           $deal->amount=$request->amount;
           $deal->unit=$request->unit;
           $deal->org_name=$request->full_org;
           $deal->contact=$request->contact;
           $deal->close_date=$request->exp_date;
           $deal->pipeline=$request->pipeline;
           $deal->sale_stage=$request->sale_stage;
           $deal->assign_to=$request->asign_to;
           $deal->lead_source=$request->lead_source;
           $deal->next_step=$request->next_step;
           $deal->type=$request->type;
           $deal->probability=$request->probability;
           $deal->weighted_revenue=$request->weight_revenue;
           $deal->weighed_revenue_unit=$request->revenue_unit;
           $deal->lost_reason=$request->lost_reason;
           $deal->description=$request->description;
           $deal->admin_company=$request->admin_company;
           $deal->save();
           return response()->json([
               'mission'=>"complete"
           ]);

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
        $deal=deal::with("customer_company","customer","employee")->where("id",$id)->first();
        return view("Deal.show",compact("deal"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasAnyRole("Employee") || Auth::user()->hasAnyRole("TicketAdmin")) {
            $authenticate_user = user_employee::with("employee")->where("user_id", Auth::user()->id)->first();
            $admin_company = company::where("admin_id", $authenticate_user->employee->admin_id)->first();
            $allemployees = employee::where("admin_id", $authenticate_user->employee->admin_id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
            $companies=company::where("admin_id",$authenticate_user->employee->admin_id)->where("is_admin_company",0)->get();
            $products=product::with("category","taxes")->where("company_id",$admin_company->id)->get();
        } else {
            $admin_company = company::where("admin_id", Auth::user()->id)->first();
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $companies=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
            $products=product::with("category","taxes")->where("company_id",$admin_company->id)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
        }
        $lastcompany=company::orderBy('id', 'desc')->where("admin_id",Auth::user()->id)->where("is_admin_company",0)->first();
        if (isset($lastcompany)) {
            // Sum 1 + last id
            $lastcompany->company_id ++;
            $company_id = $lastcompany->company_id;
        } else {
            $company_id="Company"."-00001";
        }

        if (isset($lastcustomer)) {
            // Sum 1 + last id
            $lastcustomer->customer_id ++;
            $client_id = $lastcustomer->customer_id;
        } else {
            $client_id= $admin_company->company_short_form." - Client"."-00001";
        }

        $position=position::all();
        $taxes=product_tax::all();
        $lasttax=product_tax::orderBy('id', 'desc')->first();
        $allcat=product_category::all();
        $lastcat=product_category::orderBy('id', 'desc')->first();
        $deal=deal::where("id",$id)->first();

        return  view("Deal.edit",compact("products","deal","taxes","lasttax","lastcat","allcat","lasttax","allemployees","admin_company","companies","position","client_id","company_id","allcustomers"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $deal=deal::where("id",$request->deal_id)->first();
        $deal->name=$request->name;
        $deal->amount=$request->amount;
        $deal->unit=$request->unit;
        $deal->org_name=$request->full_org;
        $deal->contact=$request->contact;
        $deal->close_date=$request->exp_date;
        $deal->pipeline=$request->pipeline;
        $deal->sale_stage=$request->sale_stage;
        $deal->assign_to=$request->asign_to;
        $deal->lead_source=$request->lead_source;
        $deal->next_step=$request->next_step;
        $deal->type=$request->type;
        $deal->probability=$request->probability;
        $deal->weighted_revenue=$request->weight_revenue;
        $deal->weighed_revenue_unit=$request->revenue_unit;
        $deal->lost_reason=$request->lost_reason;
        $deal->description=$request->description;
        $deal->admin_company=$request->admin_company;
        $deal->update();
        return response()->json([
            'mission'=>"complete"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deal=deal::where("id",$id)->first();
        $deal->delete();
        return redirect("deal")->with("message","$deal->name Delete Successful");
    }
    public function camping(Request $request){
        $camping=new camping_type();
        $camping->name=$request->name;
        $camping->exp_date=$request->exp_date;
        $camping->assign_to=$request->assign_to;
        $camping->product_id=$request->product;
        $camping->camp_type=$request->type;
        $camping->camp_status=$request->status;
        $camping->exp_response=$request->exp_respon;
        $camping->company_id=$request->admin_company;
        $camping->save();
        return response()->json([
            'camp_add' => "success",
        ]);
    }
    public function sale_stage_change(Request $request){
       $deal=deal::where("id",$request->deal_id)->first();
       $deal->sale_stage=$request->sale_stage;
       $deal->update();
       return redirect("/deal")->with("message","Sale stage change to $deal->sale_stage");
    }
}
