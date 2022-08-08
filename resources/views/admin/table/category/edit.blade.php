@extends('admin.layout.index')
@section('content')

    <div class="col-md-6">
        <div>
            @if ($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" value="{{ $category->name }}" name="name">
            </div>
            <div class="mb-3">
                <label for="">Ảnh danh mục</label>
                <input type="file" class="form-control" onchange="uploadFile()" value="{{ $category->image }}"
                    name="image" id="image_upload">
                <p class="preview-image"><img src="{{ $category->image }}" id="previewImage" alt="">
                </p>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </form>
    </div>

@endsection
