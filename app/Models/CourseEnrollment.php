<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'address',
        'phone',
        'email',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
