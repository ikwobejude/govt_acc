<?php

namespace App\Http\Controllers\Liability;

use Illuminate\Http\Request;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use App\Models\Liability\Liabilities;
use Illuminate\Support\Facades\DB;

class LiabilityController extends Controller
{
    public function index(Request $request) {
        $revenue_code = $request->query('revenue_code');
        $liability = $request->query('liability');
        $type_of_liability = $request->query('type_of_liability');
        $authorize_ref = $request->query('authority_document_ref_no');
        $from = $request->query('from');
        $to = $request->query('to');
        $approvalLevels = $request->query('approvalLevels');

        $EconomicLines = RevenueLine::where('type', 4)->get();
        $liabilities = DB::table('liabilities')
        ->when($revenue_code, function ($query, string $revenue_code) {
            $query->where('economic_code', $revenue_code);
        })
        ->when($liability, function ($query, string $liability) {
            $query->where('liability', 'like', "%{$liability}%");
        })
        ->when($type_of_liability, function ($query, string $type_of_liability) {
            $query->where('type_of_liability', $type_of_liability);
        })
        ->when($authorize_ref, function ($query, string $authorize_ref) {
            $query->where('authorize_ref', $authorize_ref);
        })
        ->when($approvalLevels, function ($query, string $approvalLevels) {
            $query->where('approved', $approvalLevels);
        })
        ->when($from, function ($query, string $from) {
            $query->whereDate('created_at', '>=', $from);
        })
        ->when($to, function ($query, string $to) {
            $query->whereDate('created_at', '<=', $to);
        })
        ->get();
        // Liabilities::all()->sortDesc();
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
