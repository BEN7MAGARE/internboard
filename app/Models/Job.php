<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'ref_no',
        'category_id',
        'organization_id',
        'type',
        'job_type',
        'experience_level',
        'education_level',
        'location',
        'title',
        'description',
        'start_date',
        'salary_range',
        'no_of_positions',
    ];

    protected $with = ['skills'];

    // public function skills(): HasMany
    // {
    //     return $this->hasMany(Skill::class, 'job_id', 'id');
    // }

    /**
     * The skills that belong to the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'job_skill', 'job_id', 'skill_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function corporate(): BelongsTo
    {
        return $this->belongsTo(Corporate::class, 'corporate_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_id', 'id');
    }
}
