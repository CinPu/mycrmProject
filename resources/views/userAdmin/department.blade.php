@extends("layouts.mainlayout")
@section("title","Department")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Department</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Department</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_dept"><i class="fa fa-plus"></i> Add Department</a>
                        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#importEmployee">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <div class="modal fade" id="importEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Department</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url("/dept/import")}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file" >
                                            <br>
                                            <button class="btn btn-outline-success float-right"><i class="fa fa-upload mr-2"></i>Import Department</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="modal fade" id="add_dept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url("/dept/create")}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="dept_id" >Depatment ID:</label>
                                    <select name="dept_id" id="dept_id" class="form-control mb-3">
                                        <option value="{{$dept_id}}">{{$dept_id}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dept_name" > Depatment Name:</label><br>
                                    <input type="text" id="dept_name" class="form-control mb-3"  name="dept_name" required>
                                </div>
                                <input type="hidden" name="uuid" value="{{Str::uuid()->toString()}}">
                                <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                                <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="overflow-x:auto;">
                <table class="table" id="dept">
                    <thead>
                    <th>Department ID</th>
                    <th>Department Name</th>
                    <th>Department Head</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($depts as $dept)
                        <tr>

                            <th><a href="{{url("/dept/showmember/$dept->id")}}">#{{$dept->dept_id}}</a></th>
                            <td>{{$dept->dept_name}}</td>
                            <td>
                                @if($dept->dept_head==null)
                                    <a href="#" data-toggle="modal" data-target="#add_employee{{$dept->id}}"  style="width: 20%"><i class="fa fa-plus-circle" style="font-size: 20px;"></i></a>
                                @else
                                    {{$dept->department_head->name}}
                                @endif
                                <div id="add_employee{{$dept->id}}" class="modal custom-modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$dept->dept_name}} Head Add</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url("/department/head/add")}}" method="POST" method="POST" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div>
                                                        <div class="text-center" >
                                                            <h4>Profile Picture</h4>
                                                            <img id="output" class="rounded-circle" src="{{url(asset("/img/profiles/avatar-01.jpg"))}}" width="100px" height="100px;"><br>
                                                            <input type="file" accept="image/*" name="profile"  class="offset-md-1" onchange="loadFile(event)">
                                                        </div>
                                                    </div>
                                                    <h4 align="center" class="mt-3">Employee ID: #{{$emp_id}}</h4>
                                                    <h5 align="center">{{$dept->dept_name}}</h5>
                                                    <input type="hidden" name="uuid" value="{{Str::uuid()->toString()}}">
                                                    <div class="form-group row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="name">Name</label>
                                                            <input type="text" id="name" name="name" class="form-control @error('email') is-invalid @enderror" required >
                                                            @if ($errors->has('name'))
                                                                <span class="help-block">
                                        <strong class="text-danger text-center">Name field required. </strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('email') }}</strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-3">
                                                        <div class="col-6">
                                                            <label for="">Gender</label><br>
                                                            <input type="radio"name="gender" class="mr-3" value="Male" checked><label for="">Male</label>
                                                            <input type="radio"name="gender" class="mr-3 ml-5" value="Female"><label for="">Female</label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="">NRC No.</label>
                                                            <input type="text" name="nrc" class="form-control @error('nrc') is-invalid @enderror" required>
                                                            @if ($errors->has('nrc'))
                                                                <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('nrc') }}</strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Nationality</label>
                                                            <input type="text" name="nationality" class="form-control @error('nationality') is-invalid @enderror" required>
                                                            @if ($errors->has('nationality'))
                                                                <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('nationality') }}</strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="emp_id" class="form-control" value="{{$emp_id}}" required>
                                                    <div class="form-group row mt-3">
                                                        <div class="col-6">
                                                            <label for="">Marital Status</label>
                                                            <select name="marital_status" id="" class="form-control">
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Widowed">Widowed</option>
                                                                <option value="Separated">Separated</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Phone</label>
                                                            <input type="number" name="phone" min="0" oninput="validity.valid||(value='');" class="form-control" required  placeholder="0 9 x x x x x x x x x">
                                                            @if ($errors->has('phone'))
                                                                <span class="help-block">
                                        <strong class="text-danger text-center">{{ $errors->first('phone') }}</strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="department" value="{{$dept->id}}">
                                                    <div class="form-group row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="">Company</label>
                                                            <select name="company" id="company" class="form-control">
                                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Join Date</label>
                                                            <input type="date" name="join_date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="">Position</label>
                                                            <select name="position" class="form-control" id="">
                                                                @foreach($positions as $position)
                                                                    <option value="{{$position->id}}">{{$position->emp_position}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Report To</label>
                                                            <select name="report_to" class="form-control" id="">
                                                                <option value="{{\Illuminate\Support\Facades\Auth::user()->id}}">{{\Illuminate\Support\Facades\Auth::user()->name}} (Admin)</option>
                                                                @foreach($report_to as $report)
                                                                    <option value="{{$report->user->id}}">{{$report->user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="">Password</label>
                                                            <input type="password" name="password" class="form-control ">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Confirm Password</label>
                                                            <input type="password" name="confirm_password" class="form-control @error('password') is-invalid @enderror">
                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                            <strong class="text-danger text-center">Confirm Password does not match!</strong>
                                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-3">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown ">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-th-list"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{url("/dept/edit/$dept->id")}}" class="dropdown-item" data-toggle="modal" data-target="#edit{{$dept->id}}" data-whatever="@getbootstrap"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        <a href="{{url("/dept/delete/$dept->id")}} "class=" dropdown-item" ><i class="fa fa-trash mr-2"></i>Delete</a>
                                        <a href="{{url("/dept/showmember/$dept->id")}}" class="dropdown-item"><i class="fa fa-users mr-2" ></i>Member</a>
                                    </div>
                                </div>
                                <div class="modal fade" id="edit{{$dept->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form  id="edit_dept" action="{{url("/dept/edit/$dept->id")}}" method="POST">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="dept_name">Depatment Name:</label><br>
                                                        <input type="text" id="dept_name" class="form-control mb-3"  name="dept_name" value="{{$dept->dept_name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        @php
                                                            $members=\App\employee::where("dept_id",$dept->id)->get();

                                                            $dept_member=[];
                                                            foreach ($members as $item) {
                                                                 $user_emp=\App\user_employee::with("user")->where("emp_id",$item->id)->first();
                                                                 if($user_emp!=null){
                                                                     array_push($dept_member,$user_emp);
                                                                 }
                                                            }
                                                        @endphp
                                                        <label for="">Department Head</label>
                                                        <select name="dept_head" id="" class="select">
                                                            @foreach($dept_member as $member)
                                                                <option value="{{$member->user_id}}">{{$member->user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-success float-right mr-2">Save</button>
                                                    <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">Close</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dept').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    {
                        extend: 'collection',
                        text: '<i class="fa fa-download mr-2"></i>Export',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    }
                ],
            });
        });

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
