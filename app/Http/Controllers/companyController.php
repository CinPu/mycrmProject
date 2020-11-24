<?php

namespace App\Http\Controllers;

use App\company;
use App\customerCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class companyController extends Controller
{
    public function index(){
        return view("company.company");
    }
    public function store(Request $request){
        $company=new company();
        $company->admin_id=Auth::user()->id;
        $company->company_name=$request->name;
        $company->company_email=$request->email;
        $company->company_phone=$request->phone;
        $company->company_address=$request->address;
        $image=$request->file("logo");
        $name=$image->getClientOriginalName();
        $request->logo->move(public_path().'/companylogo/', $name);
        $company->company_logo=$name;
        $company->company_short_form=$request->short_form;
        $company->save();
        $user=Auth::user();
        $user->assignRole("Admin");
        return redirect()->back();
    }
    public function engagedCompany(){
        $allcompany=customerCompany::where("admin_id",Auth::user()->id)->get();
        return view("company.engagedCompany",compact("allcompany"));
    }
    public function create(Request $request){
        $company=new customerCompany();
        $company->admin_id=Auth::user()->id;
        $company->name=$request->name;
        $company->email=$request->email;
        $company->phone=$request->phone;
        $company->hotline=$request->hotline;
        $company->company_website=$request->web_link;
        $company->company_address=$request->address;
        $image=$request->file("logo");
        $name=$image->getClientOriginalName();
        $request->logo->move(public_path().'/companylogo/', $name);
        $company->logo=$name;
        $company->company_shortname	=$request->short_form;
        $company->save();
        return redirect()->back()->with("message","Company Create Successful!");

    }
    public function profile($id){
        $company=customerCompany::where("id",$id)->first();
        return view("company.company_profile",compact("company"));
    }
    public function companyedit($id){
        $company=customerCompany::where("id",$id)->first();
        return view("company.edit",compact("company"));

    }
    public function companyupdate(Request $request,$id){
        $company=customerCompany::where("id",$id)->first();
        $company->admin_id=Auth::user()->id;
        $company->name=$request->name;
        $company->email=$request->email;
        $company->phone=$request->phone;
        $company->hotline=$request->hotline;
        $company->company_website=$request->web_link;
        $company->company_address=$request->address;
        if($request->logo!=null) {
            $image = $request->file("logo");
            $name = $image->getClientOriginalName();
            $request->logo->move(public_path() . '/companylogo/', $name);
            $company->logo = $name;
        }
        $company->company_shortname	=$request->short_form;
        $company->update();
        return redirect("company/profile/$id")->with("message","Updated Successful!");

    }
    public function destory($id){
        $company=customerCompany::where("id",$id)->first();
        $company->delete();
        return redirect()->back()->with("delete","Company Delete Successful!");
    }
}
