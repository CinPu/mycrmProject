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
use App\tags_industry;
use App\user_employee;
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
        } else {
            $admin_company = company::where("admin_id", Auth::user()->id)->first();
            $allemployees = employee::where("admin_id", Auth::user()->id)->get();
            $allcustomers = customer::where("admin_company_id", $admin_company->id)->get();
        }
        $lastlead = leadModel::orderBy('id', 'desc')->where("company_id", $admin_company->id)->first();
        if (isset($lastlead)) {
            // Sum 1 + last id
            $lastlead->lead_id++;
            $lead_id = $lastlead->lead_id;
        } else {
            $lead_id = $admin_company->company_short_form . " - Lead" . "-00001";
        }
        $tags = tags_industry::all();
        $last_tag = tags_industry::orderBy('id', 'desc')->first();

        return view("lead.lead_create", compact("lead_id", "allemployees", "admin_company", "allcustomers", "tags", "last_tag"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return view("lead.lead_view", compact("lead","comments","allemps","followers"));
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
        return view("lead.edit", compact( "allemployees", "admin_company", "allcustomers", "tags", "last_tag","lead"));
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
        return redirect()->back()->with("message", "Succssful");
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
        dd($lead);
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
}
