<?php

namespace App\Listeners;

use App\Events\AddPostEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AddPostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  AddPostEvent  $event
     * @return void
     */
    public function handle(AddPostEvent $event)
    {
        Log::info('I SAVE IN DB POST WITH ALIAS  ' , [$event->alias]);
    }
}
