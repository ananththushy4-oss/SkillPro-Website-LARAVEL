<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'fullname',
        'qualification',
        'experience',
        'photo',
        'description',
        'user_id',
    ];

    // 🔗 Each instructor belongs to one user account
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Many-to-Many: Instructor can teach many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_instructor', 'instructor_id', 'course_id');
    }
}
