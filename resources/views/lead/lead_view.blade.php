@extends('layouts.mainlayout')
@section('content')
    <style>
        .scroll {
            /*width: 300px;*/
            height: 300px;
            overflow: scroll;
        }
        .next_plan_content{
            height: 400px;
            overflow: scroll;
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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{$lead->title}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("leads")}}">Lead</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{url("/lead/edit/$lead->id")}}" class="btn add-btn"><i class="fa fa-edit"></i> Edit Lead</a>
                       @if($lead->is_qualified==1)
                            <a href="{{url("deal/add")}}" class="btn add-btn mr-2"><i class="fa fa-check"></i>Qualified</a>
                           @else
                        <a href="{{url("/lead/qualified/$lead->id")}}" class="btn add-btn mr-2"><i class="fa fa-square"></i>Unqualified</a>
                    @endif
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Lead Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Next Plan</a>
                </li>
            </ul>
            <div class="row">
                <div class="tab-content col-lg-8 col-xl-8" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card scroll">
                            <div class="card-body">
                                <div class="project-title">
                                    <h4 class="card-title">{{$lead->title}}</h4>
                                </div>
                                {!!$lead->description!!}
                            </div>
                        </div>
                        <div class="card ">
                            <div class="card-body scroll">
                                <h5 class="card-title m-b-20">Comments</h5>
                                <ul class="files-list">
                                    @foreach($comments as $comment)
                                        <li>
                                            <div class="files-cont ">
                                                <a href="{{url("lead/comment/delete/$comment->id")}}"><i class="fa fa-close float-right "></i></a>
                                                <div class="file-type">
                                                    @if($comment->user->hasAnyRole("Admin"))
                                                        <img src="{{asset("/profile/".$comment->user->profile)}}" alt="user_profile"
                                                             width="40px;" height="40px;" class="rounded-circle mr-2">
                                                    @else
                                                        @php
                                                            $pp=\App\user_employee::with("employee")->where("user_id",$comment->user_id)->first();
                                                        @endphp
                                                        <img src="{{asset("/profile/".$pp->employee->emp_profile)}}"
                                                             alt="user_profile" width="40px;" height="40px;"
                                                    tus         class="rounded-circle mr-2">
                                                    @endif

                                                </div>
                                                <div class="files-info">
                                                    <span>{{$comment->user->name}}</span>
                                                    <span class="file-name text-ellipsis">{{$comment->comment}}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <form method="POST" action="{{url("/lead/post/comment")}}" class="mt-2">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="form-group col-xl-9 col-md-9 col-9 ml-5">
                                        <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                        <input type="text" class="form-control" name="comment">
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" type="submit" style="font-size: 20px;"><i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card next_plan_content">
                            <div class="card-body">
                                <div class="project-title">
                                    <h4 class="card-title">Description</h4>
                                </div>
                                @if($next_plan!=null)
                                {!!$next_plan->description!!}
                                @else
                                    This lead does not have next plan.
                                @endif
                            </div>
                            @if($next_plan!=null)
                            <div class="card-footer">
                            Duration Date : <strong>  {{\Carbon\Carbon::parse($next_plan->from_date)->format('d-m-Y')}}</strong>  To  <strong>{{\Carbon\Carbon::parse($next_plan->to_date)->format('d-m-Y')}}</strong>
                               @if($next_plan->work_done!=1)
                                    @if(\Carbon\Carbon::now()>$next_plan->to_date)
                                        <button class="btn btn-primary float-right">Overdue Date</button>
                                    @else
                                        <a href="{{url("work/done/$lead->id")}}" class="btn btn-primary float-right">Done</a>
                                    @endif
                                @else
                                    <button class="btn btn-primary float-right">Complete Next Plan</button>
                                @endif
                            </div>
                                @endif

                   </div>
                    </div>

                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title m-b-15">Lead details</h6>
                            <table class="table table-striped table-border">
                                <tbody>
                                <tr>
                                    <td>Lead ID:</td>
                                    <td class="text-right">{{$lead->lead_id}}</td>
                                </tr>
                                <tr>
                                    <td>Sale Person:</td>
                                    <td class="text-right">{{$lead->saleMan->name}}</td>
                                </tr>
                                <tr>
                                    <td>Customer:</td>
                                    <td class="text-right">{{$lead->customer->customer_name}}</td>
                                </tr>

                                <tr>
                                    <td>Email:</td>
                                    <td class="text-right">{{$lead->customer->email}}</td>
                                </tr>
                                <tr>
                                    <td>Contact Phone:</td>
                                    <td class="text-right">{{$lead->customer->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Priority:</td>
                                    <td class="text-right">
                                        <div id="review"></div>
                                        <input type="hidden" id="prioriyt" value="{{$lead->priority}}">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Status:</td>
                                    <td class="text-right">
                                        @if($lead->is_qualified==1)
                                        Qualified
                                        @else
                                            Unqualified
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
{{--                            <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>--}}
{{--                            <div class="progress progress-xs mb-0">--}}
{{--                                <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="card project-user">
                        <div class="card-body">
                            <h6 class="card-title m-b-20">
                                Follower
                                <button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#assign_user"><i class="fa fa-plus"></i> Add</button>
                            </h6>
                            <ul class="list-box">
                                @foreach($followers as $follower)
                                <li>
                                    @php
                                    $emp=\App\user_employee::where("user_id",$follower->user->id)->first();
                                    @endphp
                                    <a href="{{url("/emp/profile/$emp->emp_id")}}">
                                        <div class="list-item">
                                            <div class="list-left">
                                                @if($follower->user->hasAnyRole("Admin"))
                                                    @if($follower->user->profile==null)
                                                        <span class="avatar"><img alt="" src="img/profiles/avatar-01.jpg"></span>
                                                    @else
                                                    <img src="{{asset("/profile/".$follower->user->profile)}}" alt="user_profile"
                                                         width="40px;" height="40px;" class="rounded-circle mr-2">
                                                    @endif
                                                @else
                                                    @php
                                                        $pp=\App\user_employee::with("employee")->where("user_id",$follower->follower_id)->first();
                                                    @endphp
                                                        @if($pp->employee->emp_profile==null)
                                                        <span class="avatar"><img alt="" src="img/profiles/avatar-01.jpg"></span>
                                                    @else
                                                    <img src="{{asset("/profile/".$pp->employee->emp_profile)}}" alt="user_profile" width="40px;" height="40px;" class="rounded-circle mr-2">
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="list-body mt-2">
                                                <span class="message-author">{{$follower->user->name}}</span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        <div id="assign_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Follower</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <form action="{{url("/lead/follower/add/$lead->id")}}" id="follower" method="POST">
                            {{csrf_field()}}
                            <div class="modal-body">
                                    <div class="row">
                                        <select class="mul-select" name="follower[]" multiple="true" style="width: 100%">
                                            @foreach($allemps as $emp)
                                                <option value="{{$emp->user_id}}">{{$emp->employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!-- /Assign User Modal -->


    </div>
    <script>
        $("#review").rating({
            "value":$("#prioriyt").val(),
            "stars":3,
            "click": function (e) {
                console.log(e);
                $("#starsInput").val(e.stars);
            }
        });
        $(document).ready(function () {
            $(".mul-select").select2({
                placeholder: "Select Employee", //placeholder
                tags: true,
                tokenSeparators: ['/', ',', ';', " "]
            });
        });
    </script>
    <!-- /Page Wrapper -->
@endsection
