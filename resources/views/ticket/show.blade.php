@extends("layouts.app")
@section("title","Ticket")
@section("csscode")
    <style>
        .photos{
            max-width: 220px;
            max-height: 500px;
        }
        /*#label{*/
        /*    padding-left: 50px;*/
        /*}*/
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE5"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
@endsection
@section("content")
    <div class="card">
        <div class="card-header"><h4><i class="fa fa-ticket " style="font-size: 35px"></i> Ticket </h4>
            @if(Auth::user()->hasAnyRole("Admin"))
                @if($ticket_info->isassign==1)
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Reassign</button>
                    </div>
                @endif
            @else
                @if($ticket_info->user_id!=\Illuminate\Support\Facades\Auth::user()->uuid)
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Reassign</button>
                    <a href="{{url("/countdown/$ticket_info->ticket_id")}}" class="btn btn-primary float-right">Accept</a>
                    <span id="end"></span>
                @endif
            @endif
            <span id="days"></span><span id="hours"></span><spanp id="mins"></spanp><spanp id="secs"></spanp>
            {{--            @endif--}}
            <span id="clock-placeholder"></span>
        </div>
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
        <div class="card-body">
            <h4>Ticket Information </h4><span class="ticketid float-right"> Ticket ID : <b class="text-warning">{{$ticket_info->ticket_id}}</b>
            </span><br>
            <div class="row">
                <div class="col-md-5 offset-md-1 col-12">
                    <label >Ticket  Title :</label>
                    <span>{{$ticket_info->title}}</span>
                </div>
                <div class="col-md-6 col-12">
                    <label >Case Type :</label>
                    <span >{{$ticket_info->cases->name}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-1 col-12">
                    <label>Status :</label>   <!-- Button trigger modal -->
                    <span>
                        {{$ticket_info->status_type->status}}
                        <a href=""  data-toggle="modal" data-target="#2020"><i class="fa fa-edit"></i></a>
                    </span>
                </div>
                <div class="col-md-6 col-12">
                    <label> Last Changed Status</label> : {{$ticket_info->updated_at->diffForHumans()}}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-1 col-12">
                    <label> Priority :</label>
                    <span>
                        <button type="button" class="btn btn-{{$ticket_info->priority_type->color}}">
                        </button>
                        {{$ticket_info->priority_type->priority}}
                    </span>
                </div>
                <div class="col-md-6 col-12">
                    <label> Complaint Product :</label>
                    <span> {{$ticket_info->product}}</span>
                </div>
            </div>
            <!-- Modal  for status change-->
            <div class="modal fade" id="2020" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog" role="document" style="padding-left: 200px;">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                            <h3 class="text-dark">Change Status</h3>
                            <form action="{{ url("/status/change/".$ticket_info->ticket_id) }}" method="GET" class="form">
                                <select class="custom-select" name="status_change">
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


        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>User Contact Information </h4>
            <div class="row">
                <div class="col-md-11 offset-md-1">
                    <label>User Name :</label>
                    <span> <i class="fa fa-user mr-2"></i> {{$ticket_info->userinfo->name}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-md-1">
                    <label>Email : </label>
                    <span><a href="mailto:{{$ticket_info->userinfo->email}}"><i class="fa fa-envelope mr-2"></i> {{$ticket_info->userinfo->email}}</a></span><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-md-1">
                    <label>Phone : </label>
                    <span>
                            <i class="fa fa-phone mr-2"></i>
                            <a href="tel:+95{{$ticket_info->phone}}">+95{{$ticket_info->phone}}</a>
                        </span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-md-1">
                    <label>Source : </label>
                    <span> {{$ticket_info->sources_type->sources}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-md-1 mm-font">
                    <b>{!!$ticket_info->message!!}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
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
    <div class="card">
        <div class="comments">
            <h4 class="ml-5 my-3">Comments:</h4>
            @foreach ($comments as $comment)
                <div>
                    <div class="text-dark col-md-12 col-12">
                        <div class="offset-md-2 col-md-6 card bg-rose mm-font">
                            <b style="margin-bottom: 5px;">{{ $comment->user->name }} : </b>
                            {!!$comment->comment !!}
                            <span class="float-right">{{ $comment->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="comment-form">
            <form action="{{ url('comment') }}" method="POST" class="form my-3">
                {!! csrf_field() !!}
                <input type="hidden" name="ticket_id" value="{{ $ticket_info->id }}">
                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }} col-md-12">
                    <textarea row="2" class="form-control" id="summary-ckeditor" name="comment"></textarea>
                    @if ($errors->has('comment'))
                        <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-info float-right mr-3">Send</button>
            </form>
        </div>
    </div>
    <div id="map"></div>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
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
    </script>
    <script>

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
