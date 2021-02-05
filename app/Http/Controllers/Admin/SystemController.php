<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemConfig;
use Illuminate\Support\Facades\Session;

class SystemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'tel' => 'required|regex:/(0)[0-9]{8}/',
            'email' => 'required|email',
            'favicon' => 'required',
            'logo' => 'required',
        ], [
            'name.required' => 'Bạn chưa nhập tên website',
            'address.required' => 'Bạn chưa nhập địa chỉ',
            'tel.required' => 'Bạn chưa nhập số điện thoại',
            'tel.regex' => 'Vui lòng nhập đúng số điện thoại',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Vui lòng nhập đúng email',
            'favicon.required' => 'Bạn chưa chọn favicon',
            'logo.required' => 'Bạn chưa chọn logo',
        ]);

        $data = $request->all();
        $system = new SystemConfig();
        $system->Name = $data['name'];
        $system->Address = $data['address'];
        $system->Tel = $data['tel'];
        $system->Email = $data['email'];

        $favicon = $request->file('favicon');
        $faviconName = $favicon->getClientOriginalName();
        $favicon->move('uploads/website', $faviconName);

        $logo = $request->file('logo');
        $logoName = $logo->getClientOriginalName();
        $logo->move('uploads/website', $logoName);

        $system->Favicon = $faviconName;
        $system->Logo = $logoName;
        $system->save();

        Session::put('message', 'Cấu hình hệ thống thành công!');

        return redirect()->route('dashboard');
    }
}