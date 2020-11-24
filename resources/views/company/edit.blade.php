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
                        <h3 class="page-title">Company Edit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Company</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <form action="{{url("/company/update/$company->id")}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-12 mb-3">
                    <div>
                        <div class="text-center" >
                            <h4>Choose Company Logo</h4>
                            <img src="{{url(asset("/companylogo/$company->logo"))}}" id="output" class="rounded-circle" width="100px" height="100px;"><br><br>
                            <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mt-5">
                            <span for="" class="col-6 col-md-4">Company Name : </span>
                            <input type="text" class="form-control col-md-6 col-6" name="name" value="{{$company->name}}">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <span class="col-6 col-md-4">Company Name Short Form</span>
                            <input type="text" class="form-control col-6 col-md-6" name="short_form" value="{{$company->company_shortname}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <span class="col-6 col-md-4">Company Email</span>
                            <input type="email" class="form-control col-6 col-md-6" name="email" placeholder="Company Email" value="{{$company->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <span class="col-6 col-md-4">Company Address</span>
                            <input type="text" class="form-control col-6 col-md-6" name="address" placeholder="Thiri(5)Street,Hlaing,Yangon" value="{{$company->company_address}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <span class="col-6 col-md-4">Company Phone</span>
                            <input type="number" class="form-control col-6 col-md-6" name="phone" placeholder="09xxxxxxxxx" value="{{$company->phone}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <span class="col-6 col-md-4">Hot Line</span>
                            <input type="number" class="form-control col-6 col-md-6" name="hotline" placeholder="09xxxxxxxxx" value="{{$company->hotline}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <span class="col-6 col-md-4">Company Website Link</span>
                            <input type="text" class="form-control col-6 col-md-6" name="web_link" placeholder="www.cloudark.biz" value="{{$company->company_website}}">
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit"  class="btn btn-primary rounded">Submit</button>
                    </div>
                </div>
            </form>
            <!-- /Content End -->

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection