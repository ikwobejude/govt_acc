<?php

namespace App\Models\Revenue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $table = 'acc_revenue';
    public $timestamps = false;

    protected $fillable = [
            'revenue_id',
            'revenue_ref',
            'revenue_date',
            'revenue_line',
            'revenue_code',
            'received_from',
            'authority_document_ref_no',
            'description',
            'rrr_status',
            'rrr',
            'asset_type',
            'asset_rin',
            'profile_ref',
            'assessment_rule',
            'tax_year',
            'revenue_amount',
            'revenue_amount_remaining',
            'revenue_amount_paid',
            'settlement_due_date',
            'settlement_status',
            'settlement_date',
            'settlement_method',
            'service_id',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
            'first_reminder_date',
            'second_reminder_date',
            'third_reminder_date',
            'fourth_reminder_date',
            'reason',
            'batch_number',
            'cancelled',
            'source',
            'day',
            'month',
            'year',
            'waiver_amount',
            'wavier_date',
            'wavier_status',
            'revenue_item',
            'revenue_note',
            'asset_name',
            'tax_office_id',
            'street_id',
            'invoice_number',
            'data_sync',
            'discount',
            'approved',
            'approved_on',
            'approved_by',
            'reapproved',
            'reapproved_by'
    ];
}
