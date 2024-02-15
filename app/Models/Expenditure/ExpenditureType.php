<?php

namespace App\Models\Expenditure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureType extends Model
{
    use HasFactory;
    protected $table = 'expenditure_types';
    protected $primaryKey = 'idexpenditure_types';
    public $timestamps = false;

    protected $fillable = [
        'type',
        'code',
        'service_id'
    ];
}
