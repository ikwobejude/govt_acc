<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Asset\AssetLocation;
use App\Models\Location\State;
use Illuminate\Http\Request;

class AssetLocationController extends Controller
{
    public function index(Request $request) {
        $state = State::all();
        $asset_location = AssetLocation::all();

        return view('Settings.assets.asset_location', compact('state', 'asset_location'));
    }
}
