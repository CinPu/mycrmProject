<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Welcome</title>
</head>
<body>
<div class="bg-primary">
<nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand float-right" href="#">Support Ticket</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav offset-md-10 float-right">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url("/login")}}">Login <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/register")}}">Register</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="home_body" style="height: 250px;">
    <br>
<div>
    <h3 align="center" class="my-5">
        What can I do to help you?
    </h3>
    <!-- Default dropright button -->
    <div class="btn-group offset-md-5 offset-3 dropright">
        <button type="button" class="btn btn-white  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Send Report Ticket
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @foreach($admins as $admin)
            <a class="dropdown-item" href="{{url("/ticket/create/$admin->uuid")}}"><i class="fa fa-building-o mr-2"></i> {{$admin->name}}</a>
            @endforeach
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>