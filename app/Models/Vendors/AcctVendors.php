<?php

namespace App\Models\Vendors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcctVendors extends Model
{
    use HasFactory;

    protected $table = 'acct_vendors_infos';
    protected $primaryKey = 'vendor_info_id';

    protected $fillable = [
        'service_id',
        'vendor_no',
        'vendor_name',
        'city',
        'lga',
        'state',
        'country',
        'address',
        'mobile_phone',
        'email',
        'bank_id',
        'bank_branch_id',
        'account_number',
        'account_type',
        'user_id',
        'bvn',
        'verified_bvn',
        'verified accountno',
        'verified_account_name',
        'verified_bankname',
        'bvn_verified_status',
        'rc_number',
        'contract_limit',
        'ministries_id',
        'contact_lastname',
        'contact_firstname',
        'contact_firstname',
        'contact_email',
        'classification_specifics',
        'enabled',
        'deleted',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'vendor_type_id'
    ];
}
