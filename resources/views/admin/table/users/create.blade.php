@extends('admin.layout.admin')
@section('content')
<div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
        </ul>
    </div>
    @endif
</div>
    <div class="col-md-6">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="">Mã tài khoản</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3">
                <label for="">Mã người dùng</label>
                <input type="text" class="form-control" name="code">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="">Avatar</label>
                <input type="file" class="form-control" name="avatar">
            </div>
            <div class="mb-3">
                <label for="">Phân quyền</label> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" checked id="inlineRadio1"
                        value="0">
                    <label class="form-check-label" for="inlineRadio1">Giáo viên</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="inlineRadio2"
                        value="1">
                    <label class="form-check-label" for="inlineRadio2">Sinh viên</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Trạng thái</label> <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" checked id="inlineRadio1"
                        value="1">
                    <label class="form-check-label" for="inlineRadio1">Hiện</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                        value="2">
                    <label class="form-check-label" for="inlineRadio2">Ẩn</label>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
@endsection
