@extends('admin.layout.index')
@section('content')
<div>
    @if(session('success'))
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
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover table-stripped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Mã người dùng</th>
                        <th>Mã tài khoản</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Phân quyền</th>
                        <th>Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->code }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <img src="{{ asset( $user->avatar ) }}" width="60px" alt="">
                            </td>
                            <td>{{ $user->role == 0 ? 'Giáo viên' : 'Sinh viên' }}</td>
                            <td style="width: 145px">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="user"
                                    style="display: inline-block" onsubmit="return confirm('Submit Delete!!!')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Delete</button>
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
