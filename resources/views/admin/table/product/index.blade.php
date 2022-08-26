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
                <div class="row">
                    <div class="col-md-7 input-group">
                        <select class="form-select col-md-5" name="category_id">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                @if($category->id == $category_id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="text" value="{{ $txt_search }}" class="form-control" name="txt_search">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Refresh</button>
                    </div>
                    <div class="col">
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover table-stripped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" width="60px" alt="">
                            </td>
                            <td>{{ isset($product->category->name) ? $product->category->name : '' }}</td>
                            <td>
                                <form action="{{ route('change-status-product', $product) }}" method="post"
                                    onsubmit=" return confirm('Đổi trạng thái sản phẩm!')">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-check form-switch">
                                        @if ($product->status == 1)
                                            <input class="form-check-input input-status" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault" checked>
                                            <button class="btn-status" type="submit"></button>
                                        @else
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckDefault">
                                            <button class="btn-status" type="submit"></button>
                                        @endif
                                    </div>
                                </form>
                            </td>
                            <td style="width: 95px">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning"><i
                                        class="bi bi-gear"></i></a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="post"
                                    style="display: inline-block" onsubmit="return confirm('Submit Delete!!!')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div>{{ $products->links() }}</div>
        </div>
    </div>
@endsection
