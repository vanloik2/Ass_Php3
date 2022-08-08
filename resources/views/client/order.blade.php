@extends('client.layout.index')
@section('content')
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Order</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Order</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <div class="card container">
        <div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-hover table-stripped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên người dùng</th>
                        <th>Tên sản phẩm</th>
                        <th>Gía sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->username }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total }}</td>
                            <td>
                                {{-- <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning"><i
                                        class="bi bi-gear"></i></a> --}}
                                <form action="{{ route('orderDetroy', $order->id) }}" method="post"
                                    style="display: inline-block" onsubmit="return confirm('Xác nhận xóa!!!')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-warning"><i class="bi bi-trash3"></i></button>
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
