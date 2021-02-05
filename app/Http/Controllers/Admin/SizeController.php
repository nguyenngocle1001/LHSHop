<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Session;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::where('Size_Status', 1)->get();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên size',
            'desc.required' => 'Bạn chưa nhập mô tả size',
        ]);
        $data = $request->all();
        $size = Size::where('Size_Name', $data['name'])->count();
        if ($size > 0) {
            $message = 'Tên size đã tồn tại';
        } else {
            $size = new Size();
            $size->Size_Name = $data['name'];
            $size->Size_Desc = $data['desc'];
            $size->Size_Status = 1;
            $size->save();
            $message = 'Đã thêm danh mục ' . $size->Size_Name . ' thành công!';
        }
        Session::put('message', $message);

        return redirect()->route('admin_size_create');
    }

    public function edit($id)
    {
        $size = Size::where('Size_Id', $id)->first();
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên size',
            'desc.required' => 'Bạn chưa nhập mô tả size',
        ]);
        $data = $request->all();
        $size = Size::where('Size_Id', '<>', $id)->where('Size_Name', $data['name'])->count();
        if ($size > 0) {
            $message = 'Tên size đã tồn tại';
        } else {
            $size = Size::where('Size_Id', $id)->first();
            $size->Size_Name = $data['name'];
            $size->Size_Desc = $data['desc'];
            $size->save();
            Session::put('message', 'Đã chỉnh sửa thành công');
            return redirect()->route('admin_size');
        }
        Session::put('message', $message);

        return redirect()->route('admin_size_create');
    }

    public function destroy($id)
    {
        $size = Size::where('Size_Id', $id)->first();
        $size->Size_Status = 0;
        $size->save();
        return redirect()->route('admin_size');
    }
}