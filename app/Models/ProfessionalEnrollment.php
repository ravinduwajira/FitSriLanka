<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalEnrollment extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default 'professional_enrollments'
    protected $table = 'professional_enrollments';

    // Define the primary key if it's different from the default 'id'
    protected $primaryKey = 'enrollment_id';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'professional_id',
        'user_id',
        'professional_name',
        'name',
        'enrollment_status'
    ];

    // Define relationships if needed
    // For example, if you want to relate to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // If you want to relate to the Professional model
    public function professional()
    {
        return $this->belongsTo(ProfessionalInfo::class, 'professional_id');
    }
      // Relationship with ProfessionalInfo
      public function professionalInfo()
      {
          return $this->belongsTo(ProfessionalInfo::class, 'professional_id');
      }
}
