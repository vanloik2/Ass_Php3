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
        <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" value="{{ $product->name }}" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" value="{{ $product->price }}" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="">Số lượng sản phẩm</label>
                        <input type="number" class="form-control" value="{{ $product->quantity }}" name="quantity">
                    </div>
                    <div class="mb-3">
                        <label for="">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" onchange="uploadFile()" value="{{ $product->avatar }}"
                            name="image" id="image_upload">
                        <p class="preview-image"><img src=" {{ asset($product->image) }}" id="previewImage" alt="">
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Danh mục sản phẩm</label>
                        <select class="form-select" name="category_id">
                            <option>Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                @if ($category->id == $product->category_id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Trạng thái</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1"
                                @checked($product->status === 1)>
                            <label class="form-check-label" for="inlineRadio1">Hoạt động</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="2"
                                @checked($product->status === 2)>
                            <label class="form-check-label" for="inlineRadio1">Không hoạt động</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả</label>
                        <textarea name="description" class="form-control" id="editor1" rows="5">{{ $product->description }}</textarea>
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
