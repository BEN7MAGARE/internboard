<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'category_id', 'id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    public function corporates(): HasMany
    {
        return $this->hasMany(Corporate::class, 'category_id', 'id');
    }
}
