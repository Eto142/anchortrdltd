<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'plan',
        'amount',
        'roi',
        'profit',
        'total_return',
        'duration',
        'maturity_at',
        'status',
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'roi'          => 'decimal:2',
        'profit'       => 'decimal:2',
        'total_return' => 'decimal:2',
        'maturity_at'  => 'datetime',
        'status'       => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            1 => 'Completed',
            2 => 'Cancelled',
            default => 'Active',
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
