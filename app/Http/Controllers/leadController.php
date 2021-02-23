<?php

namespace App\Http\Controllers;

use App\comment;
use App\company;
use App\customer;
use App\customerCompany;
use App\employee;
use App\lead_follower;
use App\leadModel;
use App\leead_comment;
use App\next_plan;
use App\position;
use App\tags_industry;
use App\user_employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class leadController extends Controller
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
            $company = company::where("admin_id", $authenticate_user->employee->admin_id)->first();
            $all_leads = leadModel::with("customer", "saleMan", "tags")->where("company_id", $company->id)->where("sale_man_id",$authenticate_user->emp_id)->get();
        } else {
            $company = company::where("admin_id", Auth::user()->id)->first();
            $all_leads = leadModel::with("customer", "saleMan", "tags")->where("company_id", $company->id)->get();
        }
        return view("lead.lead", compact("all_leads"));
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
            $admin_company = company::where("admin_id", $authenticate_user->employee->admin_id)->first();
            $allemployees = employee::where("admin_id", $authenticate_user->employee->admin_id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
            $companies=customerCompany::where("admin_id",$authenticate_user->employee->admin_id)->get();
            $lastcompany=customerCompany::orderBy('id', 'desc')->where("admin_id",$authenticate_user->employee->admin_id)->first();

        } else {
            $admin_company = company::where("admin_id", Auth::user()->id)->first();
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
            $lastcustomer=customer::orderBy('id', 'desc')->where("admin_company_id",$admin_company->id)->first();
            $lastcompany=customerCompany::orderBy('id', 'desc')->where("admin_id",Auth::user()->id)->first();
            $companies=customerCompany::where("admin_id",Auth::user()->id)->get();
        }
        $lastlead = leadModel::orderBy('id', 'desc')->where("company_id", $admin_company->id)->first();
        if (isset($lastlead)) {
            // Sum 1 + last id
            $lastlead->lead_id++;
            $lead_id = $lastlead->lead_id;
        } else {
            $lead_id ="#Lead" . "-0001";
        }
        if (isset($lastcustomer)) {
            // Sum 1 + last id
            $lastcustomer->customer_id ++;
            $client_id = $lastcustomer->customer_id;
        } else {
            $client_id= $admin_company->company_short_form." - Client"."-00001";
        }

        if (isset($lastcompany)) {
            // Sum 1 + last id
            $lastcompany->company_id ++;
            $company_id = $lastcompany->company_id;
        } else {
            $company_id="Company"."-00001";
        }
        $tags = tags_industry::all();
        $last_tag = tags_industry::orderBy('id', 'desc')->first();
        $position=position::all();

        return view("lead.lead_create", compact("lead_id","position","companies","company_id","client_id", "allemployees", "admin_company", "allcustomers", "tags", "last_tag"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        if($request->customer_id=="empty"||$request->tags=="empty"){
            return redirect()->back()->with("message","You need to select customer name and industry");
        }else {
            $lead = new leadModel();
            $lead->lead_id = $request->lead_id;
            $lead->title = $request->lead_title;
            $lead->company_id = $request->compay_id;
            $lead->customer_id = $request->customer_id;
            $lead->priority = $request->priority;
            if ($request->qualified == 1) {
                $lead->is_qualified = $request->qualified;
            } else {
                $lead->is_qualified = 0;
            }
            $lead->sale_man_id = $request->sale_man;
            $lead->tags_id = $request->tags;
            $lead->description = $request->description;
            $lead->save();
            if($request->checked=="on"){
                $next_plan=new next_plan();
                $next_plan->description=$request->next_plan_textarea;
                $next_plan->to_date=Carbon::create($request->to_date);
                $next_plan->from_date=Carbon::create($request->from_date);
                $next_plan->lead_id=$lead->id;
                $next_plan->work_done=0;
                $next_plan->save();
            }
            return redirect()->back()->with("message", "Succssful");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasAnyRole("Employee") || Auth::user()->hasAnyRole("TicketAdmin")) {
            $authenticate_user = user_employee::with("employee")->where("user_id", Auth::user()->id)->first();
            $allemployees = employee::where("admin_id", $authenticate_user->employee->admin_id)->get();

        } else {
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
        }
        $allemps=[];
        foreach ($allemployees as $emp){
            $employee=user_employee::with("employee","user")->where("emp_id",$emp->id)->first();
            if($employee!=null){
                array_push($allemps,$employee);
                }
        }
        $lead = leadModel::with("customer", "saleMan", "tags")->where('id', $id)->first();
        $comments=leead_comment::with("user")->where("lead_id",$id)->get();
        $followers=lead_follower::with("user")->where("lead_id",$id)->get();
        $next_plan=next_plan::where("lead_id",$id)->first();
        return view("lead.lead_view", compact("lead","comments","allemps","followers","next_plan"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasAnyRole("Employee") || Auth::user()->hasAnyRole("TicketAdmin")) {
            $authenticate_user = user_employee::with("employee")->where("user_id", Auth::user()->id)->first();
            $admin_company = company::where("admin_id", $authenticate_user->employee->admin_id)->first();
            $allemployees = employee::where("admin_id", $authenticate_user->employee->admin_id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
        } else {
            $admin_company = company::where("admin_id", Auth::user()->id)->first();
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
        }
        $tags = tags_industry::all();
        $last_tag = tags_industry::orderBy('id', 'desc')->first();
        $lead=leadModel::where("id",$id)->first();
        $next_plan=next_plan::where("lead_id",$id)->first();
        return view("lead.edit", compact( "allemployees", "admin_company", "allcustomers", "tags", "last_tag","lead","next_plan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lead = leadModel::where("id",$id)->first();
        $lead->lead_id = $request->lead_id;
        $lead->title = $request->lead_title;
        $lead->company_id = $request->compay_id;
        $lead->customer_id = $request->customer_id;
        $lead->priority = $request->priority;
        if ($request->qualified == 1) {
            $lead->is_qualified = $request->qualified;
        } else {
            $lead->is_qualified = 0;
        }
        $lead->sale_man_id = $request->sale_man;
        $lead->tags_id = $request->tags;
        $lead->description = $request->description;
        $lead->update();
        if($request->checked=="on"){
            $next_plan=next_plan::where("lead_id",$id)->first();
            if($next_plan!=null){
                $next_plan->from_date=$request->from_date;
                $next_plan->to_date=$request->to_date;
                $next_plan->description=$request->next_plan_textarea;
                $next_plan->update();

            }else{
                $validated = $request->validate([
                    'from_date'=>'required',
                    'to_date'=>'required',
                    'next_plan_textarea'=>'required'
                ]);
                $new_next_plan=new next_plan();
                $new_next_plan->from_date=$request->from_date;
                $new_next_plan->to_date=$request->to_date;
                $new_next_plan->description=$request->next_plan_textarea;
                $new_next_plan->lead_id=$id;
                $new_next_plan->work_done=0;
                $new_next_plan->save();
            }
        }
        return redirect("lead/view/$id")->with("message", "Succssful");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead=leadModel::where("id",$id)->first();
        $lead->delete();
        return redirect()->back()->with("message","Delete $lead->title successful");
    }
    public function qualified($id){
        $lead=leadModel::where("id",$id)->first();
        $lead->is_qualified=1;
        $lead->update();
        return redirect()->back()->with("message","$lead->title is qualified now!");
    }

    public function tag_add(Request $request)
    {
        $tag = new tags_industry();
        $tag->tag_industry = $request->tag_industry;
        $tag->save();
        return response()->json([
            'tags' => "success",
        ]);
    }
public function comment(Request $request){
    $comments = new leead_comment();
    $comments->lead_id = $request->lead_id;
    $comments->user_id = Auth::user()->id;
    $comments->comment = $request->comment;
    $comments->save();
    return redirect()->back();
}
    public function comment_delete($id){
        $comment=leead_comment::where("id",$id)->first();
        $comment->delete();
        return redirect()->back();
    }
    public function lead_follower(Request $request,$id){
        for ($i = 0; $i < count($request->follower); $i++) {
          $isfollowed=lead_follower::where("lead_id",$id)->where("follower_id",$request->follower[$i])->first();
          if($isfollowed==null){
              $ticket_follower = new lead_follower();
              $ticket_follower->lead_id = $id;
              $ticket_follower->follower_id = $request->follower[$i];
              $ticket_follower->save();
          }else{
          }
        }
        return redirect()->back();
    }
    public function work_done($id){
        $lead=next_plan::where("lead_id",$id)->first();
        $lead->work_done=1;
        $lead->update();
        return redirect()->back()->with("message","Congratulations your next plan completed");
    }
}
