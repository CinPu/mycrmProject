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
        .photo_div{
            /*width: 300px;*/
            height: 370px;
            overflow: scroll;
        }
        .desc{
            height: 300px;
            overflow: scroll;
        }
        #comment{
            height: 700px;
        }
        .photos{
            max-width: 220px;
            max-height: 500px;
        }
        /*#label{*/
        /*    padding-left: 50px;*/
        /*}*/
        .mul-select{
            width: 250px;
        }
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcNrvPMoDFFCgVzzCP3Oeu1iIwBtJ72ZM"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
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
            @if(Auth::user()->hasAnyRole("Admin"))
                @if($ticket_info->isassign==1)
                    <div class="col-md-12 mt-3">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Reassign</button>
                    </div>
                @endif
            @else
                @if($ticket_info->user_id!=\Illuminate\Support\Facades\Auth::user()->uuid)
                    @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin"))
                    <button type="button" class="btn btn-primary float-right mt-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Reassign</button>
                    <a href="{{url("/countdown/$ticket_info->ticket_id")}}" class="btn btn-primary float-right mt-3">Accept</a>
                   @endif
                    <span id="end"></span>
                @endif
            @endif
            <span id="days"></span><span id="hours"></span><spanp id="mins"></spanp><spanp id="secs"></spanp>
            {{--            @endif--}}
            <span id="clock-placeholder"></span>

                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin"))
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="form-group row">
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
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Reassigned</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            @endif
        <div class="card-body">
            <h4>Ticket Information </h4><span class="ticketid float-right"> Ticket ID : <b class="text-warning">{{$ticket_info->ticket_id}}</b>
            </span><br>
            <div class="row">
                <div class="col-md-5 offset-md-1 col-12">
                    <label class="col-6">Ticket  Title </label>
                    <span class="col-6">: {{$ticket_info->title}}</span>
                </div>
                <div class="col-md-6 col-12">
                    | <label class="col-6">Case Type </label>
                    <span class="col-6">: {{$ticket_info->cases->name}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-1 col-12">
                    <label class="col-6">Status </label>   <!-- Button trigger modal -->
                    <span class="col-6">
                        : {{$ticket_info->status_type->status}}
                        @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin"))
                        <a href=""  data-toggle="modal" data-target="#2020"><i class="fa fa-edit"></i>Status Change</a>
                            @endif
                    </span>
                </div>
                <div class="col-md-6 col-12">
                    | <label class="col-6"> Last Changed Status </label><span class="col-6"> : {{$ticket_info->updated_at->diffForHumans()}}
                    </span>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-5 offset-md-1 col-12">
                    <label class="col-6"> Priority </label>
                    <span class="col-6">
                        : {{$ticket_info->priority_type->priority}}
                    </span>
                </div>
                <div class="col-md-6 col-12">
                    | <label class="col-6"> Complaint Product </label>
                    <span class="col-6"> : {{$ticket_info->product}}</span>
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Agent")||\Illuminate\Support\Facades\Auth::user()->hasAnyRole("Admin"))
            <!-- Modal  for status change-->
            <div class="modal fade" id="2020" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog " role="document" >
                    <div class="modal-content col-md-8 offset-md-2">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                            <h3 class="text-dark">Change Status</h3>
                            <form action="{{ url("/status/change/".$ticket_info->ticket_id) }}" method="GET" class="form">
                                <select class="custom-select co" name="status_change">
                                    @foreach($statuses as $status)
                                        @if(Auth::user()->hasAnyRole("Admin"))
                                            <option value="{{$status->id}}">{{$status->status}}</option>
                                        @else
                                            @if($status->status!="Close")
                                                <option value="{{$status->id}}">{{$status->status}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary float-right form-group">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                @endif
        </div>
    </div>

            <div class="row">
                <div class="col-md-8 ">
                    <div class="card desc">
                        <div class="card-body">
                            <h4>User Contact Information </h4>
                            <div class="row">
                                <div class="col-md-11 offset-md-1">
                                    <label class="col-4 col-md-2">User Name </label>
                                    <span class="col-8 col-md-3"> : {{$ticket_info->userinfo->name}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11 offset-md-1">
                                    <label class="col-4 col-md-2">Email</label>
                                    <span class="col-8 col-md-3">: <a href="mailto:{{$ticket_info->userinfo->email}}">{{$ticket_info->userinfo->email}}</a></span><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11 offset-md-1">
                                    <label class="col-4 col-md-2">Phone </label>
                                    <span class="col-8 col-md-3">: <a href="tel:+95{{$ticket_info->phone}}">+95{{$ticket_info->phone}}</a>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11 offset-md-1">
                                    <label class="col-4 col-md-2">Source</label>
                                    <span class="col-8 col-md-3">: {{$ticket_info->sources_type->sources}}</span>
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
                    <div class="ml-4"style="padding: 8px;">
                        <img src="{{asset("/imgs/$photos[$i]")}}"  alt="" class="photos">
                    </div>
                @endfor
                </div>
        </div>
    </div>
        </div>
                <div class="col-md-4">
                     <div class="card" id="comment">
                        <h4 class="ml-3 my-3">Comments:</h4>
                         <div class="comments scroll">
                @foreach ($comments as $comment)
                    <span>
                        <div class="text-dark col-md-12 col-12">
                            <div class="card mm-font">
                                <div>
                                    <a href="{{url("/comment/delete/$comment->id")}}" class="float-right mr-2"><i class="fa fa-close text-dark"></i></a>
                                </div>
                                <div class="row ml-2">
                                    <div class="col-md-2">
                                    @foreach($profile as $pp)
                                        @if($pp->user_id==$comment->user->id)
                                            <img src="{{asset("/profile/$pp->profile")}}" alt="user_profile" width="40px;"height="40px;" class="rounded-circle mr-2">
                                            @endif
                                    @endforeach
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
                        <div class="comment-form">
                                <form action="{{ url('comment') }}" method="POST" class="form ">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="ticket_id" value="{{ $ticket_info->id }}">
                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }} col-md-12">
                                        <input type="text" name="comment" class="form-control" placeholder="Comment Here ..">
                                        <div class="offset-md-7 offset-sm-8 offset-7 mt-2"><button type="submit" class="btn btn-info"><i class="fa fa-send mr-2"></i>Comment</button></div>
                                            @if ($errors->has('comment'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('comment') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </form>
                        </div>
                        <span class="rounded follower ml-2"><b>Follower :</b>
                    @foreach($followers as $follower)
                        |<strong class="text-dark ml-2"><i class="fa fa-tags mr-2"></i>{{$follower->emp->name}}
                       <a href="{{url("/follower/remove/".$follower->emp->id)}}"> <i class="fa fa-times-circle"></i></a>
                        </strong>
                    @endforeach
                    <a href=""class="rounded-circle fa fa-plus-circle ml-2" data-toggle="modal" data-target="#follower" style="font-size: 25px;color:#eae7e2"></a>
                <div class="modal fade" id="follower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <option value="{{$emp->employee_user->id}}">{{$emp->employee_user->name}}</option>
                    @endforeach
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Follow</button>
      </div></form>
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
        $(document).ready(function(){
            $(".mul-select").select2({
                placeholder: "Select Employee", //placeholder
                tags: true,
                tokenSeparators: ['/',',',';'," "]
            });
        });
        $(document).ready(function (){
            $(".follower").function ({
                tokenSeparators: ['/',',',';'," "]
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
                    $("#size").html(" @if(Auth::user()->hasAnyRole('Admin')) @foreach($admin as $agent) @if($agent->user->uuid!=$ticket_info->user_id)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @elseif(Auth::user()->hasAnyRole('Agent'))@foreach($admin as $agent)@if($agent->user->uuid!=Auth::user()->uuid)<option value='{{$agent->user->id}}'>{{$agent->user->name}}</option> @endif @endforeach @endif");
                }
            });
        });
        // The data/time we want to countdown to
        {{--var countDownDate = new Date("{{$end}}").getTime();--}}
        {{--        {{$end}}--}}
        var start=new Date();
        if(new Date("{{$end}}")>=start){

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
