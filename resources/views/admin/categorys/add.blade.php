@extends('admin_layout')
@section('title')
    Thêm mới danh mục sản phẩm
@endsection
@section('content')
    <h1 class="mt-4">Thêm mới danh mục sản phẩm</h1>
    <form method="POST" action="{{ route('admin_category_store') }}">
        @csrf
        <div class="form-group">
            <label>Tên danh mục</label>
            <input type="text" class="form-control" name="name" placeholder="Tên danh mục">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <input type="text" class="form-control" name="desc" placeholder="Mô tả">
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
