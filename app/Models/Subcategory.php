<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            $subcategory->slug = self::generateUniqueSlug($subcategory->name);
        });

        static::updating(function ($subcategory) {
            $subcategory->slug = self::generateUniqueSlug($subcategory->name);
        });
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (Subcategory::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
