<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Revenue\RevenueLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index(Request $request) {
        $revenue_lines = DB::table('revenue_line')->paginate(20);
        // dd($revenue_lines,  auth()->user()->name);
        return view('Settings.revenue_line', compact('revenue_lines'));
    }

    // create revenue line

    public function store(Request $request) {
        // dd($request->all());
        // validate input data
        $request->validate([
            'revenue_line' => ['required', 'string', 'max:255'],
            'revenue_code' =>['required', 'string', 'max:255'],
            'type' =>['required', 'string'],
        ]);

        // create revenue code
        RevenueLine::create([
            'description' => $request->revenue_line,
            'economic_code' => $request->revenue_code,
            'type' => $request->type
        ]);

        // Notification
        $notification = array(
            'message' => 'Revenue line created successfully',
            'alert-type' => 'success'
        );
        return redirect('/settings/revenue_line')->with($notification);
    }
}
