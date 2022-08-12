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
            Styling for the bar chart can be found in the
            <code>/js/demo/chart-bar-demo.js</code> file.
        </div>
    </div>
@endsection
