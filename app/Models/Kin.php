<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'relationship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
