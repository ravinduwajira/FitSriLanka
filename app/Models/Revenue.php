<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id', 'total_revenue', 'admin_deduction', 'net_revenue', 'month'
    ];

    public function professional()
    {
        return $this->belongsTo(ProfessionalInfo::class, 'professional_id');
    }
}
