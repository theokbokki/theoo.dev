<?php

namespace App\Hiker\Resources\Links\Nodes;

use Hiker\Tracks\Node;
use Hiker\Tracks\Nodes\Saveable;
use Hiker\Tracks\Trips\Trip;

class SaveLink extends Node implements Saveable
{
    /**
     * The model
     */
    protected $model;

    /**
     * Run the saveable node
     *
     * @param \Hiker\Tracks\Trips\Trip $trip
     * @return void
     */
    public function execute(Trip $trip)
    {
        $bag = $trip->baggage();

        $this->model = $trip->resource()->modelOrNew();

        $this->model->description = $bag->description;
        $this->model->url = $bag->url;

        $this->model->save();
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
