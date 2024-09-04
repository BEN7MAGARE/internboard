<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Corporate extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','address'];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'corporate_id', 'id');
    }

    /**
     * Get all of the users for the Corporate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'corporate_id', 'id');
    }
}
