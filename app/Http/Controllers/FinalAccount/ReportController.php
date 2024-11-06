<?php

namespace App\Http\Controllers\FinalAccount;

use Carbon\Carbon;
use App\Models\Asset\Assets;
use Illuminate\Http\Request;
use App\Models\Revenue\Revenue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureRegister;

use function Laravel\Prompts\select;

class ReportController extends Controller
{
    public function financialPerformance(Request $request) {
        $from = $request->query("from") ? $request->query("from") :  Carbon::now()->startOfYear();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        // dd($from, $to);

        $revenue =  DB::table('acc_revenue')
        ->select([
            'acc_revenue.revenue_line as line',
            'acc_revenue.revenue_code as code',
            'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acc_revenue.revenue_amount) as total'),
            'revenue_line.note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acc_revenue.revenue_code')
        ->where('acc_revenue.approved', 2)
        ->whereIn('revenue_line.note', [6, 7])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acc_revenue.created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note')
        ->orderBy('revenue_line.note', 'ASC')
        ->get();

        // dd($revenue);

        // $ExpenditureRegister = DB::table('expenditure_payregister')
        // ->select([
        //     'expenditure_payregister.expenditure_type as uniId',
        //     'expenditure_payregister.expenditure_code as CODE',
        //     'expenditure_payregister.expenditure_name as line',
        //     DB::raw('SUM(expenditure_payregister.amount) as total'),
        //     'revenue_line.note as note',
        // ])
        // ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        // ->where('expenditure_payregister.approved', 2)
        // ->whereIn('revenue_line.note', [9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23])
        // ->when(!empty($from), function ($query) use ($from) {
        //     return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        // })
        // ->when(!empty($to), function ($query) use ($to) {
        //    return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        // })
        // ->groupBy('revenue_line.note')
        // ->orderBy('revenue_line.note', 'ASC')
        // ->get();


        $ExpenditureRegister = DB::table('expenditure_payregister')
        ->select([
            DB::raw("
                CASE
                    WHEN revenue_line.note = 9 THEN 'Personnel Cost'
                    WHEN revenue_line.note BETWEEN 10 AND 23 THEN 'Administrative Expenses'
                    ELSE 'Other'
                END as note_group
            "),
            'expenditure_payregister.expenditure_type as uniId',
            'expenditure_payregister.expenditure_code as CODE',
            'expenditure_payregister.expenditure_name as line',
            DB::raw('SUM(expenditure_payregister.amount) as total')
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        ->where('expenditure_payregister.approved', 2)
        ->whereIn('revenue_line.note', [9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->groupBy('note_group')
        ->orderBy('note_group', 'ASC')
        ->get();

    // dd($ExpenditureRegister);



        return view('GeneralLedger.financial_performace', compact('revenue', 'ExpenditureRegister', 'currentT', 'from', 'to'));
    }

    public function downloadFinancialPerformance(Request $request) {
        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();


        return view('GeneralLedger.download_financial_performace', compact('revenue', 'ExpenditureRegister', 'currentT', 'from', 'to'));
    }

    public function cashFlow(Request $request) {

        $from = $request->query("from") ? $request->query("from") :  Carbon::now()->startOfYear();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $revenue = Revenue::Where('service_id',37483)
        ->select([
            'acc_revenue.revenue_line as line',
            'acc_revenue.revenue_code as code',
            'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acc_revenue.revenue_amount) as total'),
            'revenue_line.note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acc_revenue.revenue_code')
        ->where('acc_revenue.approved', 2)
        ->whereIn('revenue_line.note', [6, 7])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acc_revenue.created_at', '<=', $to);
        })

        // ->selectRaw("acc_revenue.revenue_line as line, acc_revenue.revenue_code as code, acc_revenue.asset_name as uniId, acc_revenue.revenue_amount as total, revenue_line.note")
        // ->groupBy('acc_revenue.revenue_code')
        ->groupBy('revenue_line.note')
        ->orderBy('revenue_line.note', 'ASC')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::where('expenditure_payregister.service_id', 37483)
            ->select([
                'expenditure_payregister.expenditure_type as uniId',
                'expenditure_payregister.expenditure_code as code',
                'expenditure_payregister.expenditure_name as line',
                DB::raw('SUM(expenditure_payregister.amount) as total'),
                DB::raw("CASE
                            WHEN revenue_line.note BETWEEN 12 AND 23 THEN '12-23'
                            ELSE CAST(revenue_line.note AS CHAR)
                        END as note_group") // Group notes from 12 to 23
            ])
            ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
            ->where('expenditure_payregister.approved', 2)
            ->whereIn('revenue_line.note', [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23])
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
            })
            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
            })
            ->groupBy('note_group') // Group by the newly created note group
            ->orderBy('note_group', 'ASC')
            ->get();

        $asset = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            // 'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('approved', 2)
        ->whereIn('revenue_line.note', [3])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note')
        // ->selectRaw('acct_assests.assest_name AS line, acct_assests.asset_rev AS code, acct_assests.asset_rev_type, acct_assest_types.assest_type, acct_assests.opening_value as total')
        // ->groupBy('assest_type_id')

        ->get();

        $capital_grant = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            // 'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('approved', 2)
        ->whereIn('revenue_line.note', [8])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note')
        // ->selectRaw('acct_assests.assest_name AS line, acct_assests.asset_rev AS code, acct_assests.asset_rev_type, acct_assest_types.assest_type, acct_assests.opening_value as total')
        // ->groupBy('assest_type_id')

        ->get();

        $fixed_asset = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            // 'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('approved', 2)
        ->where('acct_assest_types.id', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->groupBy('acct_assest_types.id')

        ->get();

        // dd($fixed_asset);

        $account_parables = DB::table('liabilities')
        ->select([
            'liabilities.liability AS line',
            'liabilities.economic_code AS code',
            'liabilities.type_of_liability',
            DB::raw('SUM(liabilities.amount) as total'),
            'revenue_line.note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'liabilities.economic_code')
        ->where('approved', 2)
        ->whereIn('revenue_line.note', [5])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note')
        ->get();

        // dd($account_parables);
        $liability = DB::table('liabilities')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw('liabilities.liability AS line, liabilities.economic_code AS code, liabilities.type_of_liability, liabilities.amount as total')
        ->get();

        // dd($arr,  $revenue);
        return view('GeneralLedger.cash_flow', compact('revenue', 'ExpenditureRegister', 'asset', 'liability', 'currentT', 'to', 'from', 'account_parables', 'capital_grant', 'fixed_asset'));
    }

    public function downloadCCashFlow(Request $request) {

        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();

        $asset = DB::table('acct_assests')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->selectRaw('acct_assests.assest_name AS line, acct_assests.asset_rev AS code, acct_assests.asset_rev_type, acct_assest_types.assest_type, acct_assests.opening_value as total')
        // ->groupBy('assest_type_id')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->get();

        // dd($asset);

        $liability = DB::table('liabilities')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw('liabilities.liability AS line, liabilities.economic_code AS code, liabilities.type_of_liability, liabilities.amount as total')
        // ->groupBy('liabilities.type_of_liability')
        ->get();

        // dd($arr,  $revenue);
        return view('GeneralLedger.download_cash_flow', compact('revenue', 'ExpenditureRegister', 'asset', 'liability', 'currentT', 'to', 'from'));
    }


    public function note_financial_disclosure(Request $request){
        $from = $request->query("from") ? $request->query("from") :  Carbon::now()->startOfYear();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;
        $intangibles = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type',
            'acct_assests.action_type',
            'acct_assests.asset_input_category'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('approved', 2)
        ->whereIn('revenue_line.note', [2])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->groupBy('acct_assests.asset_input_category')
        ->groupBy('acct_assests.action_type')

        ->get();
        $previous_year_asset = $this->getLastYearAsset();
        $previous_year_amortization = $this->getLastYearAmortization();
        $previous_year_impairment = $this->getLastYearImpairment();

        $previous_year_asset = $previous_year_asset->toArray();
        $previous_year_amortization = $previous_year_amortization->toArray();
        $previous_year_impairment = $previous_year_impairment->toArray();
        $intangibles = $intangibles->toArray();

        $intangibles_rec = collect(array_merge($previous_year_asset, $previous_year_amortization,  $previous_year_impairment, $intangibles));
        // dd($intangibles_rec);


        $inventories = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type',
            'acct_assests.action_type',
            'acct_assests.asset_input_category'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('approved', 2)
        ->whereIn('revenue_line.note', [3])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->groupBy('acct_assests.asset_rev')
        ->get();

        // dd($inventories);

        // payable
        $payable = DB::table('account_payable')
        // ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('account_payable.due_date', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('account_payable.due_date', '<=', $to);
        })
        ->get();


        // recurrent grants Note 6
        $revenue_records = Revenue::Where('service_id',37483)
        ->select([
            'acc_revenue.revenue_line as line',
            'acc_revenue.revenue_code as code',
            'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acc_revenue.revenue_amount) as total'),
            'revenue_line.note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acc_revenue.revenue_code')
        ->where('acc_revenue.approved', 2)
        ->whereIn('revenue_line.note', [6, 7])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acc_revenue.created_at', '<=', $to);
        })
        ->groupBy('acc_revenue.revenue_code')
        ->orderBy('revenue_line.note', 'ASC')
        ->get();



        // Capital grant Note 8
        $assets = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            // 'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('approved', 2)
        ->whereIn('revenue_line.note', [8])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note')
        ->get();

        // dd($capital_grant);

        // Operation Expenses Note 9, 11, 12
        $note_9 = DB::table('expenditure_payregister')
        ->select([
            'expenditure_payregister.expenditure_type as uniId',
            'expenditure_payregister.expenditure_code as CODE',
            'expenditure_payregister.expenditure_name as line',
            DB::raw('SUM(expenditure_payregister.amount) as total'),
            'revenue_line.note as note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        ->where('expenditure_payregister.approved', 2)
        ->where('revenue_line.note', 11)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note')
        ->orderBy('revenue_line.note', 'ASC')
        ->get();

         // Operation Expenses Note 10
        $administrative = ExpenditureRegister::where('expenditure_payregister.service_id', 37483)
        ->select([
            'expenditure_payregister.expenditure_type as uniId',
            'expenditure_payregister.expenditure_code as code',
            'expenditure_payregister.expenditure_name as line',
            DB::raw('SUM(expenditure_payregister.amount) as total'),
            'revenue_line.note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        ->where('expenditure_payregister.approved', 2)
        ->whereIn('revenue_line.note', [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->groupBy('revenue_line.note') // Group by the newly created note group
        ->orderBy('revenue_line.note', 'ASC')
        ->get();

         // Operation Expenses Note 10
         $expenditures = ExpenditureRegister::where('expenditure_payregister.service_id', 37483)
         ->select([
             'expenditure_payregister.expenditure_type as uniId',
             'expenditure_payregister.expenditure_code as code',
             'expenditure_payregister.expenditure_name as line',
             DB::raw('SUM(expenditure_payregister.amount) as total'),
             'revenue_line.note'
         ])
         ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
         ->where('expenditure_payregister.approved', 2)
         ->whereIn('revenue_line.note', [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24])
         ->when(!empty($from), function ($query) use ($from) {
             return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
         })
         ->when(!empty($to), function ($query) use ($to) {
             return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
         })
         ->groupBy('expenditure_payregister.expenditure_code') // Group by the newly created note group
        //  ->orderBy('revenue_line.note', 'ASC')
         ->get();

        //  dd()

        return view('Report.note_closure_financial_statement_report',
        compact('intangibles_rec', 'inventories', 'from', 'to', 'payable', 'revenue_records', 'assets', 'note_9', 'administrative', 'expenditures'));
    }

    public function getLastYearAsset() {
        $lastYearAsset = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type',
            DB::raw('"As @ 1 January, ' . date("Y") . '" AS action_type'),
            'acct_assests.asset_input_category'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('acct_assests.approved', 2)
        ->whereIn('revenue_line.note', [2])
        ->where('acct_assests.asset_input_category', "ASSET")
        ->where('acct_assests.year', date("Y"))
        ->groupBy('acct_assests.asset_input_category')
        ->get();

        return $lastYearAsset;

        // dd($lastYearAsset);
    }

    public function getLastYearAmortization() {
        $lastYear = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type',
            DB::raw('"As @ 1 January, ' . date("Y") . '" AS action_type'),
            'acct_assests.asset_input_category'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('acct_assests.approved', 2)
        ->whereIn('revenue_line.note', [2])
        ->where('acct_assests.asset_input_category', "AMORTISATION")
        ->where('acct_assests.year', date("Y"))
        ->groupBy('acct_assests.asset_input_category')
        ->get();

        return $lastYear;
    }

    public function getLastYearImpairment() {
        $lastYear = DB::table('acct_assests')
        ->select([
            'acct_assests.assest_name AS line',
            'acct_assests.asset_rev AS code',
            DB::raw('SUM(acct_assests.opening_value) as total'),
            'revenue_line.note',
            'acct_assests.asset_rev_type',
            'acct_assest_types.assest_type',
            DB::raw('"As @ 1 January, ' . date("Y") . '" AS action_type'),
            'acct_assests.asset_input_category'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acct_assests.asset_rev')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->where('acct_assests.approved', 2)
        ->whereIn('revenue_line.note', [2])
        ->where('acct_assests.asset_input_category', "IMPAIRMENT")
        ->where('acct_assests.year', date("Y"))
        ->groupBy('acct_assests.asset_input_category')
        ->get();

        return $lastYear;
    }
}

