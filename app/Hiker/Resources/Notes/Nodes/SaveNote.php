<?php

namespace App\Hiker\Resources\Notes\Nodes;

use Hiker\Tracks\Node;
use Hiker\Tracks\Nodes\Saveable;
use Hiker\Tracks\Trips\Trip;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SaveNote extends Node implements Saveable
{
    /**
     * The model
     */
    protected $model;

    /**
     * Run the instanciated node.
     *
     * @param  \Hiker\Tracks\Trip  $trip
     * @return void
     */
    public function execute(Trip $trip)
    {
        $bag = $trip->baggage();

        $this->model = $trip->resource()->modelOrNew();

        $this->model->title = $bag->title;
        $this->model->slug = Str::slug($bag->title);
        $this->model->published = $bag->published;
        $this->model->is_snippet = $bag->is_snippet;

        $this->handleSlugHistory();
        $this->handleMarkdownFile();

        $this->model->save();
    }

    private function handleSlugHistory()
    {
        $slugIsDirty = $this->model->isDirty('slug');
        $slugIsNull = is_null($this->model->getOriginal('slug'));
        $slugWasUsedBefore = $this->model
            ->slugHistories()
            ->where('slug', $this->model->getOriginal('slug'))
            ->exists();

        if (! $slugIsDirty || $slugIsNull || $slugWasUsedBefore) {
            return;
        }

        $this->model->slugHistories()->create([
            'slug' => $this->model->getOriginal('slug'),
        ]);
    }

    private function handleMarkdownFile()
    {
        $disk = Storage::disk('local');
        $notesPath = 'notes';

        $newFilePath = $notesPath.'/'.$this->model->slug.'.md';

        $slugChanged = $this->model->isDirty('slug');
        $oldSlug = $this->model->getOriginal('slug');
        $oldFilePath = $notesPath.'/'.$oldSlug.'.md';

        if ($slugChanged && $oldSlug && $disk->exists($oldFilePath)) {
            $disk->move($oldFilePath, $newFilePath);

            return;
        }

        $fileExists = $disk->exists($newFilePath);

        if (! $fileExists) {
            $disk->put($newFilePath, '');
        }
    }

    /**
     * Get the saved model
     *
     * @return mixed
     */
    public function model()
    {
        return $this->model;
    }
}
