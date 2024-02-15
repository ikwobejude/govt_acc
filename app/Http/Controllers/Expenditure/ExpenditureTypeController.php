<?php

namespace App\Http\Controllers\Expenditure;

use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenditureTypeController extends Controller
{
    public function index(Request $request) {
        $expenditureType = DB::table('expenditure_types')->get();
        return view('Expenditure.expenditure_type', compact('expenditureType'));
    }

    public function store(Request $request) {
        $request->validate([
            'type' => ['required', 'string'],
            'code' =>['required', 'string']
        ]);

        ExpenditureType::create([
            "type" => $request->type,
            "code" => $request->code,
        ]);

        $notification = array(
            'message' => 'Revenue line created successfully',
            'alert-type' => 'success'
        );
        return redirect('/settings/expenditure_type')->with($notification);
    }
}
