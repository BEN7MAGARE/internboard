<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function ($model) {
            $model->generateSlug();
        });
        
        static::updating(function ($model) {
            if ($model->isDirty($model->slugSourceColumn())) {
                $model->generateSlug();
            }
        });
    }
    
    public function generateSlug()
    {
        $slug = Str::slug($this->{$this->slugSourceColumn()});
        
        $query = static::where('slug','like', $slug.'%')
            ->withoutGlobalScopes();
            
        if ($this->exists) {
            $query->where($this->getKeyName(), '!=', $this->getKey());
        }
        
        $slugs = $query->pluck('slug')->all();
        
        if (!in_array($slug, $slugs)) {
            $this->slug = $slug;
            return;
        }
        
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug.'-'.$i;
            if (!in_array($newSlug, $slugs)) {
                $this->slug = $newSlug;
                return;
            }
        }
        
        $this->slug = $slug.'-'.time();
    }
    
    // Override this method in your model if needed
    protected function slugSourceColumn()
    {
        return 'name';
    }
    
}