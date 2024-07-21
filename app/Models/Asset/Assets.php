<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'acct_assests';
    protected $primaryKey = 'assest_id';
    protected $fillable = [
        'assest_type_id',
        'assest_sub_type_id',
        'assest_category_id',
        'assest_size_id',
        'assest_location_id',
        'assest_name',
        'assest_user_id',
        'assest_decription',
        'date_purchased',
        'day',
        'month',
        'year',
        'insurance_status_id',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted',
        'useful_life',
        'opening_value',
        'asset_rev_type',
        'asset_rev_name',
        'asset_rev',
        'approved',
        'approved_on',
        'approved_by',
        'reapproved',
        'reapproved_by',
        'reason',
        'drafted_on'
    ];
}
