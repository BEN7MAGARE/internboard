<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'organization_id',
        'type',
        'title',
        'description',
        'start',
    ];

    /**
     * Get all of the skills for the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'job_id', 'id');
    }
}
