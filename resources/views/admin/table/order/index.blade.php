@extends('admin.layout.index')
@section('content')
<style>
</style>
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
            <table class="table table-stripped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên người dùng</th>
                        <th>Tên sản phẩm</th>
                        <th>Gía sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                {{-- <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-gear"></i></a> --}}
                                <form action="{{ route('change-status-order', $order) }}" method="post" style="display: inline-block"
                                    onsubmit="return confirm('Xác nhận hoàn thành đơn hàng!!!')">
                                    @method('PUT')
                                    @csrf
                                    @if ($order->status == 0)
                                        <button class="change-status"
                                            style="border: none; background-color: #ffffff; color: blue">Chưa xử lí</button>
                                    @elseif($order->status == 2)
                                        <p class="change-status"
                                            style="border: none; background-color: #ffffff; color: green">Đã hoàn
                                            thành</p>
                                    @elseif($order->status == 1)
                                        <p class="change-status"
                                            style="border: none; background-color: #ffffff; color: red">Đã hủy</p>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div>{{ $orders->links() }}</div>
        </div>
    </div>
@endsection
