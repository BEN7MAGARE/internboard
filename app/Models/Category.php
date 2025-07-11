<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = self::generateUniqueSlug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = self::generateUniqueSlug($category->name);
        });
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }

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
