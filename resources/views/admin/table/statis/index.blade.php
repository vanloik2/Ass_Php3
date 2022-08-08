@extends('admin.layout.index')
@section('content')
<div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
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
            <table class="table table-hover table-stripped table-bstatised text-center">
                <thead>
                    <tr>
                        <th>Số lượng người dùng</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Số lượng đơn hàng</th>
                        <th>Số lượng liên hệ</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ $statis['slUser'] }}</td>
                            <td>{{ $statis['slProduct'] }}</td>
                            <td>{{ $statis['slOrder'] }}</td>
                            <td>{{ $statis['slContact'] }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-warning"><i class="bi bi-gear"></i></a>
                                {{-- <form action="{{ route('statis.destroy', $statis->id) }}" method="post"
                                    style="display: inline-block" onsubmit="return confirm('Xác nhận xóa!!!')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                                </form> --}}
                            </td>
                        </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
