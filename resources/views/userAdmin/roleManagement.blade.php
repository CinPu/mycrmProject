@extends("layouts.mainlayout")
@section("title","Role Management")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid" >
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Role Management</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Role</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <button type="button" class="btn btn-outline-secondary mr-2" data-toggle="modal" data-target="#importEmployee">
                            <i class="fa fa-upload mr-2"></i>Import
                        </button>
                        <div class="modal fade" id="importEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Employee</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url("/ticket/import")}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file" >
                                            <br>
                                            <button class="btn btn-outline-success float-right"><i class="fa fa-upload mr-2"></i>Import Ticket</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div style="overflow-x: auto">
            <table class="table" id="usertable">
                <thead>
                <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($employees as $user)
{{--                @dd($user)--}}
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(count($user->roles->pluck("name"))>0)
                                    @foreach($roles as $role)
                                        @if($user->hasRole($role->name))
                                            <span style="font-size: 13px;color: #9c27b0">{{$role->name}}</span>,
                                        @endif
                                    @endforeach
{{--                                <span>{{ucfirst($user->roles->pluck("name")[0])}}</span>--}}
                                @else
                                    <span>No Role</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown ">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-th-list"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item mr-2" data-toggle="modal" data-target="#role{{$user->id}}">
                                            <i class="fa fa-lock mr-2"></i>Give User Role
                                        </a>
                                        <a href="#" class="dropdown-item " data-toggle="modal" data-target="#rm{{$user->id}}" style="text-decoration: none"><i class="fa fa-minus-circle mr-2"></i>Remove Role</a>
                                    </div>
                                </div>
                                <div class="modal fade" id="role{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Give User Role</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <strong>User Current Role:</strong><br>
                                                        @foreach($roles as $role)
                                                            @if($user->hasRole($role->name))
                                                                <i class="fa fa-check"></i>   <span>{{$role->name}}</span><br>
                                                            @endif
                                                        @endforeach
                                                    <form method="post" action="{{url("/role/assign/$user->id")}}" class="my-3">
                                                        {{csrf_field()}}
                                                        <label for="role">Assign Role </label><br>
                                                        @foreach($roles as $role)
                                                            <input type="checkbox" value="{{$role->name}}" name="rolename[]">
                                                            <label for="">{{$role->name}}</label><br>
                                                        @endforeach
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Add</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                            </div>
                                    </div>
                                <div class="modal fade" id="rm{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Remove Role</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body">
                                                    <form method="POST" id="remove" action="{{url("/role/remove/$user->id")}}" class="my-3">
                                                        {{csrf_field()}}
                                                        <label for="role">Remove Role </label><br>
                                                        @foreach($roles as $role)
                                                            @if($user->hasRole($role->name))
                                                                <input type="checkbox" value="{{$role->name}}" name="rolename[]">
                                                                <label for="">{{$role->name}}</label><br>
                                                            @endif
                                                        @endforeach
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Remove</button>
                                                        </div>
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
            $('#usertable').DataTable();
        } );
    </script>
@endsection
