@extends('layouts.mainlayout')
@section("title","Lead Create")
@section('content')
    <style>
        #cke_15,#cke_66,#cke_75,#cke_77,#cke_78,#cke_79,#cke_81,#cke_82,#cke_83,#cke_84,#cke_86,#cke_88,#cke_23,#cke_21,#cke_35,#cke_26,#cke_27,#cke_36,#cke_28,#cke_29,#cke_30,#cke_32,#cke_47{
            visibility: hidden;
        }
    </style>

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />--}}
    <script src="{{asset("/js/rating.js")}}"></script>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Leads</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Lead</li>
                            <li class="breadcrumb-item active">Create</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Page Header -->
            <!--Main Content -->
               <div class="my-5">
                   <form action="{{url("lead/create")}}" method="POST">
                       {{csrf_field()}}
                       <div class="row">
                           <div class="form-group col-md-4 col-xl-4 col-6">
                               <label for="">Lead ID</label>
                               <input type="text" class="form-control" name="lead_id" value="{{$lead_id}}">
                           </div>
                           <div class="form-group col-md-4 col-xl-4 col-6">
                               <label for="">Lead Title</label>
                               <input type="text" class="form-control" name="lead_title">
                           </div>
                           <div class="form-group col-md-4 col-xl-4 col-6">
                               <label for="">Sale Man</label>
                               <select name="sale_man" id="saleman" class="select form-control">
                                   @foreach($allemployees as $allemp)
                                       <option value="{{$allemp->id}}">{{$allemp->name}}</option>
                                   @endforeach
                               </select>
                               <input type="hidden" name="compay_id" value="{{$admin_company->id}}">
                           </div>
                           <div class="form-group col-md-4 col-xl-4 col-6">
                               <label for="">Customer Name</label>
                              <div class="col-12">
                                  <div class="row " id="customer">
                                      <select name="customer_id" id="add_customer" class="form-control col-md-10">
                                          <option value="empty">Select Customer Name</option>
                                          @foreach($allcustomers as $allcustomer)
                                              <option value="{{$allcustomer->id}}">{{$allcustomer->customer_name}}</option>
                                          @endforeach
                                      </select>
                                      <div class="col-md-2 col-2 mt-1">
                                          <a  href='#' data-toggle='modal' class="btn btn-outline-dark" data-target='#add_new_ustomer'><i class="fa fa-plus"></i></a>
                                      </div>
                                  </div>
                              </div>
                           </div>
{{--                           <a href="{{url("client/customer/create")}}"><i class="fa fa-plus"></i></a>--}}
                           <div class="form-group col-md-4 col-xl-4 col-6" id="tagdiv" >
                               <label for="category" >Industry</label>
                               <select name="tags" id="industry" class="form-control">
                                   @foreach($tags as $tag)
                                       @if($tag->id==$last_tag->id)
                                           <option value="{{$tag->id}}" selected>{{$tag->tag_industry}}</option>
                                       @else
                                           <option value="{{$tag->id}}">{{$tag->tag_industry}}</option>
                                       @endif
                                   @endforeach
                               </select>
                           </div>
                           <div class="form-group col-md-4 col-xl-4 col-6">
                               <label for="">Priority</label>
                               <div  style="font-size: 2em;">
                                   <div id="review"></div>
                               </div>
                               <input type="hidden" name="priority" readonly id="starsInput" class="form-control form-control-sm">
                               <input type="hidden" name="compay_id" value="{{$admin_company->id}}">
                           </div>
                       </div>
                       <textarea name="description" id="description"  rows="5" style="width:100%;" >
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
                                       <input type="date" class="form-control" name="from_date">
                                   </div>
                                   <div class="form-group col-md-4">
                                       <label for="">To Date</label>
                                       <input type="datetime-local" class="form-control" name="to_date">
                                   </div>
                                   <div class="form-group col-md-8 offset-2 mb-3">
                                       <label for="">Description</label>
                                       <textarea name="next_plan_textarea" id="next_plan_textarea"  rows="5" style="width: 100%;"></textarea>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="float-right">
                           <input type="checkbox" id="check" name="qualified" class="custom-checkbox" value="1"><span id="qualified" class="ml-3">Qualified</span>
                       </div><br>
                       <div id="button">
                           <button  class='btn btn-outline-primary float-right mb-3 mt-3' type='submit'>Save</button>
                       </div>
                   </form>
               </div>
        </div>
        <div id="add" class="modal custom-modal fade" data-backdrop="false" tabindex="-1" role="dialog" style="overflow:hidden">
            <div class="modal-dialog modal-dialog modal-sm">
                <div class="modal-content" style="background-color: #dee0e0">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Industry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                        <label>Tags</label>
                                        <input type="text" id="tags" class="form-control" name="tags" >
                                </div>
                        <button  id="tags_create" data-dismiss="modal" class="btn btn-primary float-right">Save</button>
                            </div>
                    </div>
                </div>
            </div>
        <div class="modal custom-modal rounded"  id="add_new_ustomer">
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
                                    <div class="form-group row col-md-6">
                                        <div class="col-lg-4 col-sm-4 col-12 ">
                                        <label class="col-form-label">Address</label>
                                            </div>
                                        <div class="col-lg-8 col-sm-8 col-12">
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
    </div>
    <!-- /Page Wrapper -->
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'description' );
            CKEDITOR.replace( 'next_plan_textarea',{
                height:100
            } );

            $(document).ready(function() {
                $('#customer_company').select2();
            });
            $(document).ready(function() {
                $('#customer_position').select2();
            });
            $(document).ready(function() {
                $('#industry').select2({
                        "language": {
                            "noResults": function(){
                                return "<a  href='#' data-toggle='modal' data-target='#add'>Add New </a>";
                            }
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }

                    }

                );
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
                            $("#customer").load(location.href + " #customer>* ");
                            $("#add_customer").load(location.href + " #add_customer>* ");

                        }
                    });
                });
            });
            $(document).ready(function() {
                $('#add_customer').select2({
                        "language": {
                            "noResults": function(){
                                return "<i class='text-danger'>This Customer doesn't exist now! Add New !<i>";
                            }
                        },
                        escapeMarkup: function (markup) {
                            return markup;
                        }

                    }

                );
            });

            $(document).ready(function() {
                $(document).change(function (){
                    var indust=$(".select2-search__field").val();
                    $('#tags').val($('.select2-search__field').val());
                })

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
                            $("#tagdiv").load(location.href + " #tagdiv>* ");
                        }
                    });
                });
            });

            $("#review").rating({
                "value": 0,
                "stars": 3,
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
        </script>
@endsection
