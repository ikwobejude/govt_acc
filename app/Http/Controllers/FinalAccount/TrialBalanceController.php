<?php

namespace App\Http\Controllers\FinalAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureRegister;
use App\Models\Revenue\Revenue;
use Carbon\Carbon;

class TrialBalanceController extends Controller
{
    public function index(Request $request) {

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->whereYear('created_at', Carbon::now()->year)
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, SUM(revenue_amount) as total")

        ->groupBy('revenue_line')
        ->groupBy('revenue_code')
        ->groupBy('asset_name')

        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->whereYear('created_at', Carbon::now()->year)
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, SUM(amount) as total")
        ->groupBy('expenditure_code')
        ->groupBy('expenditure_type')
        ->groupBy('expenditure_name')
        ->get();

        $assets = DB::table('acct_assests')
        ->whereYear('created_at', Carbon::now()->year)
        ->where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("asset_rev_type as uniId, asset_rev as code, asset_rev_name  as line, SUM(opening_value) as total")
        ->groupBy('asset_rev')
        ->groupBy('asset_rev_type')
        ->groupBy('asset_rev_name')
        ->get();

        $liability = DB::table('liabilities')
        // ->where('service_id',37483)
        ->whereYear('created_at', Carbon::now()->year)
        ->where('approved', 2)
        ->selectRaw("economic_type as uniId, economic_code as code, economic_name  as line, SUM(amount) as total")
        ->groupBy('economic_code')
        ->groupBy('economic_type')
        ->groupBy('economic_name')
        ->get();


        $arr = [];
        foreach ($revenue as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totalcr" => $value->total,
                "totaldb" => '0.00'
            ];
        }

        foreach ($ExpenditureRegister as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => $value->total,
                "totalcr" => "0.00"
            ];
        }

        foreach ($assets as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => $value->total,
                "totalcr" => "0.00"
            ];
        }

        foreach ($liability as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => "0.00",
                "totalcr" => $value->total
            ];
        }

        $today = Carbon::today();





        // dd($arr,  $revenue);
        return view('TrialBalance.trial_balance', compact('arr', 'today'));
    }

    public function downloadExcel(Request $request) {

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->whereYear('created_at', Carbon::now()->year)
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, SUM(revenue_amount) as total")
        ->groupBy('revenue_line')
        ->groupBy('revenue_code')
        ->groupBy('asset_name')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->whereYear('created_at', Carbon::now()->year)
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, SUM(amount) as total")
        ->groupBy('expenditure_code')
        ->groupBy('expenditure_type')
        ->groupBy('expenditure_name')
        ->get();

        $assets = DB::table('acct_assests')
        ->whereYear('created_at', Carbon::now()->year)
        ->where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("asset_rev_type as uniId, asset_rev as code, asset_rev_name  as line, SUM(opening_value) as total")
        ->groupBy('asset_rev')
        ->groupBy('asset_rev_type')
        ->groupBy('asset_rev_name')
        ->get();

        $liability = DB::table('liabilities')
        ->whereYear('created_at', Carbon::now()->year)
        ->where('approved', 2)
        ->selectRaw("economic_type as uniId, economic_code as code, economic_name  as line, SUM(amount) as total")
        ->groupBy('economic_code')
        ->groupBy('economic_type')
        ->groupBy('economic_name')
        ->get();


        $arr = [];
        foreach ($revenue as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totalcr" => $value->total,
                "totaldb" => '0.00'
            ];
        }

        foreach ($ExpenditureRegister as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => $value->total,
                "totalcr" => "0.00"
            ];
        }

        foreach ($assets as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => $value->total,
                "totalcr" => "0.00"
            ];
        }

        foreach ($liability as $key => $value) {
            $arr[] = [
                "economic_code" => $value->code,
                "revenue_line" => $value->line,
                "economic_type" => $value->uniId,
                "totaldb" => "0.00",
                "totalcr" => $value->total
            ];
        }

        $today = Carbon::today();

        // dd($arr,  $revenue);
        return view('TrialBalance.download_trial_balance', compact('arr', 'today'));
    }
}
