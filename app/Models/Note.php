<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Phiki\CommonMark\PhikiExtension;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'is_snippet',
        'published',
    ];

    public function slugHistories(): HasMany
    {
        return $this->hasMany(NoteSlugHistory::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopePublishedNotes(Builder $query): Builder
    {
        return $query->published()->where('is_snippet', false);
    }

    public function scopePublishedSnippets(Builder $query): Builder
    {
        return $query->published()->where('is_snippet', true);
    }

    public function getContent(): string
    {
        $filePath = 'notes/'.$this->slug.'.md';

        if (! Storage::disk('local')->exists($filePath)) {
            return '';
        }

        $content = Storage::disk('local')->get($filePath);

        $html = str()->markdown($content);

        return preg_replace(
            '/<p>::(.+?)<\/p>\s*<p>(.*?)<\/p>/s',
            '<p class="$1">$2</p>',
            $html
        );
    }

    public function relatedNotes(): Collection
    {
        return Note::query()
            ->published()
            ->where('is_snippet', $this->is_snippet)
            ->whereNot('id', $this->id)
            ->get();
    }
}
