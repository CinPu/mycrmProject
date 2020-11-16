@extends("layouts.mainlayout")
@section("title","Change Profile")
@section("content")
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
    <div class="card col-md-6 offset-md-3">
    <form action="" method="POST" enctype="multipart/form-data" class="my-5">
        {{csrf_field()}}
    <div class="text-center" >
        <h4>Choose Your Profile Picture</h4>
        <input type="file" accept="image/*" name="profile" onchange="loadFile(event)">
        <br>
        <img id="output" class="rounded-circle" width="80px" height="80px;">
    </div>
        <div class="text-center mt-2">
        <button type="submit"  class="btn btn-primary">Save Change</button>
        </div>
    </form>
    </div>
        </div>
    </div>
        <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection