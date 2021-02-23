@extends('layouts.mainlayout')
@section('content')
    <style>
        #cke_15,#cke_66,#cke_75,#cke_77,#cke_78,#cke_79,#cke_81,#cke_82,#cke_83,#cke_84,#cke_86,#cke_88,#cke_23,#cke_21,#cke_35,#cke_26,#cke_27,#cke_36,#cke_28,#cke_29,#cke_30,#cke_32,#cke_47{
            visibility: hidden;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script src="{{asset("/js/rating.js")}}"></script>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">{{$lead->title}} Edit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("leads")}}">Lead</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Page Header -->
            <!--Main Content -->
            <div class="my-5">
                <form action="{{url("lead/update/$lead->id")}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-md-4 col-xl-4 col-6">
                            <label for="">Lead ID</label>
                            <input type="text" class="form-control" name="lead_id" value="{{$lead->lead_id}}">
                        </div>
                        <div class="form-group col-md-4 col-xl-4 col-6">
                            <label for="">Lead Title</label>
                            <input type="text" class="form-control" name="lead_title" value="{{$lead->title}}">
                        </div>
                        <div class="form-group col-md-4 col-xl-4 col-6">
                            <label for="">Sale Man</label>
                            <select name="sale_man" id="" class="select form-control">
                                @foreach($allemployees as $allemp)
                                    @if($allemp->id==$lead->sale_man_id)
                                        <option value="{{$allemp->id}}" selected>{{$allemp->name}}</option>
                                    @else
                                        <option value="{{$allemp->id}}">{{$allemp->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="hidden" name="compay_id" value="{{$admin_company->id}}">
                        </div>
                        <div class="form-group col-md-4 col-xl-4 col-6">
                            <label for="">Customer Name</label>
                            <select name="customer_id" id="add_customer" class="select col-md-9">
                                @foreach($allcustomers as $allcustomer)
                                    @if($allcustomer->id==$lead->customer_id)
                                    <option value="{{$allcustomer->id}}" selected>{{$allcustomer->customer_name}}</option>
                                    @else
                                    <option value="{{$allcustomer->id}}">{{$allcustomer->customer_name}}</option>
                                    @endif
                                @endforeach
                                <option value="Add">Add Customer</option>
                            </select>
                        </div>
                        {{--                           <a href="{{url("client/customer/create")}}"><i class="fa fa-plus"></i></a>--}}
                        <div class="form-group col-md-4 col-xl-4 col-6" id="tags_reload">
                            <label for="">Tag Industry</label>
                            <select name="tags" id="category" class="select">
                                @foreach($tags as $tag)
                                    @if($tag->id==$lead->tags_id)
                                        <option value="{{$tag->id}}" selected>{{$tag->tag_industry}}</option>
                                    @else
                                        <option value="{{$tag->id}}">{{$tag->tag_industry}}</option>
                                    @endif
                                @endforeach
                                <option value="category">Add</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-xl-4 col-6">
                            <label for="">Priority</label>
                            <div  style="font-size: 2em;">
                                <div id="review"></div>
                            </div>
                            <input type="hidden" name="priority" readonly id="starsInput" class="form-control form-control-sm" value="{{$lead->priority}}">
                            <input type="hidden" name="compay_id" value="{{$admin_company->id}}">
                        </div>
                    </div>
                    <textarea name="description" id="description"  rows="10" style="width:100%;">
                        {{$lead->description}}
                    </textarea>
                    <div class="form-group mt-2">
                          <span data-toggle="collapse" data-target="#next_plan" >
                            <input type="checkbox" name="checked">
                            </span><span for="">Next Plan</span>
                        <div class="sub-menu collapse border mt-3" id="next_plan">
                            <h3 align="center" class="mt-3">Next Plan </h3>
                            <div class="col-12 row mt-3">
                                <div class="form-group col-md-4 offset-md-2">
                                    <label for="">From Date</label>
                                    @if($next_plan!=null)
                                    <input type="date" class="form-control" name="from_date" value="{{\Carbon\Carbon::parse($next_plan->from_date)->format('Y-m-d')}}">
                                    @else
                                        <input type="date" class="form-control" name="from_date">
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">To Date</label>
                                    @if($next_plan!=null)
                                        <input type="date" class="form-control" name="to_date" value="{{\Carbon\Carbon::parse($next_plan->to_date)->format('Y-m-d')}}">
                                    @else
                                        <input type="date" class="form-control" name="to_date">
                                    @endif
                                </div>
                                <div class="form-goup col-md-8 offset-2 mb-3">
                                    <label for="">Description</label>
                                    <textarea name="next_plan_textarea" id="next_plan_textarea"  rows="5" style="width: 100%;">
                                        @if($next_plan!=null)
                                            {{$next_plan->description}}
                                            @endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        @if($lead->is_qualified==1)
                            <div class="float-right">
                                <input type="checkbox" checked id="check" name="qualified" class="custom-checkbox" value="1"><span id="qualified" class="ml-3">Qualified</span>
                            </div><br>
                            <div id="button">
                                <button  class='btn btn-outline-primary float-right mb-3 mt-3' type='submit'>Save</button>
                            </div>
                        @else
                            <div class="float-right">
                                <input type="checkbox" id="check" name="qualified" class="custom-checkbox" value="1"><span id="qualified" class="ml-3">Qualified</span>
                            </div><br>
                            <div id="button">
                                <button  class='btn btn-outline-primary float-right mb-3 mt-3' type='submit'>Save</button>
                            </div>
                            @endif

                    </div>
                </form>
            </div>
        </div>
        <div id="add" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="form-group col-lg-6 col-sm-6 col-12">
                                    <label>Tags</label>
                                    <input type="text" id="tags" class="form-control" name="tags" >
                                </div>
                                <button  id="tags_create" data-dismiss="modal" class="btn btn-primary float-right">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'description' );
            CKEDITOR.replace( 'next_plan_textarea',{
                height:100
            } );
            $(document).ready(function(){ //Make script DOM ready
                $('#category').change(function() { //jQuery Change Function
                    var opval = $(this).val(); //Get value from select element
                    if(opval=="category"){ //Compare it and if true
                        $('#add').modal("show"); //Open Modal
                    }
                });
            });
            $(document).ready(function() {
                $(document).on('click', '#tags_create', function () {
                    var tags=$("#tags").val();
                    $.ajax({
                        type:'POST',
                        data : {tag_industry:tags},
                        url:'/tags/create',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success:function(data){
                            console.log(data);
                            window.location.reload(true);
                        }
                    });
                });
            });

            $("#review").rating({
                "value":$("#starsInput").val(),
                "stars":3,
                "click": function (e) {
                    console.log(e);
                    $("#starsInput").val(e.stars);
                }
            });
            $("#check").on("click", function(){
                if($("#check").is(":checked")){
                    $("button").remove();
                    $("#button").append("<button  class='btn btn-outline-primary float-right mb-3 mt-3' type='submit'>Save and Qualified</button>");
                }else {
                    $("button").remove();
                    $("#button").append("<button  class='btn btn-outline-primary float-right mb-3 mt-3' type='submit'>Save</button>");
                }
            });
            $(document).ready(function(){ //Make script DOM ready
                $('#add_customer').change(function() { //jQuery Change Function
                    var opval = $(this).val(); //Get value from select element
                    var urlmenu = document.getElementById( 'add_customer' );
                    urlmenu.onchange = function() {
                        if(opval=="Add"){
                            window.open( "{{url("/client/customer/create/1")}}" );
                        };
                    }
                });
            });
        </script>
@endsection