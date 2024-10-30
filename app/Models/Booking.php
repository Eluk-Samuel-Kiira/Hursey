<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_number',
        'check_in',
        'check_out',
        'guest_number',
        'coming_from',
        'special_requests',
        'ip_address',
        'status',
        'txn_status',
    ];
}
