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
        $lastcompany=customerCompany::orderBy('created_at', 'desc')->where("admin_id",Auth::user()->id)->first();
        if (isset($lastcompany)) {
            // Sum 1 + last id
            $lastcompany->employee_id ++;
            $company_id = $lastcompany->company_id;
        } else {
            $company_id="Company"."-00001";
        }
        $allcompany=customerCompany::where("admin_id",Auth::user()->id)->get();
        return view("company.engagedCompany",compact("allcompany","company_id"));
    }
    public function create(Request $request){
        $company=new customerCompany();
        $company->admin_id=Auth::user()->id;
        $company->company_id=$request->company_id;
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
        $company->company_registry=$request->company_retistry;
        $company->company_mission=$request->mission;
        $company->company_vision=$request->vision;
        $company->type_of_business=$request->business_type;
        $company->name_of_ceo=$request->ceo;
        $company->facebookpage=$request->facebook_page;
        $company->linkedin=$request->linked_in;
        $company->parent_company=$request->parent;
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
    public function update(Request $request,$type,$id){
        $company=customerCompany::where("id",$id)->first();
        if($type=="info"){
            $company->company_id=$request->company_id;
            $company->name=$request->name;
            $company->email=$request->email;
            $company->phone=$request->phone;
            $company->hotline=$request->hotline;
            $company->company_website=$request->web_link;
            $company->company_address=$request->address;
            $image=$request->file("logo");
            if($image!=null) {
                $name = $image->getClientOriginalName();
                $request->logo->move(public_path() . '/companylogo/', $name);
                $company->logo = $name;
            }
            $company->type_of_business=$request->business_type;
            $company->name_of_ceo=$request->ceo;
            $company->facebookpage=$request->facebook_page;
            $company->linkedin=$request->linked_in;
            $company->parent_company=$request->parent;
            $company->update();
            return redirect()->back()->with("message","Company Information update successful!");
        }elseif ($type=="mission"){
            $company->company_mission=$request->mission;
            $company->update();
            return redirect()->back()->with("message","Company Mission update successful!");
        }elseif ($type=="registry"){
            $company->company_registry=$request->registry;
            $company->update();
            return redirect()->back()->with("message","Company Registry update successful!");
        }elseif ($type=="vision"){
            $company->company_vision=$request->vision;
            $company->update();
            return redirect()->back()->with("message","Company Vision update successful!");
        }

    }
    public function delete($id){
        $company=customerCompany::where("id",$id)->first();
        $company->delete();
        return redirect("/engaged/company")->with("message","$company->name delete Successful");
    }
}
