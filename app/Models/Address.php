<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street',
        'address',
        'house_number',
        'barangay',
        'city',
        'province',
        'postal_code',
        'country'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
