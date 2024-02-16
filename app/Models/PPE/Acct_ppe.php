<?php

namespace App\Models\PPE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acct_ppe extends Model
{
    use HasFactory;

    protected $table = 'acct_ppe';
    protected $primaryKey = 'id';

    protected $fillable = ['ppeid', 'ppename', 'ppedesc', 'ppeclass', 'ppeacct', 'ppestate', 'location', 'lponumber', 'sno', 'warranty', 'photo', 'pstatus', 'residualval', 'usefulyears','salvage_value','life_in_no_of_units','no_of_units_produced','service_id', 'created_by', 'created_at', 'updated_at', 'updated_by', 'enabled', 'deleted'];
}
