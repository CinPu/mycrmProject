<?php

namespace App\Http\Controllers;

use App\company;
use App\customer;
use App\Imports\companyimport;
use App\user_employee;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class companyController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $company=new company();
        $company->company_id=$request->company_id;
        $company->name=$request->name;
        $company->email=$request->email;
        $company->phone=$request->phone;
        $company->hotline=$request->hotline;
        $company->company_website=$request->web_link;
        $company->company_address=$request->address;
        $company->company_registry=$request->company_retistry;
        $company->company_mission=$request->mission;
        $company->company_vision=$request->vision;
        $company->type_of_business=$request->business_type;
        $company->name_of_ceo=$request->ceo;
        $company->facebookpage=$request->facebook_page;
        $company->linkedin=$request->linked_in;
        $company->parent_company=$request->parent;
        $company->is_admin_company=1;
        $company->admin_id=Auth::user()->id;
        $image=$request->file("logo");
        if($image!=null) {
            $name = $image->getClientOriginalName();
            $request->logo->move(public_path() . '/companylogo/', $name);
            $company->logo = $name;

        }
        $company->save();
        $user=Auth::user();
        $user->assignRole("Admin");
        return redirect()->back();
    }
    public function engagedCompany(){
        $lastcompany=company::orderBy('id', 'desc')->where("admin_id",Auth::user()->id)->where("is_admin_company",0)->first();
        if (isset($lastcompany)) {
            // Sum 1 + last id
            $lastcompany->company_id ++;
            $company_id = $lastcompany->company_id;
        } else {
            $company_id="Company"."-00001";
        }
        $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->get();
        return view("company.engagedCompany",compact("allcompany","company_id"));
    }
    public function create(Request $request,$type){
//        dd($request->all());
        $company=new company();
        if(Auth::user()->hasAnyRole("Admin")){
            $company->admin_id=Auth::user()->id;
        }else{
            $auth_user=user_employee::with("employee")->where("user_id",Auth::user()->id)->first();
            $company->admin_id=$auth_user->employee->admin_id;
        }
        $company->company_id=$request->company_id;
        $company->name=$request->name;
        $company->email=$request->email;
        $company->phone=$request->phone;
        $company->hotline=$request->hotline;
        $company->company_website=$request->web_link;
        $company->company_address=$request->address;
        $company->company_registry=$request->company_retistry;
        $company->company_mission=$request->mission;
        $company->company_vision=$request->vision;
        $company->type_of_business=$request->business_type;
        $company->name_of_ceo=$request->ceo;
        $company->facebookpage=$request->facebook_page;
        $company->linkedin=$request->linked_in;
        $company->parent_company=$request->parent;
        $company->is_admin_company=0;

        if($type=="ajax"){
            $company->save();
            return response()->json([
                'company_add' => "success",
            ]);
        }else {
            $image=$request->file("logo");
            if($image!=null) {
                $name = $image->getClientOriginalName();
                $request->logo->move(public_path() . '/companylogo/', $name);
                $company->logo = $name;

            }
            $company->save();
            return redirect()->back()->with("message", "Company Create Successful!");
        }

    }
    public function profile($id){
        $company=company::where("id",$id)->first();
        $staffs=customer::with("customer_position","customer_company")->where("company_id",$id)->get();
        return view("company.company_profile",compact("company","staffs"));
    }
    public function companyedit($id){
        $company=company::where("id",$id)->first();
        return view("company.edit",compact("company"));

    }
    public function companyupdate(Request $request,$id){
        $company=company::where("id",$id)->first();
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
        $company=company::where("id",$id)->first();
        $company->delete();
        return redirect()->back()->with("delete","Company Delete Successful!");
    }
    public function update(Request $request,$type,$id){
        $company=company::where("id",$id)->first();
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
        $company=company::where("id",$id)->first();
        $company->delete();
        return redirect("/engaged/company")->with("message","$company->name delete Successful");
    }
    public function import(){
        Excel::import(new companyimport(),request()->file('file'));
        return back();
    }
    public function filter(Request $request){
//        dd($request->all());
        if($request->company_id!=null && $request->company_name!=null && $request->company_type!=null) {
            $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->where("company_id",$request->company_id)->orWhere("name",$request->company_name)->orWhere("type_of_business",$request->company_type)->get();
//            dd($allcompany);
        }elseif ($request->company_id==null && $request->company_name==null && $request->company_type==null){
            return redirect()->back();
        }
        else{
            if ($request->company_id==null && $request->company_name!=null && $request->company_type!=null){
//                dd("name and type");
                $allcompany=company::where("admin_id",Auth::user()->id)->where("company_id",$request->company_id)->orWhere("name",$request->company_name)->orWhere("type_of_business",$request->company_type)->get();
//                dd($allcompany);
            }elseif($request->company_id!=null && $request->company_name==null && $request->company_type!=null){
                $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->where("company_id",$request->company_id)->orWhere("type_of_business",$request->company_type)->get();
//                dd($allcompany);

            }elseif ( $request->company_id!=null && $request->company_name!=null && $request->company_type==null){
                $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->where("company_id",$request->company_id)->orWhere("name",$request->company_name)->get();
//                dd($allcompany);
            }elseif ( $request->company_id!=null && $request->company_name==null && $request->company_type==null){
                $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->where("company_id",$request->company_id)->get();
//                dd($allcompany);
            }elseif ( $request->company_id==null && $request->company_name!=null && $request->company_type==null){
                $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->where("name",$request->company_name)->get();
//                dd($allcompany);
            }elseif ( $request->company_id==null && $request->company_name==null && $request->company_type!=null){
                $allcompany=company::where("admin_id",Auth::user()->id)->where("is_admin_company",0)->where("type_of_business",$request->company_type)->get();
//                dd($allcompany);
            }
        }
        return view("company.filter",compact("allcompany"));
    }
}
