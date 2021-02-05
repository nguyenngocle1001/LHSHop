@extends('admin_layout')
@section('title')
    Danh mục sản phẩm
@endsection
@section('content')
    <h1 class="mt-4">Danh mục sản phẩm</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Danh mục sản phẩm</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Danh mục sản phẩm
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th style="max-width: 80px; width: 80px">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $size)
                            <tr>
                                <td>{{ $size->Size_Name }}</td>
                                <td>{{ $size->Size_Desc }}</td>
                                <td>
                                    <a href="{{ route('admin_size_edit', $size->Size_Id) }}"><i
                                            class="admin__icon admin__icon--green far fa-edit"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa không?')"
                                        href="{{ route('admin_size_destroy', $size->Size_Id) }}"><i
                                            class="admin__icon admin__icon--red far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
