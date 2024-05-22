<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone_number_other',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
