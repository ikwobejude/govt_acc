<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetValues extends Model
{
    use HasFactory;
    protected $table = 'acct_assest_values';
    protected $primaryKey = 'id';
    protected $fillable = [
        'assest_id',
        'assest_value',
        'depreciation_amount',
        'depreciation_rate',
        'date_purchased',
        'assest_year',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted'
    ];
}
