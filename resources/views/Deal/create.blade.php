@extends('layouts.mainlayout')
@section('content')
    <style>
        .scoll{
            height: 490px;
            overflow: scroll;
        }
    </style>
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Deal Add</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Deal Add</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="col-12">
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 text-right">Deal Name</label>
                        <input type="text" id="name" name="deal_name" class="col-md-6 form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 col-12 text-right">Amount</label>
                        <input type="text" name="amount" id="amount" class="col-md-4 col-8 form-control">
                        <select name="unit" id="unit" class="col-md-2 col-4">
                            <option value="MMK">MMK</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row" id="org_div">
                        <label for="" class="col-md-3 col-12 text-right">Organization Name</label>
                        <select name="org_name" id="quick_org"  class="col-md-4 col-7 form-control " >
                            @foreach($companies as $com)
                            <option value="{{$com->id}}">{{$com->name}}</option>
                            @endforeach
                        </select>
                        <a data-toggle="modal" href="#orginazation"  class="btn btn-outline-dark col-md-1 col-2"><i class="fa fa-building"></i></a>
                        <a data-toggle="modal" href="#add_company"  class="btn btn-outline-dark col-md-1 col-2"><i class="fa fa-plus"></i></a>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 text-right">Expected Close Date</label>
                        <input type="date" name="deal_name" id="close_date" class="col-md-6 form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 text-right">Pipeline</label>
                        <select name="deal_name" id="pipeline" class="col-md-6 form-control">
                            <option value="Standard">Standard</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 text-right">Sale Stage</label>
                        <select name="deal_name" id="sale_stage" class="col-md-6 form-control">
                            <option value="Ready To CLose">Ready To CLose</option>
                            <option value="New">New</option>
                            <option value="Qualifying">Qualifying</option>
                            <option value="Requirement Gathering">Requirement Gathering</option>
                            <option value="Value Position">Value Position</option>
                            <option value="Negotiation">Negotiation </option>
                            <option value="Closed Won">Closed Won </option>
                            <option value="Closed Lost">Closed Lost </option>
                            <option value="Dormant">Dormant </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 text-right">Assign To</label>
                        <select name="deal_name" id="assign_to" class="col-md-6 form-control">
                            @foreach($allemployees as $emp)
                                <option value="{{$emp->id}}">{{$emp->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 text-right">Lead Source</label>
                        <select name="deal_name" id="lead_source" class="col-md-6 form-control">
                            <option value="Cold Call">Cold Call</option>
                            <option value="Referral">Referral</option>
                            <option value="Word of mouth">Word of mouth</option>
                            <option value="Website">Website</option>
                            <option value="Trade Show">Trade Show</option>
                            <option value="Conference">Conference</option>
                            <option value="Direct Mail">Direct Mail</option>
                            <option value="Public Relation">Public Relation</option>
                            <option value="Partner">Partner</option>
                            <option value="Employee">Employee</option>
                            <option value="Self Generated">Self Generated</option>
                            <option value="Existing Customer">Existing Customer</option>
                            <option value="Facebook">Facebook</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="" class="col-md-3 col-12 text-right">Probability</label>
                        <input type="number" id="propability" name="propability" class="col-md-5 col-10 form-control">
                        <button type="button" class="col-2 col-md-1">%</button>
                    </div>
                </div>
                <div class="text-center">
                <a data-toggle="modal" href="#full_form" id="call_full_form" class="btn btn-primary">Full Form</a>
                <button type="button" class="btn btn-danger" id="quick_save">Save</button>
                </div>
            </div>
            <!-- /Content End -->
            <div class="modal custom-modal rounded" id="full_form">
                <div class="modal-dialog modal-xl " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Deal Full Form</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="container scoll" >
                        <div class="modal-body">
                            <div class="card col-12">
                                <div class="card-header">
                                    Deal Detail
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-2">
                                        <label for="" >Deal Name</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="full_form_name" name="deal_name" class="form-control col-md-10 col-11">
                                    </div>
                                    <div class="col-md-2 col-12 mt-3"><label for="">Amount</label></div>
                                    <div class="col-md-4">
                                        <div class="row col-12">
                                            <input type="number" id="full_form_amount" name="amount" class="form-control col-md-7 col-8">
                                            <select name="unit" id="full_form_unit" class="form-control col-md-4 col-4">
                                                <option value="MMK">MMK</option>
                                                <option value="USD">USD</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row my-3">
                                    <div class="col-md-2 col-12 mt-3">
                                        <label for="" >Organization</label>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="row col-md-12" id="full_org_div">
                                            <select name="org_name" id="full_org"  class="col-md-8" style="width: 60%" >
                                                @foreach($companies as $com)
                                                    <option value="{{$com->id}}">{{$com->name}}</option>
                                                @endforeach
                                            </select>
                                            <a data-toggle="modal" href="#orginazation"  class="btn btn-outline-dark col-md-2 "style="width: 20%"><i class="fa fa-building"></i></a>
                                            <a data-toggle="modal" href="#add_company"  class="btn btn-outline-dark col-md-2" style="width: 20%"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12 mt-3"><label for="">Contact Name</label></div>
                                    <div class="col-md-4 col-12">
                                        <div class="row col-md-11" id="contact_div" >
                                            <select name="contact_name" id="full_contact"   class=" form-control col-md-8" style="width: 60%" >
                                                @foreach($allcustomers as $client)
                                                    <option value="{{$client->id}}">{{$client->customer_name}}</option>
                                                @endforeach
                                            </select>
                                            <a data-toggle="modal" href="#customer"  class="btn btn-outline-dark col-md-2 "style="width: 20%"><i class="fa fa-user"></i></a>
                                            <a data-toggle="modal" href="#add_user"  class="btn btn-outline-dark col-md-2" style="width: 20%"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>

                                </div>
                                <div class="row my-3">
                                    <div class="col-md-2 mt-3">
                                        <label for="" >Expected Close Date</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" id="full_exp_date" name="exp_date" class="form-control col-md-10 col-11">
                                    </div>
                                    <div class="col-md-2 mt-3"><label for="">Pipeline</label></div>
                                    <div class="col-md-4">
                                        <select name="pipeline" id="full_pipeline" class="form-control " style="width: 85%">
                                            <option value="Standard">Standard</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row my-3">
                                    <div class="col-md-2 mt-3">
                                        <label for="" >Sale Stage</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="sale_stage" id="full_sale_stage" class="form-control " style="width: 85%">
                                            <option value="Ready To CLose">Ready To CLose</option>
                                            <option value="New">New</option>
                                            <option value="Qualifying">Qualifying</option>
                                            <option value="Requirement Gathering">Requirement Gathering</option>
                                            <option value="Value Position">Value Position</option>
                                            <option value="Negotiation">Negotiation </option>
                                            <option value="Closed Won">Closed Won </option>
                                            <option value="Closed Lost">Closed Lost </option>
                                            <option value="Dormant">Dormant </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-3"><label for="">Assigned To
                                        </label></div>
                                    <div class="col-md-4">
                                        <select name="assign_to" id="full_assign_to" class="form-control " style="width: 85%">
                                            @foreach($allemployees as $emp)
                                                <option value="{{$emp->id}}">{{$emp->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-2 mt-3">
                                        <label for="" >Lead Source</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="lead_source" id="full_lead_source" class="form-control " style="width: 85%">
                                            <option value="Cold Call">Cold Call</option>
                                            <option value="Referral">Referral</option>
                                            <option value="Word of mouth">Word of mouth</option>
                                            <option value="Website">Website</option>
                                            <option value="Trade Show">Trade Show</option>
                                            <option value="Conference">Conference</option>
                                            <option value="Direct Mail">Direct Mail</option>
                                            <option value="Public Relation">Public Relation</option>
                                            <option value="Partner">Partner</option>
                                            <option value="Employee">Employee</option>
                                            <option value="Self Generated">Self Generated</option>
                                            <option value="Existing Customer">Existing Customer</option>
                                            <option value="Facebook">Facebook</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <label for="">Next Step</label></div>
                                    <div class="col-md-4">
                                        <input type="text"id="next_step" name="next_step" class="form-control col-md-10 col-11">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-2 mt-3">
                                        <label for="" >Type</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="type" id="full_type" class="form-control " style="width: 85%">
                                            <option value="Existing Business">Existing Business</option>
                                            <option value="New Business">New Business</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-12 mt-3">
                                        <label for="">Probability</label></div>
                                    <div class="col-md-4">
                                        <div class="row col-12">
                                            <input type="number" name="probability" id="full_probability" class="form-control col-md-9 col-10">
                                            <button type="button" class="col-md-2 col-2">%</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
{{--                                    <div class="col-md-2 mt-3">--}}
{{--                                        <label for="" >Campaign Source</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-4 col-12">--}}
{{--                                        <div class="row col-md-11" id="camp_div">--}}
{{--                                            <select name="contact_name" id="camp_source"  class=" form-control col-md-8" style="width: 60%" >--}}
{{--                                                @foreach($allcustomers as $client)--}}
{{--                                                    <option value="{{$client->id}}">{{$client->customer_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <a data-toggle="modal" href="#camping"  class="btn btn-outline-dark col-md-2 "style="width: 20%"><i class="fa fa-bullhorn"></i></a>--}}
{{--                                            <a data-toggle="modal" href="#add_camp"  class="btn btn-outline-dark col-md-2" style="width: 20%"><i class="fa fa-plus"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-2 mt-3">
                                        <label for="">Weighted Revenue</label></div>
                                    <div class="col-md-4">
                                        <div class="row col-12">
                                            <input type="number" name="revenue" id="weight_revenue" class="form-control col-md-7 col-8">
                                            <select name="unit" id="revenue_unit" class="form-control col-md-4 col-4">
                                                <option value="MMK">MMK</option>
                                                <option value="USD">USD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <label for="" >Lost Reason</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="deal_name" id="lost_reason" class="form-control " style="width: 85%">
                                            <option value="Price">Price</option>
                                            <option value="Authority">Authority</option>
                                            <option value="Timing">Timing</option>
                                            <option value="Missing Feature">Missing Feature</option>
                                            <option value="Usability"> Usability</option>
                                            <option value="Unknown"> Unknown</option>
                                            <option value="No need">No Need</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Decription Detail
                                </div>
                                <div class="mx-3 my-3">
                                    <textarea name="description" id="description" style="width: 100%" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn">Close</a>
                            <a href="#" id="full_form_save" class="btn btn-primary">Save</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal custom-modal" id="orginazation">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Organization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr><th></th>
                                    <th>ID</th>
                                    <th>Organization Name</th>
                                    <th>Phone</th>
                                    <th>Type Of Business</th>
                                    <th>Website</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $org)
                                    <tr>
                                        <td><input type="checkbox" name="org_id" value="{{$org->id}}"></td>
                                        <td>{{$org->company_id}}</td>
                                        <td>{{$org->name}}</td>
                                        <td>{{$org->phone}}</td>
                                        <td>{{$org->type_of_business}}</td>
                                        <td>{{$org->company_website}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add_org">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal custom-modal rounded" id="add_company">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Organization</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Company ID  </label>
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-12 ">
                                            <input type="text" class="form-control" id="company_id" name="company_id" value="{{$company_id}}" >
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Company Name  </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <input type="text" id="com_name" class="form-control" name="name" >
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Company CEO Name</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <input type="text" id="ceo" class="form-control" name="ceo">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Company Email</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Company Email">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Parent Company</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                        <input type="text" id="p_comp" class="form-control" name="parent">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Business Type</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <input type="text" id="buss_type"  class="form-control" name="business_type">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Company Phone</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <input type="number" id="phone" class="form-control" name="phone" placeholder="09xxxxxxxxx">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Hot Line</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <input type="number" id="hotline" class="form-control" name="hotline" placeholder="09xxxxxxxxx">

                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Company Website Link</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                        <input type="url" id="website" class="form-control" name="web_link" value="https://">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                            <label>Facebook Page Link</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                        <input type="url" id="fb" class="form-control" name="facebook_page" value="https://">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label>LinkedIn</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                        <input type="url" id="linkedin" class="form-control" name="linked_in" value="https://">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label>Address</label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                        <input type="text" id="address" class="form-control" name="address" placeholder="Thirih(5)Street,Hlaing Township,Yangon">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 col-12 ">
                                        <label>Company Registry</label><br>
                                        <textarea rows="3" id="registry" style="width: 100%" name="company_retistry"></textarea>
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12 col-12 ">
                                        <label>Company Vision</label><br>
                                        <textarea rows="3" id="vision" style="width: 100%" name="vision"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 col-sm-12 col-12 ">
                                        <label>Company Mission</label><br>
                                        <textarea rows="3" id="mission" style="width:100%;" name="mission"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn">Close</a>
                            <a href="#" data-dismiss="modal"  id="csd" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal custom-modal" id="customer">
                <div class="modal-dialog modal-xl" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Contacts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table" id="customer">
                                <thead>
                                <tr>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Report To</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @dd($allcustomers)--}}
                                @foreach($allcustomers as $client)
                                    <tr>
                                        <th>{{$client->customer_id}}</th>
                                        <td>{{$client->customer_name}}</td>
                                        <td>{{$client->email}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td><a href="{{url("client/company/profile/".$client->customer_company->id)}}">{{$client->customer_company->name}}</a></td>
                                        <td>{{$client->department}}</td>
                                        <td>{{$client->customer_position->emp_position}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->report_to}}</td>
                                        <td>
                                            <a href="#"class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-th-list ml-2 mt-2" style="font-size: 18px;"></i></a>
                                            <div class="dropdown-menu">
                                                <a href="{{url("/profile/$client->id")}}" class="dropdown-item" ><i class="fa fa-user mr-2"></i>Profile</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#table_delete{{$client->id}}"><i class="fa fa-trash-o mr-2"></i>Delete</a>
                                            </div>
                                            <div id="table_delete{{$client->id}}" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            Are you sure delete <b>{{$client->customer_name}}</b>?
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <a href="#" class=" btn btn-outline-warning offset-4" data-dismiss="modal" aria-label="Close">No</a>
                                                                <a href="{{url("/client/delete/$client->id")}}" class="btn btn-outline-danger text-center">Yes</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add_org">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal custom-modal rounded" id="add_user">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Contact</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="container " >
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Customer ID <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <input class="form-control" name="customer_id" id="customer_id" type="text" value="{{$client_id}}">
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Customer Name</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <input class="form-control" id="customer_name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <input class="form-control" id="customer_phone" name="phone" type="number">
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <input class="form-control floating" id="customer_email" name="email" type="email">
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Company</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <select name="company_id" id="customer_company" class="form-control " style="width: 100%">
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Position</label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <select name="position" id="customer_position" class="form-control" style="width: 100%;">
                                            @foreach($position as $post)
                                                <option value="{{$post->id}}">{{$post->emp_position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Department<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <input class="form-control floating" id="customer_dept" name="department" type="text">
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Report To </label>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12 ">
                                        <input type="text" class="form-control" id="customer_report_to" name="report_to">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Address</label>
                                        <input class="form-control" name="address" id="customer_address" type="text">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="customer_admin_company" name="admin_company" value="{{$admin_company->id}}">
                        </div>
                        <div class="modal-footer">
                            <a href="#" data-dismiss="modal" class="btn">Close</a>
                            <a href="#" id="add_contact" data-dismiss="modal" class="btn btn-primary">Add</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="modal custom-modal rounded" id="add_camp">--}}
{{--                <div class="modal-dialog modal-xl" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h4 class="modal-title">Add Camping</h4>--}}
{{--                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
{{--                        </div>--}}
{{--                        <div class="container" >--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label">Camping Name <span class="text-danger">*</span></label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-12">--}}
{{--                                            <input class="form-control" id="camp_name" name="camp_name" type="text" >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label">Expected Close Date</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-12">--}}
{{--                                            <input class="form-control" id="camp_exp_date" name="exp_date" type="date">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label">Assign To</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-12">--}}
{{--                                                <select name="assign" data-show-content="true" class="form-control" id="camp_assign" style="width: 100%">--}}
{{--                                                    <option selected disabled>Choose Employee</option>--}}
{{--                                                    @foreach($allemployees as $emp)--}}
{{--                                                        <option value="{{$emp->id}}">{{$emp->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label">Product</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-11">--}}
{{--                                            <select name="position" class="form-control" id="camp_product" style="width: 100%">--}}
{{--                                                @foreach($products as $product)--}}
{{--                                                    <option value="{{$product->id}}">{{$product->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label">Camping Type<span class="text-danger">*</span></label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-12">--}}
{{--                                            <select name="camp_type" id="camp_type" class="form-control" style="width: 100%">--}}
{{--                                                <option value="confrence">Confrence</option>--}}
{{--                                                <option value="webinar">Webinar</option>--}}
{{--                                                <option value="trade show">Trade Show</option>--}}
{{--                                                <option value="public relations">Public Relations</option>--}}
{{--                                                <option value="partner">Partner</option>--}}
{{--                                                <option value="referral program">Referral Program</option>--}}
{{--                                                <option value="advertisement">Advertisement</option>--}}
{{--                                                <option value="bannerads">Banner Ads</option>--}}
{{--                                                <option value="direct mail">Direct Mail</option>--}}
{{--                                                <option value="primary email">Primary Email</option>--}}
{{--                                                <option value="telemarketing">Telemarketing</option>--}}
{{--                                                <option value="facebook lead ad">Facebook Lead Ad</option>--}}
{{--                                                <option value="others">Others</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label">Camping Status<span class="text-danger">*</span></label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-12">--}}
{{--                                            <select name="camp_type" id="camp_status" class="form-control" style="width: 100%">--}}
{{--                                                <option value="Planning">Planning</option>--}}
{{--                                                <option value="Draft">Draft</option>--}}
{{--                                                <option value="Inprogress">Inprogress</option>--}}
{{--                                                <option value="Queued">Queued</option>--}}
{{--                                                <option value="Send">Send</option>--}}
{{--                                                <option value="Completed"> Completed</option>--}}
{{--                                                <option value="Canceled">Canceled</option>--}}
{{--                                                <option value="Failed">Failed</option>--}}
{{--                                                <option value="Active"> Active</option>--}}
{{--                                                <option value="Inactive">Inactive</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row col-md-6">--}}
{{--                                        <div class="col-lg-4 col-sm-4 col-12 ">--}}
{{--                                            <label class="col-form-label"> Expected Response<span class="text-danger">*</span></label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-8 col-sm-8 col-12">--}}
{{--                                            <select name="camp_type" id="camp_exp_response" class="form-control" style="width: 100%">--}}
{{--                                                <option value="Excellent">Excellent</option>--}}
{{--                                                <option value="Good">Good</option>--}}
{{--                                                <option value="Average">Average</option>--}}
{{--                                                <option value="Poor">Poor</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <input type="hidden" name="admin_company" id="admin_company" value="{{$admin_company->id}}">
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <a href="#" data-dismiss="modal" class="btn">Close</a>--}}
{{--                                <a href="#" id="camp_addbtn" class="btn btn-primary">Add</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="modal custom-modal rounded" id="add_product">--}}
{{--                <div class="modal-dialog modal-xl" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h4 class="modal-title">Add Camping</h4>--}}
{{--                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
{{--                        </div>--}}
{{--                        <div class="container" >--}}
{{--                            <div class="modal-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="form-group col-md-4 col-6 offset-md-2">--}}
{{--                                        <label for="">Name</label>--}}
{{--                                        <input type="text" class="form-control" name="name" required>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-4 col-6 " id="tax_div">--}}
{{--                                        <label for="">Tax</label>--}}
{{--                                        <select name="tax" id="product_tax" class="form-control">--}}
{{--                                            <option value="empty">Select Industry</option>--}}
{{--                                            @foreach($taxes as $tax)--}}
{{--                                                @if($tax->id == $lasttax->id)--}}
{{--                                                    <option value="{{$tax->id}}" selected >{{$tax->name}}({{$tax->rate}}%)</option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{$tax->id}}">{{$tax->name}}({{$tax->rate}}%)</option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                            <option value="tax">Add New</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-8 col-12 offset-md-2">--}}
{{--                                        <label for="">Description</label>--}}
{{--                                        <textarea name="description" cols="50" style="width: 100%;height: 100px;" ></textarea>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-3 col-6 offset-md-2">--}}
{{--                                        <label for="">Sale Price</label>--}}
{{--                                        <input type="number" class="form-control" name="sale_price" required>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-3 col-6">--}}
{{--                                        <label for="">Purchase Price</label>--}}
{{--                                        <input type="number" class="form-control" name="purchase_price">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-2">--}}
{{--                                        <label for="">Unit</label>--}}
{{--                                        <select name="unit" id="" class="select">--}}
{{--                                            <option value="MMK">MMK</option>--}}
{{--                                            <option value="USD">USD</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-3 col-6 offset-md-2" id="cat_div">--}}
{{--                                        <label for="">Category</label>--}}
{{--                                        <select name="cat_id" id="product_cat" class="form-control">--}}
{{--                                            <option value="empty">Select Category</option>--}}
{{--                                            @foreach($allcat as $cat)--}}
{{--                                                @if($cat->id==$lastcat->id)--}}
{{--                                                    <option value="{{$cat->id}}" selected>{{$cat->name}}</option>--}}
{{--                                                @else--}}
{{--                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                            <option value="cat">Add New Category</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-3 col-6">--}}
{{--                                        <label for="">Picture</label>--}}
{{--                                        <input type="file" accept="image/*" name="picture"  class=" offset-md-1" onchange="loadFile(event)">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-md-2">--}}
{{--                                        <img id="output" class="rounded mt-3" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group offset-md-2 ">--}}
{{--                                        <input type="checkbox" name="enable" class="ml-3">--}}
{{--                                        <label for="">Enable</label>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div class="text-center">--}}
{{--                                    <button type="submit" class="btn btn-primary col-md-2 col-2 ">Save</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <a href="#" data-dismiss="modal" class="btn">Close</a>--}}
{{--                                <a href="#" class="btn btn-primary">Add</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );

        $(document).ready(function() {
                $('select').select2({
                        "language": {
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }
                    }

                );

            });
        $(document).ready(function() {
                $('#quick_org').select2({
                        "language": {
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }
                    }

                );

            });
        $(document).ready(function() {
                $('#full_org').select2({
                        "language": {
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }
                    }

                );

            });

        $(document).ready(function() {
            $(document).on('click', '#quick_save', function () {
                var name=$("#name").val();
                var amount=$("#amount").val();
                var exp_close_date=$("#close_date").val();
                var pipeline=$("#pipeline").val();
                var sale_stage=$("#sale_stage").val();
                var assign_to=$("#assign_to").val();
                var lead_source=$("#lead_source").val();
                var propability=$("#propability").val();
                var org_name=$("#quick_org option:selected").val();
                var currency=$("#unit").val();
                var admin_company=$("#admin_company").val();
                $.ajax({
                    type:'POST',
                    data : {
                        currency:currency,
                        name:name,
                        amount:amount,
                        close_date:exp_close_date,
                        pipeline:pipeline,
                        sale_stage:sale_stage,
                        assign_to:assign_to,
                        lead_source:lead_source,
                        propability:propability,
                        org_name:org_name,
                        admin_company:admin_company
                    },
                    url:'/deal/add/quick',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        window.location.href = "/deal";
                        console.log(data);
                        // $("#tagdiv").load(location.href + " #tagdiv>* ");
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '#csd', function () {
                var comp_id=$("#company_id").val();
                var company_name=$("#com_name").val();
                var hotline=$("#hotline").val();
                var address=$("#address").val();
                var business_type=$("#buss_type").val();
                var parent_company=$("#p_comp").val();
                var company_ceo=$("#ceo").val();
                var web_link=$("#website").val();
                var linkedin=$("#linkedin").val();
                var fb_link=$("#fb").val();
                var phone=$("#phone").val();
                var email=$("#email").val();
                var registry=$("#registry").val();
                var vision=$("#vision").val();
                var mission=$("#mission").val();
                $.ajax({
                    data : {
                        company_id:comp_id,
                        name:company_name,
                        ceo:company_ceo,
                        hotline:hotline,
                        email:email,
                        phone:phone,
                        facebook_page:fb_link,
                        linked_in:linkedin,
                        web_link:web_link,
                        address:address,
                        business_type:business_type,
                        parent:parent_company,
                        company_retistry:registry,
                        mission:mission,
                        vision:vision,
                    },
                    type:'POST',
                    url:"{{url("client/company/create/ajax")}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        console.log(data);
                        $("#org_div").load(location.href + " #org_div>* ");
                        $("#full_org_div").load(location.href + " #full_org_div>* ");
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '#full_form_save', function () {

                var name=$("#full_form_name").val();
                var amount=$("#full_form_amount").val();
                var unit=$("#full_form_unit option:selected").val();
                var org=$("#full_org option:selected").val();
                var contact=$("#full_contact option:selected").val();
                var exp_date=$("#full_exp_date").val();
                var pipeline=$("#full_pipeline option:selected").val();
                var sale_stage=$("#full_sale_stage option:selected").val();
                var asign_to=$("#full_assign_to option:selected").val();
                var lead_source=$("#full_lead_source option:selected ").val();
                var next_step=$("#next_step").val();
                var type=$("#full_type option:selected").val();
                var probability=$("#full_probability").val();
                // var camping_source=$("#camp_source option:selected").val();
                var weight_revenue=$("#weight_revenue ").val();
                var revenue_unit=$("#revenue_unit option:selected").val();
                var lost_reason=$("#lost_reason option:selected").val();
                var description=CKEDITOR.instances["description"].getData();
                var admin_company=$("#admin_company").val();
                $.ajax({
                    data : {
                        name:name,
                        amount:amount,
                        unit:unit,
                        full_org:org,
                        contact:contact,
                        exp_date:exp_date,
                        pipeline:pipeline,
                        sale_stage:sale_stage,
                        asign_to:asign_to,
                        lead_source:lead_source,
                        next_step:next_step,
                        type:type,
                        probability:probability,
                        // camping_source:camping_source,
                        weight_revenue:weight_revenue,
                        revenue_unit:revenue_unit,
                        lost_reason:lost_reason,
                        description:description,
                        admin_company:admin_company
                    },
                    type:'POST',
                    url:"{{url("/deal/add/full")}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        window.location.href = "/deal";
                        console.log(data);
                        // $("#org_div").load(location.href + " #org_div>* ");
                        // $("#full_org_div").load(location.href + " #full_org_div>* ");
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '#add_contact', function () {

                var customer_id=$("#customer_id").val();
                var customer_name =$("#customer_name ").val();
                var customer_phone=$("#customer_phone").val();
                var customer_email=$("#customer_email").val();
                var customer_company=$("#customer_company").val();
                var customer_dept=$("#customer_dept").val();
                var customer_position=$("#customer_position option:selected").val();
                var customer_report_to=$("#customer_report_to").val();
                var customer_address=$("#customer_address").val();
                var customer_admin_company=$("#customer_admin_company").val();
                var type="ajax";
                $.ajax({
                    data : {
                        customer_id:customer_id,
                        name:customer_name,
                        phone:customer_phone,
                        email:customer_email,
                        company_id:customer_company,
                        department:customer_dept,
                        position:customer_position,
                        report_to:customer_report_to,
                        address:customer_address,
                        admin_company:customer_admin_company,
                        type:type
                    },
                    type:'POST',
                    url:"{{url("client/customer/create/")}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        console.log(data);
                        $("#contact_div").load(location.href + " #contact_div>* ");

                    }
                });
            });
        });
        // $(document).ready(function() {
        //     $(document).on('click', '#camp_addbtn', function () {
        //
        //         var camp_name=$("#camp_name").val();
        //         var camp_exp_date =$("#camp_exp_date ").val();
        //         var camp_product=$("#camp_product option:selected").val();
        //         var camp_type=$("#camp_type option:selected").val();
        //         var camp_status=$("#camp_status option:selected").val();
        //         var camp_exp_response=$("#camp_exp_response option:selected").val();
        //         var camp_assign=$("#camp_assign option:selected").val();
        //         var admin_company=$("#admin_company").val();
        //         $.ajax({
        //             type:'POST',
        //             data : {
        //                 name:camp_name,
        //                 exp_date:camp_exp_date,
        //                 type:camp_type,
        //                 product:camp_product,
        //                 status:camp_status,
        //                 exp_respon:camp_exp_response,
        //                 assign_to:camp_assign,
        //                 admin_company:admin_company
        //             },
        //             url:'/camping/add',
        //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //             success:function(data){
        //                 console.log(data);
        //                 // $("#camp_div").load(location.href + " #camp_div>* ");
        //             }
        //         });
        //     });
        // });
        $(document).on({
            'show.bs.modal': function () {
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            },
            'hidden.bs.modal': function() {
                if ($('.modal:visible').length > 0) {
                    setTimeout(function() {
                        $(document.body).addClass('modal-open');
                    }, 0);
                }
            }

        }, '.modal');


    </script>
@endsection
