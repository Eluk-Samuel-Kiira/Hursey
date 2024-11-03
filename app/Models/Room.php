<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image_id',
        'bath',
        'bed',
        'narration',
        'status',
    ];

    
    public function imageName() 
    {
        return $this->belongsTo(Gallery::class, 'image_id', 'id');
    }
    
}
