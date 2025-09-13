<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'blood_glucose', 'cholesterol_level', 'sleep', 
        'water_intake', 'start_weight', 'current_weight', 'goal_weight'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
