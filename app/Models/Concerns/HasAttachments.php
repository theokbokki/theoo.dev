<?php

namespace App\Models\Concerns;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAttachments
{
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable')->orderBy('sort');
    }

    protected static function bootHasAttachments(): void
    {
        static::deleting(function (Model $model) {
            $model->attachments->each->delete();
        });
    }
}
