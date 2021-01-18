@extends('layouts.mainlayout')
@section('content')
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
                               <select name="sale_man" id="" class="select form-control">
                                   @foreach($allemployees as $allemp)
                                       <option value="{{$allemp->id}}">{{$allemp->name}}</option>
                                   @endforeach
                               </select>
                               <input type="hidden" name="compay_id" value="{{$admin_company->id}}">
                           </div>
                           <div class="form-group col-md-4 col-xl-4 col-6">
                               <label for="">Customer Name</label>
                               <select name="customer_id" id="add_customer" class="select col-md-9">
                                   <option value="empty">Select Customer Name</option>
                                   @foreach($allcustomers as $allcustomer)
                                       <option value="{{$allcustomer->id}}">{{$allcustomer->customer_name}}</option>
                                   @endforeach
                                       <option value="Add">Add Customer</option>
                               </select>
                           </div>
{{--                           <a href="{{url("client/customer/create")}}"><i class="fa fa-plus"></i></a>--}}
                           <div class="form-group col-md-4 col-xl-4 col-6" id="tags_reload">
                               <label for="">Tag Industry</label>
                               <select name="tags" id="category" class="select">
                                   <option value="empty">Select Industry</option>
                                   @foreach($tags as $tag)
                                       @if($tag->id==$last_tag->id)
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
                               <input type="hidden" name="priority" readonly id="starsInput" class="form-control form-control-sm">
                               <input type="hidden" name="compay_id" value="{{$admin_company->id}}">
                           </div>
                       </div>
                       <textarea name="description" id=""  rows="10" style="width:100%;">
                    </textarea>
                       <div class="form-group">
                           <input type="checkbox" id="check" name="qualified" class="custom-checkbox" value="1"> Qualified
                       </div>
                       <div id="button">
                           <button  class='btn btn-outline-primary float-right mb-3' type='submit'>Save</button>
                       </div>
                       <div id="hh"></div>
                   </form>
               </div>
        </div>
        <div id="add" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
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
        </div>
    <!-- /Page Wrapper -->
        <script>
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
                "value": 0,
                "color":"blue",
                "click": function (e) {
                    console.log(e);
                    $("#starsInput").val(e.stars);
                }
            });
            $("#check").on("click", function(){
                if($("#check").is(":checked")){
                    $("button").remove();
                   $("#button").append("<button  class='btn btn-outline-primary float-right mb-3' type='submit'>Save and Qualified</button>");
                }else {
                    $("button").remove();
                    $("#button").append("<button  class='btn btn-outline-primary float-right mb-3' type='submit'>Save</button>");
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