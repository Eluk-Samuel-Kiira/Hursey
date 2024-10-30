<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'about_text',
        'no_staff',
        'no_room',
        'no_clients',
    ];
}
