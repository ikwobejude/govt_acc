<?php

namespace App\Http\Controllers\Expenditure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Expenditure\ExpenditureType;

class ExpenditureTypeController extends Controller
{
    public function index(Request $request) {
        $expenditureType = DB::table('expenditure_types')->get();
        return view('Expenditure.expenditure_type', compact('expenditureType'));
    }

    public function store(Request $request) {
        $validateUser = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'code' =>['required', 'string']
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

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
