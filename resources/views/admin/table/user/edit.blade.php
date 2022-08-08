@extends('admin.layout.index')
@section('content')

    <div class="col-md-12">
        <div>
            @if ($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Tên người dùng</label>
                        <input type="text" class="form-control"
                            value="{{ $user->name }}"
                            name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control"
                            value="{{ $user['email'] }}"
                            name="email">
                    </div>
                    <div class="mb-3">
                        <label for="">Mật khẩu</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <div class="mb-3">
                        <label for="">Vai trò</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="1"
                                @checked($user->role == 1)>
                            <label class="form-check-label" for="inlineRadio1">Nhân viên</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="2"
                                @checked($user->role == 2)>
                            <label class="form-check-label" for="inlineRadio1">Khách hàng</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control"
                            value="{{ $user['phone_number'] }}"
                            name="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control"
                            value="{{ $user['address'] }}"
                            name="address">
                    </div>
                    <div class="mb-3">
                        <label for="">Hình đại diện</label>
                        <input type="file" class="form-control" onchange="uploadFile()" value="{{ $user->avatar }}"
                            name="avatar" id="image_upload">
                        <p class="preview-image"><img src=" {{ asset($user->avatar) }}" id="previewImage" alt="">
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="">Trạng thái</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1"
                                @checked($user->status == 1)>
                            <label class="form-check-label" for="inlineRadio1">Hoạt động</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="2"
                                @checked($user->status == 2)>
                            <label class="form-check-label" for="inlineRadio1">Không hoạt động</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </form>
    </div>

@endsection
