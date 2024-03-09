<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Asset\AssetSizes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AssetSizeController extends Controller
{
    public function index(Request $request) {
        $assetSize = AssetSizes::where('service_id', 37483)->get();
        return view('Settings.assets.asset_size', compact('assetSize'));
    }

    public function store(Request $request) {
        $validateUser = Validator::make($request->all(), [
            'assest_size' => ['required', 'string']
        ]);


        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

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
