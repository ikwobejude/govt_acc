<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Asset\AssetCategories;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index(Request $request) {
        $assetCategory = AssetCategories::where('service_id', 37483)->get();
        return view('Settings.assets.asset_cateogries', compact('assetCategory'));
    }

    public function store(Request $request) {
        $request->validate([
            'assest_category' => ['required', 'string']
        ]);


        // dd($request->all());

        // $d = now();
        AssetCategories::create([
            "assest_category" =>   $request->assest_category,
            "assest_category_description" => $request->assest_category_description,
            "service_id" => 37483,
            "created_by" => auth()->user()->email
        ]);

        $notification = array(
            'message' => 'Asset Categories Created!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
