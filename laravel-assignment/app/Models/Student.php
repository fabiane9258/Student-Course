<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'password', //  log in
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Relationships
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot('enrolled_on', 'status')
            ->withTimestamps();
    }
}
