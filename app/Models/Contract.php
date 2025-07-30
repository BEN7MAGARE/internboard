<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'user_id',
        'ref_no',
        'terms',
        'start_date',
        'end_date',
        'rate_amount',
        'rate_type',
        'signed_at',
        'files',
        'status',
        'accepted',
        'acceptance_note',
        'accepted_at',
        'rejected',
        'rejection_note',
        'rejected_at',
        'progress',
        'progress_note',
        'terminated',
        'termination_note',
        'terminated_at',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
