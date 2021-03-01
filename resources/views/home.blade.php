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

    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Document</title>
</head>
<body>
<div class="col-lg-6 offset-lg-3 col-sm-10 offset-sm-1 col-12 my-5">
    <form action="{{url("/company/profile")}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card jumbotron">
            <div class="col-12 mb-3">
                <div>
                    <div class="text-center" >
                        <h4>Choose Company Logo</h4>
                        <img id="output" class="rounded-circle" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br><br>
                        <input type="file" accept="image/*" name="logo"  class="offset-md-1" onchange="loadFile(event)">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Company ID : </label>
                        <input type="text" class="form-control" name="company_id"  >
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Company Name : </label>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Company CEO Name</label>
                        <input type="text" class="form-control" name="ceo">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Company Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Company Email">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Parent Company</label>
                        <input type="text" class="form-control" name="parent">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Business Type</label>
                        <input type="text" class="form-control" name="business_type">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Company Phone</label>
                        <input type="number" class="form-control" name="phone" placeholder="09xxxxxxxxx">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12">
                        <label>Hot Line</label>
                        <input type="number" class="form-control" name="hotline" placeholder="09xxxxxxxxx">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                        <label>Company Website Link</label>
                        <input type="url" class="form-control" name="web_link" value="https://">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                        <label>Facebook Page Link</label>
                        <input type="url" class="form-control" name="facebook_page" value="https://">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                        <label>LinkedIn</label>
                        <input type="url" class="form-control" name="linked_in" value="https://">
                    </div>
                    <div class="form-group col-lg-6 col-sm-6 col-12 ">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Thirih(5)Street,Hlaing Township,Yangon">
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 col-12 ">
                        <label>Company Registry</label><br>
                        <textarea rows="3" style="width: 100%" name="company_retistry"></textarea>
                    </div>
                    <div class="form-group col-lg-6 col-sm-12 col-12 ">
                        <label>Company Vision</label><br>
                        <textarea rows="3" style="width: 100%" name="vision"></textarea>
                    </div>
                    <div class="form-group col-lg-12 col-sm-12 col-12 ">
                        <label>Company Mission</label><br>
                        <textarea rows="3" style="width:100%;" name="mission"></textarea>
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
