@extends('admin_layout')
@section('title')
    Cài đặt hệ thống
@endsection
@section('content')
    <h1 class="mt-4">Thiết lập hệ thống</h1>
    <form method="POST" action="{{ route('system_save') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên Website</label>
            <input type="text" class="form-control" name="name" placeholder="Tên website">
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" class="form-control" name="address" placeholder="Đia chỉ">
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="tel" class="form-control" name="tel" placeholder="Số điện thoại">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Favicon</label>
            <input type="file" class="form-control-file" name="favicon">
        </div>
        <div class="form-group">
            <label>Logo</label>
            <input type="file" class="form-control-file" name="logo">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
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
