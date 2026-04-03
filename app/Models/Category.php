<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Table name
    protected $table = 'categories';

    // Primary key is 'catid'
    protected $primaryKey = 'catid';

    // Primary key is not auto-incrementing
    public $incrementing = false;
    protected $keyType = 'string';

    // Mass assignable fields
    protected $fillable = [
        'catid',
        'category',
        'image_url',
    ];

    // 🔗 Many-to-Many: Category can have many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_category', 'category_id', 'course_id');
    }
}
