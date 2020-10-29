@extends("layouts.app")
@section("title","Doughnut Chart Report")
@section("csscode")
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
@endsection
@section("search")
    <form action="{{url("/search")}}" method="POST" class="navbar-form my-3 mx-3">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group ml-3">
                <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" placeholder="Enter Start Date">
            </div>
            <div class="form-group ml-3 " >
                <input type="text" name="end_date" id="end_date" autocomplete="off" class="form-control" placeholder="Enter End Date">
            </div>

        <button type="submit" class="btn btn-default btn-round btn-just-icon">
            <i class="material-icons">search</i>
            <div class="ripple-container"></div>
        </button>
        </div>
    </form>
@endsection
@section("content")
    <div class="row">
        <div class="card col-md-4 offset-md-1 col-10 offset-1 text-center" style="background-color:#e0f2f1">
            <div class="card-header card-header-primary">
                Doughnut Chart By Status
            </div>
        <div style="width:250px;height:250px;padding-left: 15px;" class="offset-md-1 my-5">
            <canvas id="status"></canvas>
        </div>
        </div>
        <div class="card col-md-4 offset-md-1 col-10 offset-1" style="background-color: #f3e5f5">
            <div class="card-header card-header-primary">
                Doughnut Chart By Priority Type
            </div>
        <div style="width:250px;height:250px;padding-left: 15px;" class="offset-md-1 my-5">
            <canvas id="priority" ></canvas>
        </div>
        </div>
    </div>
@endsection
@section("scriptcode")
    <script>
        $(function () {
            var ctx = document.getElementById("priority").getContext('2d');
            var data = {
                datasets: [{
                    data: [
                        {{$urgent}},
                        {{$high}},
                        {{$medium}},
                        {{$low}}
                    ],
                    backgroundColor: [
                        '#ef0636',
                        '#9605a0',
                        '#4642ea',
                        "#6fe00b"
                    ],
                }],
                labels: [
                    'Urgent',
                    'High',
                    'Medium',
                    'Low'
                ]
            };
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    // title:{
                    //     display:true,
                    //     text:"All Ticket's Priority Doughnut Chart"
                    // },
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12
                        }
                    }
                }
            });

            var ctx_2 = document.getElementById("status").getContext('2d');
            var data_2 = {
                datasets: [{
                    data: [
                        "{{$new}}",
                        {{$openticket}},
                        {{$pending}},
                        {{$progress}},
                        {{$complete}},
                        {{$closeticket}}
                    ],
                    backgroundColor: [
                        '#ffffff',
                        '#7c0aa5',
                        '#0b43ee',
                        '#f8f159',
                        "#50d007",
                        "#f30d3b",
                    ],
                }],
                labels: [
                    'New',
                    'Open',
                    'Pending',
                    'Progress',
                    'Complete',
                    'Close'
                ]
            };
            var myDoughnutChart_2 = new Chart(ctx_2, {
                type: 'doughnut',
                data: data_2,
                options: {
                    maintainAspectRatio: false,
                    // title:{
                    //     display:true,
                    //     text:"All Ticket's Status Doughnut Chart"
                    // },
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12
                        }
                    }
                }
            });
        });
        $("#start_date").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        $("#end_date").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    </script>
@endsection