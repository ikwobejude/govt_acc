<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

    protected $table = 'local_goverment_area';

    protected $fillable = [
        'id_lga',
        'lga_id',
        'lga',
        'zone_id',
        'lga_class',
        'state_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'lga_code',
    ];
}
