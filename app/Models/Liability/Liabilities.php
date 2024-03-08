<?php

namespace App\Models\Liability;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liabilities extends Model
{
    use HasFactory;

    protected $table = 'liabilities';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'economic_code',
        'economic_name',
        'economic_type',
        'liability',
        'type_of_liability',
        'created_by',
        'created_at',
        'authorize_ref',
        'approved_by',
        'approved_on',
        'approved',
        'reapproved_by',
        'reapproved_at',
        'reason',
        'deleted',
        'narration',
        'amount'
    ];
}
