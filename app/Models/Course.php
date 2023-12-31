<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillables=[
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
