<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    use HasFactory;
    protected $table = 'acct_assest_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'assest_type',
        'assest_type_description',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted'
    ];
}
