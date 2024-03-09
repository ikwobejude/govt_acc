<?php

namespace App\Http\Controllers\PPE;

use App\Models\PPE\PPECLass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PPECLassController extends Controller
{
    public function index(Request $request) {
        $ppeClass = DB::table('acct_ppe_class')
        ->select('acct_ppe_class.*', 'acct_ppe_depreciation_type.depreciation_type')
        ->leftJoin('acct_ppe_depreciation_type', 'acct_ppe_depreciation_type.id', 'acct_ppe_class.depreciation_type_id')
        ->get()->sortDesc();
        $depreciationType = DB::table('acct_ppe_depreciation_type')->get();
        return view('PPE.PPE_class', compact('ppeClass','depreciationType'));
    }

    public function store(Request $request) {
        $validateUser = Validator::make($request->all(), [
            'ppeclass' => ['required', 'string'],
            'depreciation_type' => ['required', 'string']
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }


        PPECLass::insert([
            "ppeclass" => $request->ppeclass,
            "ppeclass_description" => $request->ppeclass_description,
            "depreciation_type_id" => $request->depreciation_type,
        ]);

        $notification = array(
            'message' => 'created successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
