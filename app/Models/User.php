<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'corporate_id',
        'college_id',
        'first_name',
        'last_name',
        'role',
        'phone',
        'email',
        'address',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'user_id', 'id');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    /**
     * Get the college that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    /**
     * Get the corporate that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function corporate(): BelongsTo
    {
        return $this->belongsTo(Corporate::class, 'corporate_id');
    }
}
