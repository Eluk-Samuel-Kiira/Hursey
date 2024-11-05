<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'service_icon',
        'narration',
        'status',
    ];


    
    public function serviceImagae() 
    {
        return $this->belongsTo(Gallery::class, 'service_icon', 'id');
    }
}
