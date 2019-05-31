@extends('Backend.Layouts.default')
@section ('title', 'Thống kê')
@section('content')
    <div class="content-wrapper">
        <div id="page-content">
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">7 ngày gần đây</h4>
                            <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">

                </div>
            </div>

        </div>
    </div>
@endsection

@push ('myJs')
    <script>
        var labels = [];
        var datas  = [];
        @foreach ($data_7day as $key => $value)
             labels.push('{{ $value["date"] }}');
             datas.push('{{ $value["count_order"] }}');
        @endforeach
        console.log(labels, datas)
        var areaData = {
            labels: labels,
            datasets: [{
                label: 'Số đơn hàng',
                data: datas,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: 'origin', // 0: fill to 'origin'
                fill: '+2', // 1: fill to dataset 3
                fill: 1, // 2: fill to dataset 1
                fill: false, // 3: no fill
                fill: '-2' // 4: fill to dataset 2
            }]
        };
        var areaOptions = {
            plugins: {
                filler: {
                    propagate: true
                }
            }
        }
        if ($("#areaChart").length) {
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
        }
    </script>
@endpush
@push ('myCss')
@endpush

