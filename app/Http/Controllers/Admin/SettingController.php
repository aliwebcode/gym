<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first();
        if($settings)
            $settings->update($request->except('_token'));
        else
            $settings = Setting::create($request->except('_token'));
        return redirect()->route('admin.settings.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }
}
