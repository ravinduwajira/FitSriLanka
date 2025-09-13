<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFeedback extends Model
{
    use HasFactory;

    protected $table = 'user_feedbacks'; // Ensure the table name is correct

    protected $fillable = ['user_id', 'professional_id', 'score', 'feedback'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
