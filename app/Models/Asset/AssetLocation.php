<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetLocation extends Model
{
    use HasFactory;

    protected $table = 'acct_assest_locations';
    protected $primaryKey = 'assest_locations_id';
    protected $fillable = [
        'state_id',
        'lga_id',
        'country_id',
        'address',
        'service_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',
        'enabled',
        'deleted'
    ];


    // public function country()
    // {
    //         return $this->belongsTo(Country::class,'country_id','country_id');

    // }

    // public function state()
    // {
    //         return $this->belongsTo(State::class,'state_id','state_id');
    // }

    // public function lga()
    // {
    //         return $this->belongsTo(Lga::class,'lga_id','lga_id');
    // }

}
