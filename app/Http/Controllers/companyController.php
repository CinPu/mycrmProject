<?php

namespace App\Http\Controllers;

use App\company;
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
}
