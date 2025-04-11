<?php

namespace App\Hiker\Resources\Notes\Nodes;

use Hiker\Tracks\Node;
use Hiker\Tracks\Nodes\Deleteable;
use Hiker\Tracks\Trips\Trip;

class DeleteNote extends Node implements Deleteable
{
    /**
     * Run the instanciated node.
     *
     * @param  \Hiker\Tracks\Trip  $trip
     * @return void
     */
    public function execute(Trip $trip)
    {
        $trip->resource()->model()->delete();
    }
}
