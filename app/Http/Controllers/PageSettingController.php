<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSetting;

class PageSettingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string',
            'settings' => 'required|array',
        ]);

        $setting = PageSetting::updateOrCreate(
            [
                'page_name' => $request->page_name,
            ],
            [
                'settings' => $request->settings
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Page settings saved successfully',
            'data' => $setting
        ]);
    }
}
