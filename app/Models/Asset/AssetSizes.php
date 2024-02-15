<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetSizes extends Model
{
    use HasFactory;
    protected $table = 'acct_assest_sizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'assest_size',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted',
    ];
}
