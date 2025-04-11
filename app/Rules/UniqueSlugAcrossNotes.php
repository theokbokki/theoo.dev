<?php

namespace App\Rules;

use App\Models\Note;
use App\Models\NoteSlugHistory;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class UniqueSlugAcrossNotes implements ValidationRule
{
    protected ?int $currentNoteId;

    public function __construct(?int $currentNoteId = null)
    {
        $this->currentNoteId = $currentNoteId;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = Str::slug($value);

        $slugInNotes = Note::withTrashed()
            ->where('slug', $value)
            ->when($this->currentNoteId, fn ($query) => $query
                ->where('id', '!=', $this->currentNoteId)
            )
            ->exists();

        $slugInHistory = NoteSlugHistory::query()
            ->where('slug', $value)
            ->when($this->currentNoteId, fn ($query) => $query
                ->where('note_id', '!=', $this->currentNoteId)
            )
            ->exists();

        if ($slugInNotes || $slugInHistory) {
            $fail('This slug is already in use or has been used before by another note.');
        }
    }
}
