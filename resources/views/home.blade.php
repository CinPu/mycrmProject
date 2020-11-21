<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <!-- CSS Files -->
    <link href="{{url(asset("assets/css/material-dashboard.css?v=2.1.0"))}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{url(asset("/assets/demo/demo.css"))}}" rel="stylesheet" />
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{url(asset("/assets/js/core/jquery.min.js"))}}"></script>
    <title>Document</title>
</head>
<body>
<div class="col-md-6 offset-3 my-5">
    <form action="{{url("/company/profile")}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="card">
            <h3 align="center">Company Profile</h3>
            <div class="col-12 mb-3">
                <div class="mt-3">
                    <div class="text-center" >
                        <h4>Choose Your Company Logo</h4>
                        <img id="output" class="rounded-circle" width="80px" height="80px;"><br><br>
                        <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mt-5">
                        <span for="" class="col-6 col-md-4">Company Name : </span>
                        <input type="text" class="form-control col-md-6 col-6" name="name" >
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <span class="col-6 col-md-4">Company Name Short Form</span>
                        <input type="text" class="form-control col-6 col-md-6" name="short_form" placeholder="eg.LG co.,ltd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <span class="col-6 col-md-4">Company Email</span>
                        <input type="email" class="form-control col-6 col-md-6" name="email" placeholder="Company Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <span class="col-6 col-md-4">Company Address</span>
                        <input type="text" class="form-control col-6 col-md-6" name="address" placeholder="Thiri(5)Street,Hlaing,Yangon">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <span class="col-6 col-md-4">Company Phone</span>
                        <input type="number" class="form-control col-6 col-md-6" name="phone" placeholder="09xxxxxxxxx">
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit"  class="btn btn-primary rounded">Submit</button>
                </div>
            </div>
        </div>
    </form>
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
</body>
</html>