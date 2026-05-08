<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'method',
        'wallet_address',
        'bank_name',
        'account_name',
        'account_number',
        'swift_code',
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
