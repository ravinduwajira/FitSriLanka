<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fastingtracker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fasting_plan', 'start_time', 'end_time','duration'];

    // Accessor to calculate the fasting duration in hours and minutes
    public function getFastingDurationAttribute()
    {
        if ($this->end_time) {
            return Carbon::parse($this->start_time)->diffForHumans($this->end_time, true);
        }
        return Carbon::parse($this->start_time)->diffForHumans(Carbon::now(), true);
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
