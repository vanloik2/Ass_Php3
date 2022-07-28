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
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" value="{{ old('price') }}" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="">Số lượng sản phẩm</label>
                        <input type="number" class="form-control" value="{{ old('quantity') }}" name="quantity">
                    </div>
                    <div class="mb-3">
                        <label for="">Ảnh danh mục</label>
                        <input type="file" class="form-control" value="{{ old('image') }}" name="image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Danh mục sản phẩm</label>
                        <select class="form-select" name="category_id">
                            <option>Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Trạng thái</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1"
                                checked>
                            <label class="form-check-label" for="inlineRadio1">Còn hàng</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="2">
                            <label class="form-check-label" for="inlineRadio1">Hết Hàng</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Mô tả</label>
                        <textarea name="description" class="form-control" id="editor1" rows="5">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </form>
    </div>

@endsection
