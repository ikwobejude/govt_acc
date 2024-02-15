<?php

namespace App\Http\Controllers\Asset;

use App\Models\Asset\Assets;
use Illuminate\Http\Request;
use App\Models\Asset\AssetType;
use App\Models\Asset\AssetSizes;
use App\Models\Asset\AssetValues;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Asset\AssetCategories;

class AssetController extends Controller
{
    public function index(Request $request) {

        $categories = AssetCategories::all();
        $types = AssetType::all();
        $sizes = AssetSizes::all();
        $asset_values = AssetValues::all();
        $revenue_lines = DB::table('revenue_line')->where('type', 3)->get();

        $assets = Assets::latest()
        ->select('acct_assests.*', 'acct_assest_categories.assest_category', 'acct_assest_types.assest_type', 'acct_assest_sizes.assest_size' )
        ->leftJoin('acct_assest_categories', 'acct_assest_categories.assest_category_id', 'acct_assests.assest_category_id')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->leftJoin('acct_assest_sizes', 'acct_assest_sizes.id', 'acct_assests.assest_size_id')
        ->where('acct_assests.service_id', 37483)->get();
        

        return view('AccAsset.acc_asset', compact('categories', 'types', 'sizes', 'asset_values', 'assets', 'revenue_lines'));

    }

    public function store(Request $request) {



        $request->validate([
            'revenue_code' => ['required', 'string'],
            'asset_type' => ['required', 'string'],
            'assest_name' => ['required', 'string'],
            // 'authority_document_ref_no' => ['required', 'string'],
            'date_purchased' => ['required', 'string'],
            'opening_value' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'asset_category'  => ['required', 'string'],
            'asset_size'  => ['required', 'string'],
        ]);

        $arr = explode(',', $request->revenue_code);
        // dd($arr);


        Assets::insert([
            'assest_type_id' => $request->asset_type,
            'assest_category_id' => $request->asset_category,
            'assest_size_id' => $request->asset_size,
            // 'assest_location_id' => $request->
            'assest_name' => $request->assest_name,
            'assest_decription' => $request->assest_decription,
            'date_purchased' => $request->date_purchased,
            'service_id' => 37483,
            'created_by' => auth()->user()->email,
            'opening_value' => $request->opening_value,
            'asset_rev_type' => $arr[2],
            'asset_rev_name' => $arr[0],
            'asset_rev' => $arr[1]
        ]);

        $notification = array(
            'message' => 'Asset detail saved!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
