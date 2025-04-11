<?php

namespace App\Hiker\Resources\Notes\Nodes;

use Hiker\Tracks\Node;
use Hiker\Tracks\Nodes\Saveable;
use Hiker\Tracks\Trips\Trip;
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

        $this->handleSlugHistory();

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
