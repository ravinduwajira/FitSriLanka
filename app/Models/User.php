<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class, 'id');
    }
    
    public function fastingTrackers()
{
    return $this->hasMany(FastingTracker::class);
}
public function healthStatuses()
    {
        return $this->hasMany(HealthStatus::class);
    }


public function conversations()
{
    return $this->hasMany(Conversation::class, 'user_one_id')
                ->orWhere('user_two_id', $this->id);
}

public function messages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

// User.php
public function userFeedbacks()
{
    return $this->hasMany(UserFeedback::class, 'user_id');
}
    // ProfessionalInfo.php
    public function professionalFeedbacks()
    {
        return $this->hasMany(ProfessionalFeedback::class, 'professional_id');
    }
}