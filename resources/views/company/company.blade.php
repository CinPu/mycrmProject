@extends("layouts.app")
@section("content")
    <div class="card col-md-6 offset-2 my-5">
        <form action="{{url("/company/create")}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <h3 align="center">Company Profile</h3>
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Company Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Company Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Company Address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phone" placeholder="Company Phone">
            </div>
            <div class="text-center" >
                <h4>Choose Your Profile Picture</h4>
                <input type="file" accept="image/*" name="logo" onchange="loadFile(event)">
                <br>
                <img id="output" class="rounded-circle" width="80px" height="80px;">
            </div>
            <div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section("scriptcode")
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