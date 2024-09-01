<?php

namespace App\Http\Controllers\Approvals;

use Carbon\Carbon;
use App\Models\Asset\Assets;
use Illuminate\Http\Request;
use App\Models\Asset\AssetType;
use App\Models\Asset\AssetSizes;
use App\Models\Asset\AssetValues;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Asset\AssetCategories;

class AssetApprovalController extends Controller
{
    public function index(Request $request) {
        $categories = AssetCategories::all();
        $types = AssetType::all();
        $sizes = AssetSizes::all();
        $asset_values = AssetValues::all();
        $revenue_lines = DB::table('revenue_line')->where('type', 3)->get();

        $assetType = $request->query('asset_type');
        $assetCategory = $request->query('asset_category');
        $assetSize = $request->query('asset_size');
        $economicCode = $request->query('revenue_code');

        // dd($economicCode);

        $to = $request->query('to');
        $from = $request->query('from');

        $date_purchased = $request->query('date_purchased');
        if(groupId() == 111111) {
            $assets = Assets::latest()
            ->select('acct_assests.*', 'acct_assest_categories.assest_category', 'acct_assest_types.assest_type', 'acct_assest_sizes.assest_size', 'users.name' )
            ->leftJoin('acct_assest_categories', 'acct_assest_categories.assest_category_id', 'acct_assests.assest_category_id')
            ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
            ->leftJoin('acct_assest_sizes', 'acct_assest_sizes.id', 'acct_assests.assest_size_id')
            ->leftJoin('users', 'users.username', 'acct_assests.created_by')
            ->where('acct_assests.service_id', 37483)
            ->whereIn('acct_assests.approved', [1,2,3,4])
            ->where('acct_assests.deleted', 0)
            ->when(!empty($assetCategory) , function ($query) use ($assetCategory) {
                return $query->where('acct_assest_categories.assest_category_id', $assetCategory);
            })
            ->when(!empty($assetType) , function ($query) use ($assetType) {
                return $query->where('acct_assest_types.id', $assetType);
            })
            ->when(!empty($assetSize) , function ($query) use ($assetSize) {
                return $query->where('acct_assest_sizes.id', $assetSize);
            })
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('acct_assests.asset_rev', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acct_assests.created_at', '>=', $from);
            })
            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acct_assests.created_at', '<=', $to);
            })
            ->when(!empty($date_purchased), function ($query) use ($date_purchased) {
                return $query->whereDate('acct_assests.date_purchased', '=', $date_purchased);
            })
            ->get();
        }

        if(groupId() == 3000) {
            $assets = Assets::latest()
            ->select('acct_assests.*', 'acct_assest_categories.assest_category', 'acct_assest_types.assest_type', 'acct_assest_sizes.assest_size', 'users.name' )
            ->leftJoin('acct_assest_categories', 'acct_assest_categories.assest_category_id', 'acct_assests.assest_category_id')
            ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
            ->leftJoin('acct_assest_sizes', 'acct_assest_sizes.id', 'acct_assests.assest_size_id')
            ->leftJoin('users', 'users.username', 'acct_assests.created_by')
            ->where('acct_assests.service_id', 37483)
            ->where('acct_assests.approved', 4)
            ->where('acct_assests.deleted', 0)
            ->when(!empty($assetCategory) , function ($query) use ($assetCategory) {
                return $query->where('acct_assest_categories.assest_category_id', $assetCategory);
            })
            ->when(!empty($assetType) , function ($query) use ($assetType) {
                return $query->where('acct_assest_types.id', $assetType);
            })
            ->when(!empty($assetSize) , function ($query) use ($assetSize) {
                return $query->where('acct_assest_sizes.id', $assetSize);
            })
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('acct_assests.asset_rev', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acct_assests.created_at', '>=', $from);
            })
            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acct_assests.created_at', '<=', $to);
            })
            ->when(!empty($date_purchased), function ($query) use ($date_purchased) {
                return $query->whereDate('acct_assests.date_purchased', '=', $date_purchased);
            })
            ->get();
        }

        if(groupId() == 1500) {
            $assets = Assets::latest()
            ->select('acct_assests.*', 'acct_assest_categories.assest_category', 'acct_assest_types.assest_type', 'acct_assest_sizes.assest_size', 'users.name' )
            ->leftJoin('acct_assest_categories', 'acct_assest_categories.assest_category_id', 'acct_assests.assest_category_id')
            ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
            ->leftJoin('acct_assest_sizes', 'acct_assest_sizes.id', 'acct_assests.assest_size_id')
            ->leftJoin('users', 'users.username', 'acct_assests.created_by')
            ->where('acct_assests.service_id', 37483)
            ->where('acct_assests.approved', 1)
            ->where('acct_assests.deleted', 0)
            ->when(!empty($assetCategory) , function ($query) use ($assetCategory) {
                return $query->where('acct_assest_categories.assest_category_id', $assetCategory);
            })
            ->when(!empty($assetType) , function ($query) use ($assetType) {
                return $query->where('acct_assest_types.id', $assetType);
            })
            ->when(!empty($assetSize) , function ($query) use ($assetSize) {
                return $query->where('acct_assest_sizes.id', $assetSize);
            })
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('acct_assests.asset_rev', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acct_assests.created_at', '>=', $from);
            })
            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acct_assests.created_at', '<=', $to);
            })
            ->when(!empty($date_purchased), function ($query) use ($date_purchased) {
                return $query->whereDate('acct_assests.date_purchased', '=', $date_purchased);
            })
            ->get();
        }

        // dd($assets);


        return view('Approvals.acc_asset_approvals',
        compact('categories', 'types', 'sizes', 'asset_values', 'assets', 'revenue_lines'));
    }

    public function approveAsset(Request $request) {
        try {

            if(groupId() == 3000) {
                DB::table('acct_assests')
                ->where('assest_id', $request->query('id'))
                ->update([
                    "approved" => 1,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);

            }

            if(groupId() == 1500) {
                DB::table('acct_assests')
                ->where('assest_id', $request->query('id'))
                ->update([
                    "approved" => 2,
                    "reapproved" => 1,
                    "reapproved_by" => auth()->user()->email,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);

            }

            return response()->json([
                "status" => true,
                "message" => "Approved"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function rejected(Request $request) {
        try {
            DB::table('acct_assests')
            ->where('assest_id', $request->query('id'))
            ->update([
                "reason" => $request->reason,
                "approved" => 3,
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);

            return response()->json([
                "status" => true,
                "message" => "Rejected"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function multiple_approval(Request $request) {
        try {

            // dd($request->itemid);
            // dd($request->all());

            if(groupId() == 3000) {
                DB::table('acct_assests')
                ->whereIn('assest_id', $request->itemid)
                ->update([
                    "approved" => 1,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);

            }

            if(groupId() == 1500) {
                DB::table('acct_assests')
                ->whereIn('assest_id', $request->itemid)
                ->update([
                    "approved" => 2,
                    "reapproved" => 1,
                    "reapproved_by" => auth()->user()->email,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);

            }

            $notification = array(
                'message' => 'Record submitted',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            $notification = array(
                'message' =>$th->getMessage(),
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
