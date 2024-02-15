<?php

namespace App\Http\Controllers\Liability;

use Illuminate\Http\Request;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use App\Models\Liability\Liabilities;

class LiabilityController extends Controller
{
    public function index(Request $request) {
        $EconomicLines = RevenueLine::where('type', 4)->get();
        $liabilities = Liabilities::all()->sortDesc();
        return view('Liability.Liability', compact('liabilities', 'EconomicLines'));
    }

    public function store(Request $request) {

        // dd($request->all());
        $request->validate([
            'revenue_code' => ['required', 'string'],
            'liability' => ['required', 'string'],
            'type_of_liability' => ['required', 'string'],
            'authority_document_ref_no' => ['required', 'string'],
            'amount' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
        ]);

        // dd($request->revenue_code);

        $arr = explode(',', $request->revenue_code);

        Liabilities::insert([
            'economic_code' => $arr[1],
            'liability' => $request->liability,
            'type_of_liability' => $request->type_of_liability,
            'created_by' => $request->created_by,
            'authorize_ref' => $request->authorize_ref,
            'economic_name' => $arr[0],
            'economic_type' => $arr[2],
        ]);

        $notification = array(
            'message' => 'created successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


}
