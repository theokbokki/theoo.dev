<?php

namespace App\Hiker\Resources\Links\Nodes;

use Hiker\Tracks\Node;
use Hiker\Tracks\Nodes\Deleteable;
use Hiker\Tracks\Trips\Trip;

class DeleteLink extends Node implements Deleteable
{
    /**
     * Run the deleteable node
     *
     * @param \Hiker\Tracks\Trips\Trip $trip
     * @return mixed
     */
    public function execute(Trip $trip)
    {
        $trip->resource()->model()->delete();
    }
}
