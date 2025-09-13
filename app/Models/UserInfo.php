<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    use HasFactory;
    protected $guarded = [];
// Specify the table name if it's different from the default 'user_infos'
protected $table = 'userinfo';  

// Define the primary key if it's different from the default 'id'
protected $primaryKey = 'id';

// Specify the fields that are mass assignable
protected $fillable = [
    'id', 
    'birthday', 
    'age', 
    'height', 
    'weight', 
    'activity_level', 
    'fitness_goal', 
    'dietary_preference', 
    'medical_conditions'
];
    public function user()
{
    return $this->belongsTo(User::class, 'id');
}

}
