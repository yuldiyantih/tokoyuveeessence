<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileCustomer extends Model
{
    use HasFactory;

    protected $table = 'profile_customer';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'province',
        'city',
        'postal_code'
    ];
}
