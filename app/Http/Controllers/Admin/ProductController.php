<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Size;
use App\Models\Product;
use App\Models\Product_Size;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('Product_Status', 1)->get();
        $sizes = Size::where('Size_Status', 1)->get();
        $productSizes = Product_Size::all();
        return view('admin.products.index', compact('products', 'sizes', 'productSizes'));
    }

    public function create()
    {
        $categorys = Category::where('Category_Status', 1)->get();
        $sizes = Size::where('Size_Status', 1)->get();
        return view('admin.products.add', compact('categorys', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'sale' => 'required|numeric|min:0|max:100',
            'image1' => 'required|image',
            'image2' => 'required|image',
            'image3' => 'required|image',
            'desc' => 'required',
            'unit' => 'required',
            'quantity' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Bạn chưa nhập tên sản phẩm',
            'price.required' => 'Bạn chưa nhập giá sản phẩm',
            'price.numeric' => 'Giá tiền phải là số',
            'price.min' => 'Giá tiền nhỏ nhất phải bằng 0',
            'sale.required' => 'Bạn chưa nhập giảm giá sản phẩm',
            'sale.numeric' => 'Giảm giá phải là số',
            'sale.min' => 'Giảm giá nhỏ nhất phải bằng 0',
            'sale.max' => 'Giảm giá lớn nhất phải bằng 100',
            'image1.required' => 'Bạn chưa chọn hình sản phẩm thứ 1',
            'image1.image' => 'Hình sản phẩm thứ 1 phải chọn hình',
            'image2.required' => 'Bạn chưa chọn hình sản phẩm thứ 2',
            'image2.image' => 'Hình sản phẩm thứ 2 phải chọn hình',
            'image3.required' => 'Bạn chưa chọn hình sản phẩm thứ 3',
            'image3.image' => 'Hình sản phẩm thứ 3 phải chọn hình',
            'desc.required' => 'Bạn chưa nhập mô tả sản phẩm',
            'unit.required' => 'Bạn chưa nhập đơn vị tính',
            'quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
            'quantity.numeric' => 'Số lượng sản phẩm phải là số',
            'quantity.min' => 'Số lượng nhỏ nhất phải bằng 1',
        ]);
        $data = $request->all();

        $image1 = $request->file('image1');
        $image1Name = $image1->getClientOriginalName();
        $image2 = $request->file('image2');
        $image2Name = $image2->getClientOriginalName();
        $image3 = $request->file('image3');
        $image3Name = $image3->getClientOriginalName();

        //Thêm sản phẩm
        $product = new Product();
        $product->Product_Name = $data['name'];
        $product->Product_Price = $data['price'];
        $product->Product_Sale = $data['sale'];
        $product->Product_Image_1 = $image1Name;
        $product->Product_Image_2 = $image2Name;
        $product->Product_Image_3 = $image3Name;
        $product->Product_Desc = $data['desc'];
        $product->Product_Unit = $data['unit'];
        $product->Product_Quantity = $data['quantity'];
        $product->Product_Rating = 0;
        $product->Product_Status = 1;
        $product->Category_Id = $data['category'];

        $product->save();

        $image1->move('uploads/products/' . $product->Product_Id, $image1Name);
        $image2->move('uploads/products/' . $product->Product_Id, $image2Name);
        $image3->move('uploads/products/' . $product->Product_Id, $image3Name);

        $sizes = Size::where('Size_Status', 1)->get();
        foreach ($sizes as $size) {
            if (isset($data[$size->Size_Name])) {
                $productSize = new Product_Size();
                $productSize->Product_Id = $product->Product_Id;
                $productSize->Size_Id = $data[$size->Size_Name];
                $productSize->save();
            }
        }

        Session::put('message', 'Đã thêm thành công');
        $categorys = Category::where('Category_Status', 1)->get();
        return view('admin.products.add', compact('categorys', 'sizes'));
    }

    public function edit($id)
    {
        $categorys = Category::where('Category_Status', 1)->get();
        $sizes = Size::where('Size_Status', 1)->get();
        $product = Product::where('Product_Id', $id)->first();
        $productSizes = Product_Size::where('Product_Id', $id)->get();
        $arrSizeChecked = array();
        foreach ($productSizes as $productSize) {
            array_push($arrSizeChecked, $productSize->Size_Id);
        }
        return view('admin.products.edit', compact('categorys', 'sizes', 'product', 'arrSizeChecked'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'sale' => 'required|numeric|min:0|max:100',
            'desc' => 'required',
            'unit' => 'required',
            'quantity' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Bạn chưa nhập tên sản phẩm',
            'price.required' => 'Bạn chưa nhập giá sản phẩm',
            'price.numeric' => 'Giá tiền phải là số',
            'price.min' => 'Giá tiền nhỏ nhất phải bằng 0',
            'sale.required' => 'Bạn chưa nhập giảm giá sản phẩm',
            'sale.numeric' => 'Giảm giá phải là số',
            'sale.min' => 'Giảm giá nhỏ nhất phải bằng 0',
            'sale.max' => 'Giảm giá lớn nhất phải bằng 100',
            'desc.required' => 'Bạn chưa nhập mô tả sản phẩm',
            'unit.required' => 'Bạn chưa nhập đơn vị tính',
            'quantity.required' => 'Bạn chưa nhập số lượng sản phẩm',
            'quantity.numeric' => 'Số lượng sản phẩm phải là số',
            'quantity.min' => 'Số lượng nhỏ nhất phải bằng 1',
        ]);
        $data = $request->all();

        $image1 = $request->file('image1');
        $image2 = $request->file('image2');
        $image3 = $request->file('image3');

        //Thêm sản phẩm
        $product = Product::where('Product_Id', $id)->first();
        $product->Product_Name = $data['name'];
        $product->Product_Price = $data['price'];
        $product->Product_Sale = $data['sale'];
        $product->Product_Desc = $data['desc'];
        $product->Product_Unit = $data['unit'];
        $product->Product_Quantity = $data['quantity'];
        $product->Category_Id = $data['category'];

        if ($image1) {
            $image1Name = $image1->getClientOriginalName();
            $product->Product_Image_1 = $image1Name;
            $image1->move('uploads/products/' . $product->Product_Id, $image1Name);
        }

        if ($image2) {
            $image2Name = $image2->getClientOriginalName();
            $product->Product_Image_2 = $image2Name;
            $image2->move('uploads/products/' . $product->Product_Id, $image2Name);
        }

        if ($image3) {
            $image3Name = $image3->getClientOriginalName();
            $product->Product_Image_3 = $image3Name;
            $image3->move('uploads/products/' . $product->Product_Id, $image3Name);
        }

        $product->save();

        Product_Size::where('Product_Id', $id)->delete();

        $sizes = Size::where('Size_Status', 1)->get();
        foreach ($sizes as $size) {
            if (isset($data[$size->Size_Name])) {
                $productSize = new Product_Size();
                $productSize->Product_Id = $product->Product_Id;
                $productSize->Size_Id = $data[$size->Size_Name];
                $productSize->save();
            }
        }

        Session::put('message', 'Đã chỉnh sửa thành công');

        return redirect()->route('admin_product');
    }
}