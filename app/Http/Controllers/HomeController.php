<?php

namespace App\Http\Controllers;

use App\Models\Asset\Assets;
use App\Models\Expenditure\ExpenditureRegister;
use App\Models\Liability\Liabilities;
use App\Models\Revenue\Revenue;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home() {
        $year = date("Y");
        $revenue = Revenue::whereYear('created_at', $year)->sum('revenue_amount_paid');
        $expenditure = ExpenditureRegister::whereYear('created_at', $year)->sum('amount');
        $asset = Assets::whereYear('created_at', $year)->sum('opening_value');
        $liability = Liabilities::whereYear('created_at', $year)->sum('amount');
        return view('dashboard', compact('revenue', 'expenditure', 'asset', 'liability'));
    }
}
