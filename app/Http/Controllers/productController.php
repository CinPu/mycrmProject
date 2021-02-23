<?php

namespace App\Http\Controllers;

use App\company;
use App\employee;
use App\product;
use App\product_category;
use App\product_tax;
use App\user_employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole("Admin")){
            $company=company::where("admin_id",Auth::user()->id)->first();
            $products=product::with("category","taxes")->where("company_id",$company->id)->get();
        }else{
            $user=user_employee::where("user_id",Auth::user()->id)->first();
            $emp=employee::where("id",$user->emp_id)->first();
            $company=company::where("admin_id",$emp->admin_id)->first();
            $products=product::with("category","taxes")->where("company_id",$company->id)->get();
        }
        return view("product.index",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taxes=product_tax::all();
        $lasttax=product_tax::orderBy('id', 'desc')->first();
        $allcat=product_category::all();
        $lastcat=product_category::orderBy('id', 'desc')->first();
        return view("product.create",compact("taxes","lasttax","allcat","lastcat"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
       $product=new product();
       $product->name=$request->name;
       $product->tax=$request->tax;
       $product->currency_unit=$request->unit;
       $product->description=$request->description;
       $product->sale_price=$request->sale_price;
       $product->purchase_price=$request->purchase_price;
       $product->cat_id=$request->cat_id;
      if(isset($request->enable))
      {
          $product->enable=1;
      }else{
          $product->enable=0;
      }
        $image = $request->picture;
        if($image!=null) {
            $name = $image->getClientOriginalName();
            $request->picture->move(public_path() . '/product_picture/', $name);
            $product->image = $name;
        }
        if(Auth::user()->hasRole("Admin")){
            $company=company::where("admin_id",Auth::user()->id)->first();
            $product->company_id=$company->id;
        }else{
            $user=user_employee::where("user_id",Auth::user()->id)->first();
            $emp=employee::where("id",$user->emp_id)->first();
            $company=company::where("admin_id",$emp->admin_id)->first();
            $product->company_id=$company->id;
        }

        $product->save();
        return redirect("/products")->with("message","Product Create Success");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=product::with("taxes","category")->where("id",$id)->first();
        return view("product.show",compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taxes=product_tax::all();
        $allcat=product_category::all();
        $product=product::with("category","taxes")->where("id",$id)->first();
        return view("product.edit",compact("taxes","product","allcat"));
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
        $product=product::where("id",$id)->first();
        $product->name=$request->name;
        $product->tax=$request->tax;
        $product->description=$request->description;
        $product->sale_price=$request->sale_price;
        $product->purchase_price=$request->purchase_price;
        $product->cat_id=$request->cat_id;
        if(isset($request->enable))
        {
            $product->enable=1;
        }else{
            $product->enable=0;
        }
        $image = $request->picture;
        if($image!=null) {
            $name = $image->getClientOriginalName();
            $request->picture->move(public_path() . '/product_picture/', $name);
            $product->image = $name;
        }
        $product->update();
        return redirect("/products")->with("message","Product Updated Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=product::where("id",$id)->first();
        $product->delete();
        return redirect()->back()->with("delete","Delete $product->name successful");
    }
    public function tax(Request $request){
        $tax=new product_tax();
        $tax->name=$request->name;
        $tax->rate=$request->p_rate;
        $tax->save();
        return response()->json([
            'tax' => "success",
        ]);
    }
    public function category(Request $request){
        $cat=new product_category();
        $cat->name=$request->name;
        $cat->save();
        return response()->json([
            'tax' => "success",
        ]);
    }
    public function duplicate($id){
        $product=product::where("id",$id)->first();
        $duplicate_product=$product->replicate();
        $duplicate_product->save();
        return redirect("/products")->with("message","Product Create Success");
    }
    public function action_confirm(Request $request){
//        dd($request->all());
        if($request->action_Type=="Enable"){
            foreach ($request->product_id as $product){
                if($product!="on") {
                    $action_product = product::where("id", $product)->first();
                    $action_product->enable = 1;
                    $action_product->update();
                }
            }

        }elseif ($request->action_Type="Disable"){
            foreach ($request->product_id as $product){
                if($product!="on") {
                    $action_product = product::where("id", $product)->first();
                    $action_product->enable = 0;
                    $action_product->update();
                }
            }

        }elseif ($request->action_Type=="Delete"){
            foreach ($request->product_id as $product){
                if($product!="on") {
                    $action_product = product::where("id", $product)->first();
                    $action_product->delete();
                }
            }
        }elseif ($request->action_Type="Export"){

        }
    }
}
