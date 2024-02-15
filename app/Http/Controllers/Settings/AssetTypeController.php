<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Asset\AssetType;
use Illuminate\Http\Request;

class AssetTypeController extends Controller
{
    //
    public function index(Request $request) {
        $assetType = AssetType::all();
        return view('Settings.assets.asset_type', compact('assetType'));
    }

    public function store(Request $request) {
        $request->validate([
            'assest_type' => ['required', 'string']
        ]);

        $d = now();
        AssetType::create([
            "assest_type" =>   $request->assest_type,
            "assest_type_description" => $request->assest_type_description,
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
