<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessCenter extends Model
{
    use HasFactory;
    protected $primaryKey = 'fitnesscenterid';
    protected $table = 'fitness_centers';
    

    protected $fillable = [
        'professional_id', 'name', 'address', 'monthly_fee',
    ];

    // Define the relationship with the User (Professional)
    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }
    public function enrollments()
{
    return $this->hasMany(FitnessCenterEnrollment::class, 'fitness_center_id', 'fitnesscenterid');
}

}
