<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($student) {
            $student->admision_number = 'DALMA/' . str_pad($student->count()+1, 4, '0', STR_PAD_LEFT)."/".date('Y');
            $student->save();
        });
    }

    protected $fillable = [ 
        'user_id',
        'college_id',
        'county_id',
        'course_id',
        'year_of_study',
        'reg_number',
        'kin_name',
        'kin_phone',
        'kin_email',
        'kin_relationship',
        'id_no',
        'admision_number',
        'course_level',
        'sponsored',
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class, 'county_id', 'id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
