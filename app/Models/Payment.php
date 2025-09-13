<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'professional_id', 'amount', 'admin_charge', 'payment_date'
    ];

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    
}