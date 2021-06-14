<?php

namespace App\Observers;

use App\Models\CommentVote;

class CommentVoteObserver
{
    /**
     * Handle the CommentVote "created" event.
     *
     * @param  \App\Models\CommentVote  $commentVote
     * @return void
     */
    public function created(CommentVote $commentVote)
    {
        $commentVote->comment()->increment('votes', $commentVote->vote);
    }

    /**
     * Handle the CommentVote "updated" event.
     *
     * @param  \App\Models\CommentVote  $commentVote
     * @return void
     */
    public function updated(CommentVote $commentVote)
    {
        //
    }

    /**
     * Handle the CommentVote "deleted" event.
     *
     * @param  \App\Models\CommentVote  $commentVote
     * @return void
     */
    public function deleted(CommentVote $commentVote)
    {
        //
    }

    /**
     * Handle the CommentVote "restored" event.
     *
     * @param  \App\Models\CommentVote  $commentVote
     * @return void
     */
    public function restored(CommentVote $commentVote)
    {
        //
    }

    /**
     * Handle the CommentVote "force deleted" event.
     *
     * @param  \App\Models\CommentVote  $commentVote
     * @return void
     */
    public function forceDeleted(CommentVote $commentVote)
    {
        //
    }
}
