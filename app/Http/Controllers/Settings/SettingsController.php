<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(Request $request) {
        $revenue_lines = DB::table('revenue_line')->where("type", 1)->paginate(20);
        // dd($revenue_lines,  auth()->user()->name);
        return view('Settings.revenue_line', compact('revenue_lines'));
    }

    // create revenue line

    public function store(Request $request) {
        // dd($request->all());
        // validate input data
        $validateUser = Validator::make($request->all(),[
            'revenue_line' => ['required', 'string', 'max:255'],
            'revenue_code' =>['required', 'string', 'max:255'],
            'type' =>['required', 'string'],
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

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

    public function edit(Request $request) {
        // dd($request->all());
        // validate input data
        try {
            $validateUser = Validator::make($request->all(),[
                'revenue_line' => ['required', 'string', 'max:255'],
                'revenue_code' =>['required', 'string', 'max:255'],
                'type' =>['required', 'string'],
            ]);

            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }

            // create revenue code
            RevenueLine::where("id", $request->id)->update([
                'description' => $request->revenue_line,
                'economic_code' => $request->revenue_code,
                'type' => $request->type
            ]);

            // Notification
            $notification = array(
                'message' => 'Revenue line update successfully',
                'alert-type' => 'success'
            );
            return redirect('/settings/revenue_line')->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                'message' => $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect('/settings/revenue_line')->with($notification);
        }

    }

    public function destroy($id) {
        // User::where('votes', '>', 100)->delete();
        $revenue = RevenueLine::find($id);

        $revenue->delete();
        $notification = array(
            'message' => 'Revenue line deleted successfully',
            'alert-type' => 'success'
        );
        return redirect('/settings/revenue_line')->with($notification);
    }


    public function indexExp(Request $request) {
        $revenue_lines = DB::table('revenue_line')->where("type", 2)->paginate(20);
        // dd($revenue_lines,  auth()->user()->name);
        return view('Settings.expenditure_line', compact('revenue_lines'));
    }

    public function indexAsset(Request $request) {
        $revenue_lines = DB::table('revenue_line')->where("type", 3)->paginate(20);
        // dd($revenue_lines,  auth()->user()->name);
        return view('Settings.asset_line', compact('revenue_lines'));
    }

    public function indexLiability(Request $request) {
        $revenue_lines = DB::table('revenue_line')->where("type", 4)->paginate(20);
        // dd($revenue_lines,  auth()->user()->name);
        return view('Settings.liability_line', compact('revenue_lines'));
    }
}
