<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $title = "Setting";
        $setting = Setting::first();
        return view("admin.pages.setting.index", compact("title", "setting"));
    }

    public function update(Request $request)
    {
        Setting::find(1)->update($request->all());
        return back()->with("success", "Save setting successfully");
    }
}
