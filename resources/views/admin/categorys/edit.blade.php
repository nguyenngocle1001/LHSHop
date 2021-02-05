@extends('admin_layout')
@section('title')
    Chỉnh sửa danh mục sản phẩm
@endsection
@section('content')
    <h1 class="mt-4">Chỉnh sửa danh mục sản phẩm</h1>
    <form method="POST" action="{{ route('admin_category_update', $category->Category_Id) }}">
        @csrf
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" value="{{ $category->Category_Name }}" class="form-control" name="name"
                placeholder="Tên danh mục">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <input type="text" value="{{ $category->Category_Desc }}" class="form-control" name="desc"
                placeholder="Mô tả">
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
