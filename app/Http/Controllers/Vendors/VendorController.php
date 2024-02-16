<?php

namespace App\Http\Controllers\Vendors;

use App\Http\Controllers\Controller;
use App\Models\Vendors\AcctVendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index(Request $request) {
        $vendors = DB::table('acct_vendors_infos')->get();
        $states = DB::table('_states')->get();
        return view('Vendors.vendor', compact('vendors', 'states'));
    }

    public function store(Request $request) {
        $request->validate([
            'vendor_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'state' => ['required', 'string'],
            'mobile_phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'bank' => ['required', 'string'],
            'account_number' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'contact_phone_no' => ['required', 'string'],
            'contact_email' => ['required', 'string'],
        ]);

        AcctVendors::insert([
            "vendor_name" => $request->vendor_name,
            "address" => $request->address,
            "state_id" => $request->state,
            "mobile_phone" => $request->mobile_phone,
            "email" => $request->email,
            "bank_id" => $request->bank,
            "account_number" => $request->account_number,
            "contact_lastname" => $request->contact_lastname,
            "contact_firstname" => $request->contact_firstname,
            "contact_phone_no" => $request->contact_phone_no,
            "contact_email" => $request->contact_email,
        ]);

        $notification = array(
            'message' => 'Asset Type Created!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
