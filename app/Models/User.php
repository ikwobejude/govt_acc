<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        "group_id",
        "name",
        "username",
        "email",
        "phone",
        "service_id",
        "service_code",
        "allowmobilelogin",
        "allowdesktoplogin",
        "first_use",
        "prev_username",
        "updated_by",
        "updated_at",
        "inactive",
        "reset_token",
        "reset_expiry_date",
        "organization_id",
        "organization_code",
        "agency_id",
        "tax_office_id",
        "user_code",
        "email_verificatied",
        "email_verified_at",
        "password_expiry_date",
        "permissions",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
