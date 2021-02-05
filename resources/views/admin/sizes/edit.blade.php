@extends('admin_layout')
@section('title')
    Chỉnh sửa size
@endsection
@section('content')
    <h1 class="mt-4">Chỉnh sửa size</h1>
    <form method="POST" action="{{ route('admin_size_update', $size->Size_Id) }}">
        @csrf
        <div class="form-group">
            <label>Tên size</label>
            <input type="text" value="{{ $size->Size_Name }}" class="form-control" name="name" placeholder="Tên danh mục">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <input type="text" value="{{ $size->Size_Desc }}" class="form-control" name="desc" placeholder="Mô tả">
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
