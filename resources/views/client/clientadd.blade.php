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
                                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Phone <span class="text-danger">*</span></label>
                                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" min="0" oninput="validity.valid||(value='');" type="number">
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control floating @error('email') is-invalid @enderror" name="email" type="email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 col-sm-12">
                                        <div class="row">
                                            <div class="form-group input-group">
                                            <div class="col-md-10 col-10 col-sm-10" id="company_div">
                                                <label class="col-form-label">Company</label>
                                            <select name="company_id" data-show-content="true" class="form-control" id="company">
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                            </div>
                                            <div class="col-md-2 col-2 mt-4">
                                                <a data-toggle="modal" href="#add"  class="btn btn-outline-dark  mt-3"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Position</label>
                                        <select name="position" class="form-control" id="customer_position">
                                            @foreach($position as $post)
                                                <option value="{{$post->id}}">{{$post->emp_position}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Department<span class="text-danger">*</span></label>
                                        <input class="form-control floating @error('department') is-invalid @enderror" name="department" type="text">
                                        @if ($errors->has('department'))
                                            <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('department') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Report To </label>
                                        <input type="text" class="form-control @error('report_to') is-invalid @enderror" name="report_to">
                                        @if ($errors->has('report_to'))
                                            <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('report_to') }}</strong>
                                        </span>
                                        @endif
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
                    <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company ID : </label>
                                                    <input type="text" class="form-control" id="company_id" name="company_id" value="{{$company_id}}" >
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company Name : </label>
                                                    <input type="text" id="com_name" class="form-control" name="name" >
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company CEO Name</label>
                                                    <input type="text" id="ceo" class="form-control" name="ceo" >
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Company Email">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Parent Company</label>
                                                    <input type="text" id="parent" class="form-control" name="parent">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Business Type</label>
                                                    <input type="text" id="business_type" class="form-control" name="business_type">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Company Phone</label>
                                                    <input type="number" id="phone" class="form-control" name="phone" placeholder="09xxxxxxxxx">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                                    <label>Hot Line</label>
                                                    <input type="number" id="hotline" class="form-control" name="hotline" placeholder="09xxxxxxxxx">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>Company Website Link</label>
                                                    <input type="url" id="website" class="form-control" name="web_link" value="https://">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>Facebook Page Link</label>
                                                    <input type="url" id="fb_page" class="form-control" name="facebook_page" value="https://">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>LinkedIn</label>
                                                    <input type="url" id="linked_in" class="form-control" name="linked_in" value="https://">
                                                </div>
                                                <div class="form-group col-lg-6 col-sm-6 col-12 ">
                                                    <label>Address</label>
                                                    <input type="text" id="address" class="form-control" name="address" placeholder="Thirih(5)Street,Hlaing Township,Yangon">
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
                                            <div class="form-group text-center">
                                                <button type="submit" id="company_add" data-dismiss="modal"  class="btn btn-primary rounded">Submit</button>
                                            </div>
                                        </div>
                </div>
            </div>
        </div>
    </div>
        </div>
<script>
    $(document).ready(function() {
        $('#company').select2({
                "language": {
                "language": {
                },
                escapeMarkup: function (markup) {
                    return markup;
                }
            }

        );
        $('#customer_position').select2({
                "language": {
                },
                escapeMarkup: function (markup) {
                    return markup;
                }
            }

        );

    });
    $(document).ready(function() {
        $(document).on('click', '#company_add', function () {
            var comp_id=$("#company_id").val();
            var company_name=$("#com_name").val();
            var hotline=$("#hotline").val();
            var address=$("#address").val();
            var business_type=$("#business_type").val();
            var parent_company=$("#parent").val();
            var company_ceo=$("#ceo").val();
            var web_link=$("#website").val();
            var linkedin=$("#linked_in").val();
            var fb_link=$("#fb_page").val();
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
                    $("#company_div").load(location.href + " #company_div>* ");
                }
            });
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
