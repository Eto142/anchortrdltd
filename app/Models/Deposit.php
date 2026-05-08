<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'amount',
        'method',
        'transaction_id',
        'payment_proof',
        'notes',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            1 => 'Approved',
            2 => 'Rejected',
            default => 'Pending',
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            1 => 'status-approved',
            2 => 'status-rejected',
            default => 'status-pending',
        };
    }
}
