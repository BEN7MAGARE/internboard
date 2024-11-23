<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;


    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_skill', 'job_id', 'skill_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_skills', 'user_id', 'skill_id');
    }

    /**
     * The user that belong to the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_skill', 'user_id', 'skill_id');
    }
}

