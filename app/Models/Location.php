<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Table name (optional if Laravel can infer correctly)
    protected $table = 'locations';

    // Primary key is 'locid' instead of 'id'
    protected $primaryKey = 'locid';

    // locid is not auto-incrementing (like LOC001, LOC002)
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable fields
    protected $fillable = ['locid', 'location', 'image_url'];

    // 🔗 Many-to-Many: Location can have many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_location', 'location_id', 'course_id');
    }
}
