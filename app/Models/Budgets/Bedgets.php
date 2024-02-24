<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bedgets extends Model
{
    use HasFactory;

    protected $table = 'acct_budgets';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'budget_type',
        'economic_code',
        'line',
        'economic_type',
        'found_source',
        'project',
        'current_budget',
        'remaining_balance',
        'change',
        'revised_budget',
        'region',
        'approved',
        'approved_on',
        'approved_by',
        'reapproved',
        'reapproved_by',
        'service_id',
        'reason'
    ];
}
