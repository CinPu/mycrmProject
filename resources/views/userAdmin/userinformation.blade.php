@extends("layouts.mainlayout")
@section("title","Complainer")
@section("content")
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Complainer</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url("/home")}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Complainer</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="col-md-12 col-12 mt-3" style="overflow-x: auto">
            <table class="table " id="userinfo">
                <thead>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </thead>
                <tbody>
                @foreach($userinfo as $user)
                    <tr>
                        <td>
                        <span><i class="fa fa-user"></i></span><b class="ml-3">{{$user->name}}</b>
                    </td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{url("/guestuser/sending/$user->id")}}"><i class="fa fa-eye mr-2"></i>Detail</a>
                        </td>
                    </tr>
                @endforeach
        </tbody>
            </table>
        </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#userinfo').DataTable( {
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
            } );
        } );
    </script>
@endsection