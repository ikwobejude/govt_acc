<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = '_states';

    protected $fillable = [
        'state_id',
        'state',
        'state_code',
        'country_id'
    ];
}
