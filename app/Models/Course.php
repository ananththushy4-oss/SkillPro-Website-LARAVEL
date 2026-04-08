<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_id', 
        'name', 
        'image_url', 
        'enroll_option', 
        'duration', 
        'description'
    ];

    // 🔗 Many-to-Many with Instructor
    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instructor', 'course_id', 'instructor_id');
    }

    // 🔗 Many-to-Many with Location
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'course_location', 'course_id', 'location_id');
    }

    // 🔗 Many-to-Many with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category', 'course_id', 'category_id');
    }

    // 🔗 Many-to-Many with User
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
                    ->withTimestamps();
    }
}
