<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    protected $table = 'workout_plans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'professional_id',
        'client_id',
        'workout_schedule',
        'calorie_burn',
        'workout_benefits',
        'workout_duration',
        'additional_info',
        'workout_image',  
        'workout_video',  
    ];

    // Relationship to the professional (user)
    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id'); 
    }

    // Relationship to the client (user)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');  // Fix relation
    }
}
