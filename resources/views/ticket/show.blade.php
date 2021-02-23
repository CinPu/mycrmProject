@extends("layouts.mainlayout")
@section("title","Ticket Detail")
@section("content")
    <style>
        #map {
            width: 100%;
            height: 480px;
        }

        .scroll {
            /*width: 300px;*/
            height: 400px;
            overflow: scroll;
        }

        .photo_div {
            /*width: 300px;*/
            height: 370px;
            overflow: scroll;
        }

        .desc {
            height: 300px;
            overflow: scroll;
        }

        #comment {
            height: 700px;
        }

        .photos {
            max-width: 220px;
            max-height: 500px;
        }

        /*#label{*/
        /*    padding-left: 50px;*/
        /*}*/
        .mul-select {
            width: 250px;
        }
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcNrvPMoDFFCgVzzCP3Oeu1iIwBtJ72ZM"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous"></script>
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Ticket Detail</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("ticket/dashboard")}}">Ticket</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                @if(Auth::user()->hasAnyRole("TicketAdmin"))
                    @if($ticket_info->isassign==1)
                        <div class="col-md-12 mt-3">
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#reassign" data-whatever="@getbootstrap">Reassign
                            </button>
                        </div>
                    @endif
                @else
                    @if($ticket_info->user_id!=\Illuminate\Support\Facades\Auth::user()->uuid)
                        @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin"))
                            <div>
                                <button type="button" class="btn btn-primary float-right mt-3 mr-3" data-toggle="modal"
                                        data-target="#reassign" data-whatever="@getbootstrap">Reassign
                                </button>
                                <a href="{{url("/countdown/$ticket_info->ticket_id")}}" class="btn btn-primary float-right mt-3 mr-3">Accept</a>
                            </div>
                        @endif
                        <span id="end" ></span>
                    @endif
                @endif
                <div class="text-center">
                <b id="days"></b>  <b id="hours"></b>
                 <b id="mins"></b>
                 <b id="secs"></b>
                </div>
                {{--            @endif--}}
                <span id="clock-placeholder"></span>

                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("TicketAdmin"))
                    <div class="modal fade" id="reassign" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reassign Ticket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/reassigned') }}" method="POST" class="form">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="ticket_id" value="{{ $ticket_info->id }}">
                                        <div class="form-group">
                                            <label for="">Select Assign Type</label>
                                            <select class="custom-select" id="type" name="assignType">
                                                <option value="item0">Choose Assign Type</option>
                                                <option value="dept">Assign To Department</option>
                                                <option value="agent">Assign To Agent</option>
                                            </select>
                                            <label for="" class="mt-3">Assign</label>
                                            <select class="custom-select" name="assign_id" id="size">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Reassigned</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                    <h4>Ticket Information </h4><span class="ticketid float-right"> Ticket ID : <b
                                class="text-warning">{{$ticket_info->ticket_id}}</b>
            </span><br>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label class="col-md-6 col-5">Ticket Title </label>
                            <span class="col-md-6 col-7">: {{$ticket_info->title}}</span>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="col-md-6 col-5">Case Type </label>
                            <span class="col-md-6 col-7">: {{$ticket_info->cases->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-12">
                            <label class="col-md-6 col-5">Status </label>   <!-- Button trigger modal -->
                            <span class="col-md-6 col-7">
                        : {{$ticket_info->status_type->status}}
                                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("TicketAdmin"))
                                    <a href=""  data-toggle="modal" data-target="#{{$ticket_info->status_type->status}}"><i class="fa fa-pencil-square-o"></i></a>
                                @endif

                    </span>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="col-md-6 col-5">Status Updated </label><span class="col-md-6 col-7"> : {{$ticket_info->updated_at->diffForHumans()}}
                    </span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 col-12">
                            <label class="col-md-6 col-5"> Priority </label>
                            <span class="col-md-6 col-7">
                        : {{$ticket_info->priority_type->priority}}
                    </span>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="col-5 col-md-6"> Complaint Product </label>
                            <span class="col-7 col-md-6"> : {{$ticket_info->product}}</span>
                        </div>
                    </div>
                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("TicketAdmin"))
                    <!-- Modal  for status change-->
                        <div class="modal fade" id="{{$ticket_info->status_type->status}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content col-md-8 offset-md-2">
                                    <div class="modal-body">
                                        <h3 class="text-dark">Change Status</h3>
                                        <form action="{{ url("/status/change/".$ticket_info->ticket_id) }}" method="GET"
                                              class="form">
                                            <select class="custom-select co" name="status_change">
                                                @foreach($statuses as $status)
                                                    @if(Auth::user()->hasAnyRole("TicketAdmin"))
                                                        <option value="{{$status->id}}">{{$status->status}}</option>
                                                    @else
                                                        @if($status->status!="Close")
                                                            <option value="{{$status->id}}">{{$status->status}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="form-group text-center my-3">
                                            <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-7 col-12">
                    <div class="card desc">
                        <div class="card-body">
                            <h4>User Contact Information </h4>
                            <div class="row">
                                <div class="col-lg-11 col-sm-12 offset-lg-1 offset-sm-0 offset-0">
                                    <label class="col-4 col-sm-4 col-lg-2">User Name </label>
                                    <span class="col-8 col-lg-3 col-sm-8"> : {{$ticket_info->userinfo->name}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 offset-lg-1 offset-sm-0 offset-0">
                                    <label class="col-4 col-sm-4 col-lg-2">Email</label>
                                    <span class="col-8 col-sm-8 col-lg-3">: <a
                                                href="mailto:{{$ticket_info->userinfo->email}}">{{$ticket_info->userinfo->email}}</a></span><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 offset-lg-1 offset-sm-0 offset-0">
                                    <label class="col-4 col-lg-2 col-sm-4">Phone </label>
                                    <span class="col-8 col-sm-8 col-lg-3">: <a
                                                href="tel:+95{{$ticket_info->phone}}">+95{{$ticket_info->phone}}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 offset-lg-1 offset-sm-0 offset-0">
                                    <label class="col-4 col-sm-4 col-lg-2">Source</label>
                                    <span class="col-8 col-sm-8 col-lg-3">: {{$ticket_info->sources_type->sources}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="ml-3">Description </h4>
                                <div class="col-md-11 offset-md-1 mm-font">
                                    <b>{!!$ticket_info->message!!}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card photo_div">
                        <div class="card-header">
                            <h4>Contains {{$numberOfphotos}} @if($numberOfphotos>1) Photos @else Photo @endif</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @for($i=0;$i<$numberOfphotos;$i++)
                                    <div class="col-sm-8 offset-sm-2 offset-lg-1 col-lg-5 col-10 offset-1"
                                         style="padding: 8px;">
                                        <img src="{{asset("/imgs/$photos[$i]")}}" alt="" class="photos ml-2">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-5 col-12">
                    <div class="card" id="comment">
                        <h4 class="ml-3 my-3">Comments:</h4>
                        <div class="comments scroll">
                            @foreach ($comments as $comment)
                                <span>
                        <div class="text-dark col-md-12 col-12">
                            <div class="card mm-font">
                                <div>
                                    <a href="{{url("/comment/delete/$comment->id")}}" class="float-right mr-2"><i
                                                class="fa fa-close text-dark"></i></a>
                                </div>
                                <div class="row ml-2">
                                    <div class="col-md-2">
                                    @if($comment->user->hasAnyRole("Admin"))
                                            <img src="{{asset("/profile/".$comment->user->profile)}}" alt="user_profile"
                                                 width="40px;" height="40px;" class="rounded-circle mr-2">
                                        @else
                                            @php
                                                $pp=\App\user_employee::with("employee")->where("user_id",$comment->user_id)->first();
                                            @endphp
                                            <img src="{{asset("/profile/".$pp->employee->emp_profile)}}"
                                                 alt="user_profile" width="40px;" height="40px;"
                                                 class="rounded-circle mr-2">
                                        @endif
                                    </div>
                                    <div class="col-md-10 mb-3">
                                    <b style="margin-bottom: 5px;">{{ $comment->user->name }}</b>
                                        <i style="font-size: 10px;">{{ $comment->created_at->toFormattedDateString()}}</i><br>
                                    {!!$comment->comment!!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </span>
                            @endforeach
                        </div>
                        <hr>


                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Note</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Reply</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="comment-form">
                                    <form action="{{ url('comment') }}" method="POST" class="form ">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="ticket_id" value="{{ $ticket_info->id }}">
                                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }} col-md-12">
                                            <input type="text" name="comment" class="form-control"
                                                   placeholder="Comment Here ..">
                                            <div class="offset-md-7 offset-sm-8 offset-7 mt-2">
                                                <button type="submit" class="btn btn-info"><i class="fa fa-send mr-2"></i>Comment
                                                </button>
                                            </div>
                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="comment-form">
                                    <form action="{{ url('reply') }}" method="POST" class="form ">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="complainer" value="{{$ticket_info->userinfo->email}}">
                                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }} col-md-12">
                                            <input type="text" name="comment" class="form-control"
                                                   placeholder="Reply ..">
                                            <div class="offset-md-8 offset-sm-9 offset-7 mt-2">
                                                <button type="submit" class="btn btn-info"><i class="fa fa-send mr-2"></i>Reply
                                                </button>
                                            </div>
                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <span class="rounded follower ml-2"><b>Follower :</b>
                    @foreach($followers as $follower)
                                |<strong class="text-dark ml-2"><i class="fa fa-tags mr-2"></i>{{$follower->emp->name}}
                       <a href="{{url("/follower/remove/".$follower->emp->id)}}"> <i class="fa fa-times-circle"></i></a>
                        </strong>
                            @endforeach
                    <a href="" class="rounded-circle fa fa-plus-circle ml-2" data-toggle="modal" data-target="#follower"
                       style="font-size: 25px;color:#eae7e2"></a>
                <div class="modal fade" id="follower" tabindex="-1" role="dialog" aria-labelledby="follower"
                     aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-group mr-2"></i>Add Follower</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                                <form action="{{url("/add/follower/$ticket_info->id")}}" id="follower" method="POST">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="form-group col-md-8">
                                             <label for="">Add Follower</label>
                                                <select class="mul-select  md-form " name="follower[]" multiple="true">
                                                    @foreach($employees as $emp)
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
                </span>
                    </div>
                </div>
            </div>

            <div id="map"></div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".mul-select").select2({
                placeholder: "Select Employee", //placeholder
                tags: true,
                tokenSeparators: ['/', ',', ';', " "]
            });
        });
        // CKEDITOR.replace( 'summary-ckeditor' );
        // Get element references
        var map = document.getElementById('map');

        // Initialize LocationPicker plugin
        var lp = new locationPicker(map, {
            setCurrentPosition: true, // You can omit this, defaults to true
            lat: {{$ticket_info->lat}},
            lng: {{$ticket_info->lng}}
        }, {
            zoom: 15 // You can set any google map options here, zoom defaults to 15
        });
        $(document).ready(function () {
            $("#type").change(function () {
                var val = $(this).val();
                if (val == "dept") {
                    $("#size").html("@foreach($depts as $dept)<option value='{{$dept->id}}'>{{$dept->dept_name}}</option> @endforeach");
                } else if (val == "agent") {
                    $("#size").html(" @if(Auth::user()->hasAnyRole('TicketAdmin')) @foreach($admin as $agent) @if($agent->user->uuid!=$ticket_info->user_id)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @elseif(Auth::user()->hasAnyRole('Agent'))@foreach($admin as $agent)@if($agent->user->uuid!=Auth::user()->uuid)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @endif");
                }
            });
        });
        // The data/time we want to countdown to
        {{--var countDownDate = new Date("{{$end}}").getTime();--}}
        {{--        {{$end}}--}}
        var start = new Date();
        if (new Date("{{$end}}") >= start) {

            {{--}else if(new Date("{{$end}}")>=start) {--}}
            var countDownDate = new Date("{{ $end->format('M d') .', '.$end->format('Y H:i:s') }}").getTime();
            // Run myfunc every second
            // alert(countDownDate);
            var myfunc = setInterval(function () {

                var now = new Date().getTime();
                // alert(now);
                var timeleft = countDownDate - now;
                // alert(timeleft)
                // Calculating the days, hours, minutes and seconds left
                var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

                // Result is output to the specific element
                document.getElementById("days").innerHTML = days + "d "
                document.getElementById("hours").innerHTML = hours + "h "
                document.getElementById("mins").innerHTML = minutes + "m "
                document.getElementById("secs").innerHTML = seconds + "s remaining"

                // Display the message when countdown is over
                if (timeleft < 0) {
                    clearInterval(myfunc);
                    document.getElementById("days").innerHTML = ""
                    document.getElementById("hours").innerHTML = ""
                    document.getElementById("mins").innerHTML = ""
                    document.getElementById("secs").innerHTML = ""
                    document.getElementById("end").innerHTML = "Time Up!";
                }
            }, 1000);

        }
        // else{
        //     document.getElementById("end").innerHTML ="jk";
        //
        // }


    </script>
@endsection
