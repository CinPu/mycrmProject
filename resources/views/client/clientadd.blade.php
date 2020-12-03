@extends('layouts.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
			
            <!-- Page Content -->
            <div class="content container-fluid">
            
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Clients</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url("home")}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{url("client")}}">Clients</a></li>
                                <li class="breadcrumb-item active">Add Client</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="card col-md-8 offset-md-2">
                    <div class="col-md-12 my-5">
                        <form action="{{url("/client/customer/create")}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div>
                                <div class="text-center" >
                                    <h3>Profile Picture</h3>
                                    <img id="output" class="rounded mt-2 mb-4" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br>
                                    <input type="file" accept="image/*" name="profile"  class="offset-md-1" onchange="loadFile(event)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Customer ID <span class="text-danger">*</span></label>
                                        <input class="form-control" name="customer_id" type="text" value="{{$client_id}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Customer Name</label>
                                        <input class="form-control" name="name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" name="phone" type="number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group input-group">
                                        <label class="col-form-label">Company</label>
                                        <select name="company_id" data-show-content="true" class="select" id="company">
                                            <option selected disabled>Choose Company</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                            <option value="add_company">+ Add New Company </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Position</label>
                                        <select name="position" class="select" id="">
                                            @foreach($position as $post)
                                                <option value="{{$post->id}}">{{$post->emp_position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Department<span class="text-danger">*</span></label>
                                        <input class="form-control floating" name="department" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Report To </label>
                                        <input type="text" class="form-control" name="report_to">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Address</label>
                                        <input class="form-control" name="address" type="text">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="admin_company" value="{{$admin_company->id}}">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
    <div id="add" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                                    <form action="{{url("client/company/create")}}" method="POST" id="clientcreate" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="col-12 mb-3">
                                            <div>
                                                <div class="text-center" >
                                                    <h4>Choose Company Logo</h4>
                                                    <img id="output" class="rounded-circle" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br><br>
                                                    <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company ID : </label>
                                                    <input type="text" class="form-control" name="company_id" value="{{$company_id}}" >
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company Name : </label>
                                                    <input type="text" class="form-control" name="name" >
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company CEO Name</label>
                                                    <input type="text" class="form-control" name="ceo" >
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Company Email">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Parent Company</label>
                                                    <input type="text" class="form-control" name="parent">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Business Type</label>
                                                    <input type="text" class="form-control" name="business_type">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company Phone</label>
                                                    <input type="number" class="form-control" name="phone" placeholder="09xxxxxxxxx">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Hot Line</label>
                                                    <input type="number" class="form-control" name="hotline" placeholder="09xxxxxxxxx">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>Company Website Link</label>
                                                    <input type="url" class="form-control" name="web_link" value="https://">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>Facebook Page Link</label>
                                                    <input type="url" class="form-control" name="facebook_page" value="https://">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>LinkedIn</label>
                                                    <input type="url" class="form-control" name="linked_in" value="https://">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="address" placeholder="Thirih(5)Street,Hlaing Township,Yangon">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-12 col-12 ">
                                                    <label>Company Registry</label><br>
                                                    <textarea rows="3" style="width: 100%" name="company_retistry"></textarea>
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-12 col-12 ">
                                                    <label>Company Vision</label><br>
                                                    <textarea rows="3" style="width: 100%" name="vision"></textarea>
                                                </div>
                                                <div class="form-group col-lg-12 col-sm-12 col-12 ">
                                                    <label>Company Mission</label><br>
                                                    <textarea rows="3" style="width:100%;" name="mission"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit"  class="btn btn-primary rounded">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
<script>
    $(document).ready(function(){ //Make script DOM ready
        $('#company').change(function() { //jQuery Change Function
            var opval = $(this).val(); //Get value from select element
            if(opval=="add_company"){ //Compare it and if true
                $('#add').modal("show"); //Open Modal
            }
        });
    });
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
        <!-- /Page Wrapper -->
@endsection