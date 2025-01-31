<?php

namespace App\Models;

use Database\Factories\ViolationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Violation extends Model
{
    /** @use HasFactory<ViolationFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'penalty',
        'license_id',
    ];

    /**
     * @return BelongsTo
     */
    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }
}
