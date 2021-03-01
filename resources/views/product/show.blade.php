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
                        <h4 align="center" class=" mt-3">{{$product->name}}</h4>
                        <div class="offset-md-3">
                        <img src="{{url(asset("/product_picture/$product->image"))}}" class="rounded "  height="200px;" alt="">
                        </div>
                        <div class="row mb-5 mt-3 ">
                            <div class="col-md-5 mt-2">Model Number</div>
                            <div class="col-md-7 mt-2">: {{$product->model_no}}</div>
                            <div class="col-md-5 mt-2">Serial Number</div>
                            <div class="col-md-7 mt-2">: {{$product->serial_no}}</div>
                            <div class="col-md-5 mt-2">Available Stock</div>
                            <div class="col-md-7 mt-2">: {{$product->available_stock}}</div>
                        </div>
                    </div>
                    <div class="col-md-7 card">
                        <div class="row my-5">
                            <div class="col-md-4 mt-2">Category</div>
                            <div class="col-md-8 mt-2">: {{$product->category->name}}</div>
                            <span class="col-md-4 mt-2">Tax Type(Rate)</span>
                            <span class="col-md-8 mt-2">: {{$product->taxes->name}}( {{$product->taxes->rate}} % )</span>
                            <div class="col-md-4 mt-2">Sale Price</div>
                            <div class="col-md-8 mt-2">: {{$product->sale_price}} {{$product->currency_unit}}</div>
                            <div class="col-md-4 mt-2">Purchased Price</div>
                            <div class="col-md-8 mt-2">: {{$product->purchase_price}} {{$product->currency_unit}}</div>
                            <div class="col-md-4 mt-2">SKU</div>
                            <div class="col-md-8 mt-2">: {{$product->sku}}</div>
                            <div class="col-md-4 mt-2">Part Number</div>
                            <div class="col-md-8 mt-2">: {{$product->part_no}}</div>
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
                <div class="card row">
                    <div class="card-header">
                        <h4>Product Description</h4>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            {{ $product->description}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection
