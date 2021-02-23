@extends("layouts.mainlayout")
@section("content")
    <style>
        input[type="file"] {
            display: block;
        }
        .imageThumb {
            max-height: 90px;
            max-width: 150px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 10px 0;
        }
        .remove {
            display: block;
            background: #edeff2;
            border: 1px solid black;
            color: black;
            text-align: center;
            cursor: pointer;
        }
        .remove:hover {
            background: white;
            color: black;
        }
        #cke_11,#cke_19,#cke_21,#cke_26,#cke_27,#cke_28,#cke_29,#cke_30,#cke_32,#cke_47{
            visibility: hidden;
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
                        <h3 class="page-title">Product</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class=" col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-5 card">
                        <div class="offset-md-3 mt-3">
                        <img src="{{url(asset("/product_picture/$product->image"))}}" class="rounded "  height="200px;" alt="">
                        </div>
                        <div class="row mb-5 mt-3 ">
                            <div class="col-md-5 mt-2">Product Name</div>
                            <div class="col-md-7 mt-2">: {{$product->name}}</div>
                            <div class="col-md-5 mt-2">Sale Price</div>
                            <div class="col-md-7 mt-2">: {{$product->sale_price}}</div>
                            <div class="col-md-5 mt-2">Purchase Price</div>
                            <div class="col-md-7 mt-2">: {{$product->purchase_price}}</div>
                        </div>
                    </div>
                    <div class="col-md-7 card">
                      <div class="my-3">
                          <h4>Product Description</h4>
                        <textarea rows="7" style="width: 100%">{{ $product->description}}</textarea>
                      </div>
                        <div class="row">
                            <div class="col-md-4 mt-2">Category</div>
                            <div class="col-md-8 mt-2">: {{$product->category->name}}</div>
                            <span class="col-md-4 mt-2">Tax Type(Rate)</span>
                            <span class="col-md-8 mt-2">: {{$product->taxes->name}}( {{$product->taxes->rate}} % )</span>
                            <span class="col-md-4 mt-2">Status</span>
                            <span class="col-md-8 mt-2">@if($product->enable==1)
                                      : Enable
                                @else
                                    : Disable
                            @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection