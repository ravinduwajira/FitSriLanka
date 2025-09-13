<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessCenterEnrollment extends Model
{
    use HasFactory;
    // Specify the table name if it's not the plural of the model name
    protected $table = 'fitness_center_enrollments';
    protected $primaryKey = 'fc_enrollment_id';

    // Define fillable fields
    protected $fillable = [
        'fitness_center_id',
        'user_id',
        'user_name',
        'enrollment_status',
    ];

    // Define relationships
    public function fitnessCenter()
    {
        return $this->belongsTo(FitnessCenter::class, 'fitness_center_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
