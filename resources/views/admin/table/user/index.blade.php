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
                        <input type="text" value="{{ $txt_search }}" class="form-control" name="txt_search">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Refresh</button>
                    </div>
                    <div class="col">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover table-stripped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên người dùng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Hình đại diện</th>
                        <th>Địa chỉ</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <img src="{{ asset($user->avatar) }}" width="60px" alt="">
                            </td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role == 1 ? 'Nhân viên' : 'khách hàng' }}</td>
                            <td>
                                <form action="{{ route('change-status-user', $user) }}" method="post"
                                    onsubmit=" return confirm('Đổi trạng thái người dùng!')">
                                    @method('PUT')
                                    @csrf

                                    <div class="form-check form-switch">
                                        @if ($user->status == 1)
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
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-gear"></i></a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post"
                                    style="display: inline-block" onsubmit="return confirm('Submit Delete!!!')">
                                    @method('DELETE')
                                    @csrf
                                    @if(Auth::user()->id != $user->id)
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div>{{ $users->links() }}</div>
        </div>
    </div>
@endsection
