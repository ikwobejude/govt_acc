<?php

namespace App\Http\Controllers\FinalAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureRegister;
use App\Models\Revenue\Revenue;

class TrialBalanceController extends Controller
{
    public function index(Request $request) {
        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, SUM(revenue_amount) as total")

        ->groupBy('revenue_line')
        ->groupBy('revenue_code')
        ->groupBy('asset_name')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, SUM(amount) as total")
        ->groupBy('expenditure_code')
        ->groupBy('expenditure_type')
        ->groupBy('expenditure_name')
        ->get();


        $arr = [];
        foreach ($revenue as $key => $value) {
            # code...

            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totalcr" => $value->total,
                "totaldb" => '0.00'
            ];
        }

        foreach ($ExpenditureRegister as $key => $value) {
            # code...

            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => $value->total,
                "totalcr" => "0.00"
            ];
        }



        // dd($arr,  $revenue);
        return view('TrialBalance.trial_balance', compact('arr'));
    }
}
