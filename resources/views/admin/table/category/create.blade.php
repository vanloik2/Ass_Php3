@extends('admin.layout.index')
@section('content')
    
    <div class="col-md-6">
        <div>
            @if($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" value="{{ old('name') }}" name="name">
            </div>
            <div class="mb-3">
                <label for="">Ảnh danh mục</label>
                <input type="file" class="form-control" value="{{ old('image') }}" name="image">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </form>
    </div>

@endsection