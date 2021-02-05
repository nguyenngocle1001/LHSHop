<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::where('Category_Status', 1)->get();
        return view('admin.categorys.index', compact('categorys'));
    }

    public function create()
    {
        return view('admin.categorys.add');
    }

    public function edit($id)
    {
        $category = Category::where('Category_Id', $id)->first();
        return view('admin.categorys.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'desc.required' => 'Bạn chưa nhập mô tả danh mục',
        ]);
        $data = $request->all();
        $category = Category::where('Category_Name', $data['name'])->count();
        if ($category > 0) {
            $message = 'Tên danh mục đã tồn tại';
        } else {
            $category = new Category();
            $category->Category_Name = $data['name'];
            $category->Category_Desc = $data['desc'];
            $category->Category_Status = 1;
            $category->save();
            $message = 'Đã thêm danh mục ' . $category->Category_Name . ' thành công!';
        }
        Session::put('message', $message);

        return redirect()->route('admin_category_create');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'desc.required' => 'Bạn chưa nhập mô tả danh mục',
        ]);
        $data = $request->all();
        $category = Category::Where('Category_Id', '<>', $id)->where('Category_Name', $data['name'])->count();
        if ($category > 0) {
            $message = 'Tên danh mục đã tồn tại';
        } else {
            $category = Category::Where('Category_Id', $id)->first();
            $category->Category_Name = $data['name'];
            $category->Category_Desc = $data['desc'];
            $category->save();
            Session::put('message', 'Đã sửa danh mục thành công!');
            return redirect()->route('admin_category');
        }
        Session::put('message', $message);

        return back();
    }

    public function destroy($id)
    {
        $category = Category::where('Category_Id', $id)->first();
        $category->Category_Status = 0;
        $category->save();
        return redirect()->route('admin_category');
    }
}