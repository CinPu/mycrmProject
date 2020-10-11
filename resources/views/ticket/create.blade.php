@extends("layouts.app")
@section("title","Ticket Create")
@section("csscode")
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
    </style>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
@endsection
@section("content")
    <div class="container-fluid">
    <h3>Create New Ticket</h3>
    <form id="ticket_create" method="post" action="{{url("/ticket/create/$id")}}" enctype="multipart/form-data">
       {{csrf_field()}}
        <div class="row">
            <div class="col-md-4 card ml-1 ">
                <div class="form-group  mt-3">
                    <label for="Email1">Email Address</label><br>
                    <select name="user_info_id" class="form-control">
                        @foreach($user_infos as $user_info)
                            <option value="{{$user_info->id}}">{{$user_info->email}}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-success col-md-4 float-right" data-toggle="modal" data-target="#email" data-whatever="@getbootstrap">
                        Add Email
                    </button>
                </div>
                <div class="form-group mt-3">
                    <label for="phoneNumber">Phone Number</label><br>
                    <input type="number" class="form-control" name="phone" id="phoneNumber" aria-describedby="emailHelp">
                </div>
                <label for="title" class="mt-3">Ticket Title</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="form-group mt-3">
                    <label for="product">Product</label><br>
                    <input type="text" class="form-control" name="product" id="product">
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Case Type</label><br>
                    <select class="form-control" name="case_type">
                        @foreach($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Priority</label><br>
                    <select class="form-control" name="priority">
                        @foreach($priorities as $priority)
                            <option value="{{$priority->id}}">{{$priority->priority}}</option>
                        @endforeach
                    </select>
                    @foreach($statuses as $status)
                        @if($status->status=="New")
                    <input type="hidden" name="status" value="{{$status->id}}">
                        @endif
                    @endforeach
                </div>
                <div class="form-group mt-3">
                    <label for="source">Source</label><br>
                    <select name="source" id="" class="form-control">
                        @foreach($sources as $source)
                        <option value="{{$source->id}}">{{$source->sources}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="uuid" value="{{$id}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <label for="">Location</label>
                <div class="form-group">
                    <label for="">Latitude</label>
                    <input type="text" id="lat" name="lat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Longitude</label>
                    <input type="text" id="lng" name="lng" class="form-control">
                </div>
            </div>

            <div class="col-md-7 card ml-1">
                <label for="exampleInputEmail1" class="mt-3">Content</label>
                <div class="form-group">
                    <textarea class="form-control" id="summary-ckeditor" name="message"></textarea>
                    {{--                        <textarea class="form-control" name="message" id="exampleInputEmail1" aria-describedby="emailHelp">--}}
                    {{--                    </textarea>--}}
                </div>
                <div class=" card ">
                    <div class="field my-5 " align="center">
                            <span>
                                <h4 align="center">Upload your images</h4>
                                <i>You Can Choose Multiple Image</i>
                                <input type="file"  id="files" name="files[]" multiple />
                            </span>
                    </div>
                </div>
                <div id="map"></div>
                <div class="form-group">
                <button type="submit" id="submit-all" class="btn btn-primary float-right"><i class="fa fa-paper-plane mr-3"></i>Send</button>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="email_create" method="post" class="form-group" action="{{url("/user_info/create/$id")}}">
                        {{csrf_field()}}
                        <div class="modal-body">
                           <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="user_name">
                           </div>
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control " name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<div class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><div class=\"remove\"><i class='fa fa-remove'>Remove</div>" +
                                "</div>").insertAfter("#files");
                            $(".remove").click(function(){
                                $(this).parent(".pip").remove();
                            });


                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });


    </script>
@endsection
@section("scriptcode")
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
        // Get element references
        var map = document.getElementById('map');
        // Initialize LocationPicker plugin
        var lp = new locationPicker(map, {
            setCurrentPosition: true, // You can omit this, defaults to true
        }, {
            zoom: 15 // You can set any google map options here, zoom defaults to 15
        });

        // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
        google.maps.event.addListener(lp.map, 'idle', function (event) {
            // Get current location and show it in HTML
            var location = lp.getMarkerPosition();
           document.getElementById("lat").value=location.lat;
           document.getElementById("lng").value=location.lng;
        });
    </script>
@endsection
