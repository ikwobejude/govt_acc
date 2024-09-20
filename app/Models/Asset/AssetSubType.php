<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetSubType extends Model
{
    use HasFactory;
    protected $table = 'acct_assest_sub_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'assest_sub_type',
        'assest_sub_type_description',
        'assest_type_id',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted'
    ];
}
