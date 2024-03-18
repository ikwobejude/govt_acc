<?php

namespace App\Http\Controllers\PPE;

use Carbon\Carbon;
use App\Models\PPE\Acct_ppe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PPEController extends Controller
{
    public function index(Request $request) {
        $ppename = $request->query('ppename');
        $ppeclass = $request->query('ppeclass');
        $ppestate = $request->query('ppestate');
        $location = $request->query('location');
        $usefulyears = $request->query('usefulyears');
        $from = $request->query('from');
        $to = $request->query('to');

        $ppeClass = DB::table('acct_ppe_class')->get();
        $state = DB::table('_states')->get();


        $acctPPE = DB::table('acct_ppe')
        ->select('acct_ppe.*', 'acct_ppe_class.ppeclass as peclass', '_states.state')
        ->leftJoin('acct_ppe_class', 'acct_ppe_class.classid', 'acct_ppe.ppeclass')
        ->leftJoin('_states', '_states.state_id', 'acct_ppe.ppestate')
        ->where('acct_ppe.deleted', 0)
        ->where('acct_ppe.approved', 0)
        ->when(!empty($ppename), function ($query) use ($ppename) {
            return $query->where('ppename', 'like', "%{$ppename}%");
        })
        ->when(!empty($ppeclass), function ($query) use ($ppeclass) {
            return $query->where('ppeclass', '=', $ppeclass);
        })
        ->when(!empty($ppestate), function ($query) use ($ppestate) {
            return $query->where('ppestate', '=', $ppestate);
        })
        ->when(!empty($location), function ($query) use ($location) {
            return $query->where('location', 'like', "%{$location}%");
        })
        ->when(!empty($usefulyears), function ($query) use ($usefulyears) {
            return $query->where('usefulyears', '=', "{$usefulyears}");
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('id', 'desc')
        ->paginate(20);


        return view('PPE.acc_ppe', compact('ppeClass', 'acctPPE', 'state'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'ppename' => ['required', 'string'],
            'ppedesc' => ['required', 'string'],
            'ppeclass' => ['required', 'string'],
            'ppestate' => ['required', 'string'],
            'location' => ['required', 'string'],
            'warranty' => ['required', 'string'],
            'usefulyears' => ['required', 'string'],
            'residualval' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'salvage_value' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
        ]);

        $carbon = Carbon::parse($request->date);
        $year = $carbon->format('Y');
        $month = $carbon->format('F');

        // $arr = explode(',', $request->ppeclass);

        // dd( $arr);
        Acct_ppe::insert([
            "ppename" => $request->ppename,
            "ppedesc" => $request->ppedesc,
            "ppeclass" => $request->ppeclass,
            // "ppeacct" => $request->ppename,
            "ppestate" => $request->ppestate,
            "location" => $request->location,
            "warranty" => $request->warranty,
            "residualval" => $request->usefulyears,
            "usefulyears" => $request->residualval,
            "salvage_value" => $request->salvage_value,
            "created_by" => username(),
            "created_at" =>  $carbon,
            "service_id" => 37483
        ]);

        $notification = array(
            'message' => 'Created successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function update(Request $request) {
        // dd($request->all());
        $validateUser = Validator::make($request->all(), [
            'ppename' => ['required', 'string'],
            'ppedesc' => ['required', 'string'],
            'ppeclass' => ['required', 'string'],
            'ppestate' => ['required', 'string'],
            'location' => ['required', 'string'],
            'warranty' => ['required', 'string'],
            'usefulyears' => ['required', 'string'],
            'residualval' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'salvage_value' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

        $carbon = Carbon::parse($request->date);
        Acct_ppe::where('id', $request->id)->update([
            "ppename" => $request->ppename,
            "ppedesc" => $request->ppedesc,
            "ppeclass" => $request->ppeclass,
            // "ppeacct" => $request->ppename,
            "ppestate" => $request->ppestate,
            "location" => $request->location,
            "warranty" => $request->warranty,
            "residualval" => $request->usefulyears,
            "usefulyears" => $request->residualval,
            "salvage_value" => $request->salvage_value,
            "created_by" => name(),
            "created_at" =>  $carbon,
            "service_id" => 37483
        ]);

        $notification = array(
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy($id) {

        Acct_ppe::where('id', $id)->update([
            'deleted' => 1
        ]);

        $notification = array(
            'message' => 'Deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function finalization(Request $request) {

        Acct_ppe::whereIn('id', $request->itemid)->update([
            'approved' => 4,
            'approved_on' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Record(s) saved successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
