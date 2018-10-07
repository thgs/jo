<?php

namespace App\Http\Controllers;

use Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        if (setting('settings_editing_on_json')) {
            $settings = file_get_contents(storage_path('settings.json'));
            
            return view('settings.editor', ['settings' => $settings]);

        } else {
            return view('settings.index');
        }
    }

    public function save(Request $request)
    {
        $json = json_encode(json_decode($request->settings), JSON_PRETTY_PRINT);

        file_put_contents(storage_path('settings.json'), $json);

        return redirect()->route('settings.index');
    }
}
