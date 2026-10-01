<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTokenUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'usage_date',
        'tokens_used',
    ];

    protected $casts = [
        'usage_date' => 'date',
        'tokens_used' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get today's token usage for a given user. Creates record if not exists.
     */
    public static function getTodayUsage(int $userId): self
    {
        return self::firstOrCreate(
            [
                'user_id' => $userId,
                'usage_date' => now()->toDateString(),
            ],
            ['tokens_used' => 0]
        );
    }

    /**
     * Add tokens to today's usage count.
     */
    public static function addTokens(int $userId, int $tokenCount): self
    {
        $usage = self::getTodayUsage($userId);
        $usage->increment('tokens_used', $tokenCount);
        return $usage->fresh();
    }

    /**
     * Check if user has remaining daily quota.
     */
    public static function hasQuota(int $userId, int $dailyLimit = 5000): bool
    {
        $usage = self::getTodayUsage($userId);
        return $usage->tokens_used < $dailyLimit;
    }

    /**
     * Get remaining tokens for today.
     */
    public static function remainingTokens(int $userId, int $dailyLimit = 5000): int
    {
        $usage = self::getTodayUsage($userId);
        return max(0, $dailyLimit - $usage->tokens_used);
    }
}
