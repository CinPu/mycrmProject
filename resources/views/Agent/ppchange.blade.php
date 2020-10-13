@extends("layouts.app")
@section("title","Change Profile")
@section("content")
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