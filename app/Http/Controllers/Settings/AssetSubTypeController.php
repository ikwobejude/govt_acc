<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Asset\AssetType;
use App\Models\Asset\AssetSubType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssetSubTypeController extends Controller
{
    //
    public function index(Request $request) {
        $assetSubType = DB::table("acct_assest_sub_types")
        ->select("acct_assest_sub_types.*", "acct_assest_types.assest_type")
        ->join("acct_assest_types", "acct_assest_types.id", "=", "acct_assest_sub_types.assest_type_id")
        ->get();
        $assetType = AssetType::all();
        // dd($assetSubType);
        return view('Settings.assets.asset_sub_type', compact('assetSubType', 'assetType'));
    }

    public function store(Request $request) {

        // dd($request->all());
        $validateUser = Validator::make($request->all(), [
            'assest_sub_type' => ['required', 'string']
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

        // $d = now();
        AssetSubType::create([
            "assest_sub_type" =>   $request->assest_sub_type,
            "assest_sub_type_description" => $request->assest_sub_type_description,
            "assest_type_id" => $request->asset,
            "service_id" => 37483,
            "created_by" => auth()->user()->email
        ]);

        $notification = array(
            'message' => 'Asset Sub Type Created!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function retrieve(Request $request) {
        $data = DB::table("acct_assest_sub_types")->where("assest_type_id", $request->query("id"))->get();
        return response()->json([
            'message' => 'Hello from the server!',
            "data" =>$data,
            "id" => $request->query("id")
        ]);
    }
}
