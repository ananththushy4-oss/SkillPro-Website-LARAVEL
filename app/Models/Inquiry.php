<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'course_id', // We store the course ID, not the name
        'message',
    ];

    /**
     * Relationship: An Inquiry belongs to one Course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
