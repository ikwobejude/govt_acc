<?php

namespace App\Models\Liability;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiabilityType extends Model
{
    use HasFactory;

    protected $table = 'liability_type';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'type',
        'description'
    ];
}
