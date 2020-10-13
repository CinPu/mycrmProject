@extends("layouts.app")
@section("title","Guest User Information")
@section("csscode")
    <style>
        .dt-button{
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endsection
@section("content")
    <div class="card">
        <div class="col-md-12 col-12">
    <table class="table" id="userinfo">
        <thead>
        <th scope="col">User Name</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
        </thead>
    @foreach($userinfo as $user)
        <tr>
        <td>
            <span>
                <img class="img rounded-circle" src="{{url("assets/img/agentpp.png")}}" height="40px;" width="40px;" />
            </span>
            <b class="ml-3">{{$user->name}}
            </b>
        </td>
            <td>{{$user->email}}</td>
            <td>
            <a href="{{url("/guestuser/sending/$user->id")}}"><i class="fa fa-eye mr-2"></i>Detail</a>
            </td>
        </tr>
        @endforeach
    </table>
        </div>
    </div>
@endsection
@section("scriptcode")
    <script>
        $(document).ready(function() {
            $('#userinfo').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
            } );
        } );
    </script>
@endsection