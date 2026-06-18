<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeBlock extends Model
{
    protected $fillable = [
        'staff_id',
        'time_block_frequency_id',
        'reason',
        'is_all_day',
        'starts_at',
        'ends_at'
    ];
    const ARRAY_VALIDATION_RULES = [
        'time_blocks' => 'array',
        'time_blocks.*.id' => 'required|exclude_if:time_blocks.*.id,-1|integer|exists:time_blocks,id',
        'time_blocks.*.staff_id' => 'required|integer|exists:staff,id',
        'time_blocks.*.time_block_frequency_id' => 'required|integer|exists:time_block_frequencies,id',
        'time_blocks.*.reason' => 'required|string|max:100',
        'time_blocks.*.is_all_day' => 'required|boolean',
        'time_blocks.*.starts_at' => 'required_if:time_blocks.*.is_all_day,false|nullable|string',
        'time_blocks.*.ends_at' => 'required_if:time_blocks.*.is_all_day,false|nullable|string',
        'time_blocks.*.dates' => 'required|array',
        'time_blocks.*.dates.*.time_block_id' => 'required_with:time_blocks.*.id|exclude_if:time_blocks.*.dates.*.time_block_id,-1|integer|exists:time_blocks,id',
        'time_blocks.*.dates.*.date' => 'required_with:time_blocks.*.id|date|date_format:Y-m-d',
    ];

    /**
     * Relationships
     */

    public function dates(): HasMany
    {
        return $this->hasMany(TimeBlockDate::class);
    }
}
