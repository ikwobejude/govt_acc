<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\Asset\AssetType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AssetTypeController extends Controller
{
    //
    public function index(Request $request) {
        $assetType = AssetType::all();
        return view('Settings.assets.asset_type', compact('assetType'));
    }

    public function store(Request $request) {
        $validateUser = Validator::make($request->all(), [
            'assest_type' => ['required', 'string']
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

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


    public function edit(Request $request) {
        $validateUser = Validator::make($request->all(), [
            'assest_type' => ['required', 'string']
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

        $d = now();
        AssetType::where('id', $request->id)->update([
            "assest_type" =>   $request->assest_type,
            "assest_type_description" => $request->assest_type_description
        ]);

        $notification = array(
            'message' => 'Asset Type Update!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function destroy($id) {

        $AssetType = AssetType::find($id);
        $AssetType->delete();

        $notification = array(
            'message' => 'Asset Type Delete!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
