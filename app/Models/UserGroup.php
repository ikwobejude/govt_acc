<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'user_groups';
    public $timestamps = false;

    protected $fillable = [
            'idgroups',
            'group_id',
            'group_name'
    ];
}
