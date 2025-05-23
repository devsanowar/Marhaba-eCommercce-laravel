<?php

namespace App\Http\Controllers\Admin;

use App\Models\SmsSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsSettingController extends Controller
{
    public function edit()
    {
        $setting = SmsSetting::first(); // একটাই row থাকবে ধরে নিচ্ছি
        return view('admin.layouts.pages.sms-settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'api_url'     => 'required|url',
            'api_key'     => 'required',
            'api_secret'  => 'required',
            'request_type' => 'required',
            'message_type' => 'required',
        ]);

        $setting = SmsSetting::first();

        $setting->update([
            'api_url'     => $request->api_url,
            'api_key'     => $request->api_key,
            'api_secret'  => $request->api_secret,
            'request_type' => $request->request_type,
            'message_type' => $request->message_type,
            'is_active'   => $request->has('is_active'),
        ]);

        return back()->with('success', 'SMS Settings updated successfully!');
    }
}
