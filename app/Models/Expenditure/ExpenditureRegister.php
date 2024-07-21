<?php

namespace App\Models\Expenditure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureRegister extends Model
{
    use HasFactory;
    protected $table = 'expenditure_payregister';
    public $timestamps = false;
    protected $primaryKey = 'idexpenditure_payregister';

    protected $fillable = [
        'batch_name',
        'month',
        'year',
        'expenditure_type',
        'expenditure_code',
        'expenditure_name',
        'name',
        'amount',
        'account_number',
        'account_type',
        'bank_name',
        'cbn_bank_code',
        'narration',
        'beneficiary_code',
        'payment_ref',
        'created_by',
        'created_at',
        'approved',
        'approved_on',
        'approved_by',
        'reapproved',
        'reapproved_by',
        'service_id',
        'reason',
        'drafted_on',
        'day'
    ];
}
