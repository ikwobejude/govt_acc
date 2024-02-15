<?php

namespace App\Models\PPE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPECLass extends Model
{
    use HasFactory;

    protected $table = 'acct_ppe_class';
    protected $primaryKey = 'id';

    protected $fillable = [
        'classid',
        'ppeclass',
        'ppeclass_description',
        'cstatus',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted',
        'depreciation_type_id'
    ];
}
