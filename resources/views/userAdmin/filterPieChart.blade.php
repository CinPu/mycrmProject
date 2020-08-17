@extends("layouts.app")
@section("title","Doughnut Chart Report")
@section("csscode")
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
@endsection
@section("content")
    <div class="row">
        <div style="width:240px;height:240px" class="offset-md-2">
            <canvas id="status"></canvas>
        </div>
        <div style="width:240px;height:240px" class="offset-md-2">
            <canvas id="priority" ></canvas>
        </div>
    </div>
    <h4 align="center">Between <strong>{{$startDate->toformattedDateString()}}</strong> and <strong>{{$endDate->toformattedDateString()}}</strong></h4>
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
                    title:{
                        display:true,
                        text:" Ticket's Doughnut Chart By Priority Type"
                    },
                    legend: {
                        position: 'right',
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
                    title:{
                        display:true,
                        text:"Ticket's  Doughnut Chart By Status"
                    },
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12
                        }
                    }
                }
            });
        });
    </script>
@endsection