<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SeriesCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $seriesName;
    public int $seriesId;
    public int $seriesSeasonsQty;
    public int $seriesEpisodesPerSeason;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        $seriesName,
        $seriesId,
        $seriesSeasonsQty,
        $seriesEpisodesPerSeason
    )
    {
        $this->seriesName = $seriesName;
        $this->seriesId = $seriesId;
        $this->seriesSeasonsQty = $seriesSeasonsQty;
        $this->seriesEpisodesPerSeason = $seriesEpisodesPerSeason;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
