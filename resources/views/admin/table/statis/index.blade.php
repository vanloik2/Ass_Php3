@extends('admin.layout.index')
@section('content')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header">
            <form action="" method="get">
                <div class="row row-cols-auto">
                    <div class="col input-group">
                        <input type="text" value="" class="form-control" name="txt_search">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Refresh</button>
                    </div>
                    <div class="col">
                        {{-- <a href="" class="btn btn-primary">Add</a> --}}
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover table-stripped table-bordered text-center">
                <thead>
                    <tr>
                        <th>Số người dùng</th>
                        <th>Số Danh mục</th>
                        <th>Số sản phẩm</th>
                        <th>Số bình luận</th>
                        <th>Số đơn hàng</th>
                        <th>Số liên hệ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $statis['slUser'] }}</td>
                        <td>{{ $statis['slCate'] }}</td>
                        <td>{{ $statis['slProduct'] }}</td>
                        <td>{{ $statis['slComment'] }}</td>
                        <td>{{ $statis['slOrder'] }}</td>
                        <td>{{ $statis['slContact'] }}</td>
                        {{-- <td>
                                <a href="" class="btn btn-sm btn-warning"><i class="bi bi-gear"></i></a>
                                <form action="{{ route('statis.destroy', $statis->id) }}" method="post"
                                    style="display: inline-block" onsubmit="return confirm('Xác nhận xóa!!!')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td> --}}
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <h2 style="margin-top: 15px">Biểu đồ thống kê</h2>
    <!-- Bar Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
        </div>
        <div class="card-body">
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
            <hr>
            {{-- Styling for the bar chart can be found in the --}}
            {{-- <code>/js/demo/chart-bar-demo.js</code> file. --}}
        </div>
    </div>
    <script src="vendor/chart.js/Chart.min.js"></script>


    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        (Chart.defaults.global.defaultFontFamily = "Nunito"),
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = "#858796";

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + "").replace(",", "").replace(" ", "");
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
                dec = typeof dec_point === "undefined" ? "." : dec_point,
                s = "",
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return "" + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || "").length < prec) {
                s[1] = s[1] || "";
                s[1] += new Array(prec - s[1].length + 1).join("0");
            }
            return s.join(dec);
        }

        // Bar Chart Example
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Người dùng", "Danh mục", "Sản phẩm", "Đơn hàng", "Bình luận", "Liên hệ"],
                datasets: [{
                    label: "Revenue",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [ {{ $statis['slUser'] }}, {{ $statis['slCate'] }}, {{ $statis['slProduct'] }}, {{ $statis['slOrder'] }}, {{ $statis['slComment'] }}, {{ $statis['slContact'] }}],
                }, ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0,
                    },
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: "month",
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            maxTicksLimit: 6,
                        },
                        maxBarThickness: 25,
                    }, ],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max:  {{ $statis['max'] }},
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return "$" + number_format(value);
                            },
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2],
                        },
                    }, ],
                },
                legend: {
                    display: false,
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: "#6e707e",
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel =
                                chart.datasets[tooltipItem.datasetIndex].label || "";
                            return (
                                datasetLabel + ": $" + number_format(tooltipItem.yLabel)
                            );
                        },
                    },
                },
            },
        });
    </script>
@endsection
