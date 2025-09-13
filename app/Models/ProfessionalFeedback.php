<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalFeedback extends Model
{
    use HasFactory;

    protected $table = 'professional_feedbacks';
    protected $fillable = ['user_id', 'professional_id', 'score', 'feedback'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
