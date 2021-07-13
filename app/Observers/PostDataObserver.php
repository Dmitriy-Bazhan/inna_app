<?php

namespace App\Observers;

use App\Models\PostData;
use Illuminate\Support\Facades\Cache;

class PostDataObserver
{
    public $afterCommit = true;

    /**
     * Handle the PostData "created" event.
     *
     * @param  \App\Models\PostData  $postData
     * @return void
     */
    public function created(PostData $postData)
    {
        Cache::store('redis')->forget('posts');
    }

    /**
     * Handle the PostData "updated" event.
     *
     * @param  \App\Models\PostData  $postData
     * @return void
     */
    public function updated(PostData $postData)
    {
        Cache::store('redis')->forget('posts');
    }

    /**
     * Handle the PostData "deleted" event.
     *
     * @param  \App\Models\PostData  $postData
     * @return void
     */
    public function deleted(PostData $postData)
    {
        Cache::store('redis')->forget('posts');
    }

    /**
     * Handle the PostData "restored" event.
     *
     * @param  \App\Models\PostData  $postData
     * @return void
     */
    public function restored(PostData $postData)
    {
        Cache::store('redis')->forget('posts');
    }

    /**
     * Handle the PostData "force deleted" event.
     *
     * @param  \App\Models\PostData  $postData
     * @return void
     */
    public function forceDeleted(PostData $postData)
    {
        Cache::store('redis')->forget('posts');
    }
}
