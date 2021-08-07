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
     * @param \App\Models\PostData $postData
     * @return void
     */
    public function created(PostData $postData)
    {
        $this->clearCache();
    }

    /**
     * Handle the PostData "updated" event.
     *
     * @param \App\Models\PostData $postData
     * @return void
     */
    public function updated(PostData $postData)
    {
        $this->clearCache();
    }

    /**
     * Handle the PostData "deleted" event.
     *
     * @param \App\Models\PostData $postData
     * @return void
     */
    public function deleted(PostData $postData)
    {
        $this->clearCache();
    }

    /**
     * Handle the PostData "restored" event.
     *
     * @param \App\Models\PostData $postData
     * @return void
     */
    public function restored(PostData $postData)
    {
        $this->clearCache();
    }

    /**
     * Handle the PostData "force deleted" event.
     *
     * @param \App\Models\PostData $postData
     * @return void
     */
    public function forceDeleted(PostData $postData)
    {
        $this->clearCache();
    }

    private function clearCache()
    {

        try {
            Cache::store('redis')->forget('posts');

        } catch (\Exception $exception) {
            //Временно. Исправить когда разберусь с логами
            dd('Redis not work');
        }
    }
}
