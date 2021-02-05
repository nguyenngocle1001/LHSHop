@extends('admin_layout')
@section('title')
    Sản phẩm
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
                            <th>Kích thước</th>
                            <th>Hình sản phẩm</th>
                            <th style="max-width: 80px; width: 80px">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->Product_Name }}</td>
                                <td><?php echo $product->Product_Desc; ?></td>
                                <td><?php
                                    $productSizesCurrent = [];
                                    foreach ($productSizes as $productSize) {
                                    if ($productSize->Product_Id == $product->Product_Id) {
                                    foreach ($sizes as $size) {
                                    if ($size->Size_Id == $productSize->Size_Id) {
                                    echo '<div><span class="badge badge-pill badge-info">' . $size->Size_Name . '</span>
                                    </div>';
                                    }
                                    }
                                    }
                                    }
                                    ?></td>
                                <td><img class="image__product"
                                        src="/uploads/products/{{ $product->Product_Id }}/{{ $product->Product_Image_1 }}"
                                        alt="">
                                    <img class="image__product"
                                        src="/uploads/products/{{ $product->Product_Id }}/{{ $product->Product_Image_2 }}"
                                        alt="">
                                    <img class="image__product"
                                        src="/uploads/products/{{ $product->Product_Id }}/{{ $product->Product_Image_3 }}"
                                        alt="">
                                </td>
                                <td>
                                    <a href="{{ route('admin_product_edit', $product->Product_Id) }}"><i
                                            class="admin__icon admin__icon--green far fa-edit"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa không?')"
                                        href="{{ route('admin_category_destroy', $product->Product_Id) }}"><i
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
