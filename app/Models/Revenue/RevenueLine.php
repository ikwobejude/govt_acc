<?php

namespace App\Models\Revenue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenueLine extends Model
{
    use HasFactory;

    protected $table = 'revenue_line';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'description',
        'economic_code',
        'type',
        'created_by',
        'created_on',
        'note'
    ];
}
