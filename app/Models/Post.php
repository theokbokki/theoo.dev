<?php

namespace App\Models;

use App\Models\Concerns\HasAttachments;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Guarded([])]
class Post extends Model
{
    use HasAttachments;

    public const LEGACY_DATE = '2025-01-01';

    protected function displayDate(): Attribute
    {
        return Attribute::get(fn() => $this->created_at->isSameDay(static::LEGACY_DATE)
            ? $this->created_at->format('Y')
            : $this->created_at->isoFormat('D MMM YYYY'));
    }
}
