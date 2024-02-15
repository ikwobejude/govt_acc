<?php

namespace App\Models\Expenditure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenditureBatchName extends Model
{
    use HasFactory;

    protected $table = 'expenditure_batch_name';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'created_by',
        'service_id',
        'created_at'
    ];
}
