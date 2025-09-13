<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProfessionalInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected $table = 'professionalinfo';  

    
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'birthday',
        'age',
        'certifications',
        'experience',
        'specializations',
        'bio',
        'programs',
        'monthly_fee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'professional_id');
    }

// Relationship back to ProfessionalEnrollment (optional)
public function enrollments()
{
    return $this->hasMany(ProfessionalEnrollment::class, 'professional_id');
}
}
