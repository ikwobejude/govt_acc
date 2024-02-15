<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Asset\AssetSizes;
use Illuminate\Http\Request;

class AssetSizeController extends Controller
{
    public function index(Request $request) {
        $assetSize = AssetSizes::where('service_id', 37483)->get();
        return view('Settings.assets.asset_size', compact('assetSize'));
    }

    public function store(Request $request) {
        $request->validate([
            'assest_size' => ['required', 'string']
        ]);

        $d = now();
        AssetSizes::create([
            "assest_size" =>   $request->assest_size,
            "service_id" => 37483,
            "created_by" => auth()->user()->email
        ]);

        $notification = array(
            'message' => 'Asset Type Created!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
