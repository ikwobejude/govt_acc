<?php

namespace App\Http\Controllers\Revenue;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Revenue\Revenue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class RevenueController extends Controller
{
    public function index(Request $request) {
        $revenues = DB::table('acc_revenue')->get();
        $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
        return view('Revenue.revenue', compact('revenues','revenue_lines'));
    }

    public function store(Request $request) {
    //    try {
        // dd($request->rrr_input_field);
        $request->validate([
            'revenue_code' =>['required', 'string', 'max:255'],
            'received_from' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'revenue_amount' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'settlement_date' => ['required', 'string', 'max:255'],
            // 'rrr' => Rule::requiredIf($request->rrr_input_field == "on"),
        ]);

        if($request->rrr_status && empty($request->rrr)) {
            $notification = array(
                'message' => "RRR field cannot be empty",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


            $d = now();
            $carbon = Carbon::parse($d);
            $day = $carbon->day;
            $year = $d->format('Y');
            $month = $d->format('F');
            $arr = explode(',', $request->revenue_code);
            // dd($arr);
        // dd($month);

        Revenue::create([
            "revenue_code" => $arr[1],
            "revenue_line" => $arr[0],
            "asset_name" => $arr[2],
            "received_from" => $request->received_from,
            "authority_document_ref_no" => $request->authority_document_ref_no,
            "description" => $request->description,
            "revenue_amount" => $request->revenue_amount,
            "revenue_amount_paid" => $request->revenue_amount,
            "settlement_status" => 1,
            "settlement_date" => $request->settlement_date,
            "tax_year" => $year,
            "day" => $day,
            "month" => $month,
            "year" => $year,
            'rrr_status' => $request->rrr_input_field == "on" ? 1 : 0,
            'rrr',
            "service_id" => 37483
        ]);

        // Notification
        $notification = array(
            'message' => 'Revenue saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    //    } catch (\Throwable $th) {
    //     //throw $th;
    //     // Notification
    //     $notification = array(
    //         'message' => $th->getMessage(),
    //         'alert-type' => 'error'
    //     );
    //     return redirect()->back()->with($notification);
    //    }

    }
}
