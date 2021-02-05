@extends('admin_layout')
@section('title')
    Thêm sản phẩm
@endsection
@section('content')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#desc'
        });

    </script>
    <h1 class="mt-4">Thêm sản phẩm</h1>
    <form method="POST" action="{{ route('admin_product_store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm">
        </div>
        <div class="form-group">
            <label>Đơn giá(VNĐ)</label>
            <input type="text" class="form-control" name="price" placeholder="Đơn giá">
        </div>
        <div class="form-group">
            <label>Giảm giá(%)</label>
            <input type="text" class="form-control" name="sale" placeholder="Giảm giá">
        </div>
        <div class="form-group">
            <label>Hình sản phẩm 1</label>
            <input type="file" class="form-control-file" name="image1">
        </div>
        <div class="form-group">
            <label>Hình sản phẩm 2</label>
            <input type="file" class="form-control-file" name="image2">
        </div>
        <div class="form-group">
            <label>Hình sản phẩm 3</label>
            <input type="file" class="form-control-file" name="image3">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label>Đơn vị tính</label>
            <input type="text" class="form-control" name="unit" placeholder="Đơn vị tính">
        </div>
        <div class="form-group">
            <label>Số lượng</label>
            <input type="text" class="form-control" name="quantity" placeholder="Số lượng">
        </div>
        <div class="form-group">
            <label>Danh mục</label>
            <select name="category" class="form-control">
                @foreach ($categorys as $category)
                    <option value="{{ $category->Category_Id }}">{{ $category->Category_Name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>Kích thước</label>
            @foreach ($sizes as $size)
                <div class="form-check">
                    <input class="form-check-input" name="{{ $size->Size_Name }}" type="checkbox"
                        value="{{ $size->Size_Id }}" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        {{ $size->Size_Name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>

        <div class="form-group">
            <?php
            $message = Session::get('message');
            if ($message) {
            echo '<span>' . $message . '</span>';
            Session::put('message', null);
            }
            ?>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
    </form>
@endsection
