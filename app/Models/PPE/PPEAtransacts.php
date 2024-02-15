<?php

namespace App\Models\PPE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPEAtransacts extends Model
{
    use HasFactory;

    protected $table = 'acct_ppe_atransacts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ppeid',
        'amount',
        'historicalval',
        'invoicedate',
        'memo',
        'oamount',
        'oinvoicedate',
        'omemo',
        'opaydate',
        'opaystatus',
        'orefno',
        'ovendor',
        'paydate',
        'paystatus',
        'refno',
        'vendor',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted'
    ];
}
