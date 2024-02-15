<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetCategories extends Model
{
    use HasFactory;
    protected $table = 'acct_assest_categories';
    protected $primaryKey = 'assest_category_id';
    protected $fillable = [
        'assest_category',
        'assest_category_description',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted'
    ];
}
