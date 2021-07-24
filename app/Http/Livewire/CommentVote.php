<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\CommentVote as Vote;

class CommentVote extends Component
{
    public $comment;
    public $votes;

    public function mount($comment) {
        $this->comment = $comment;
        $this->votes = Vote::where('comment_id', $comment->id)->get();
    }

    public function vote($vote) {
        if (!$this->comment->votes()->where('user_id', auth()->id())->count()
            && in_array($vote, [-1, 1]) && $this->comment->user_id != auth()->id()) {
            Vote::create([
                'comment_id' => $this->comment->id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);

            $this->votes += $vote;
        }
    }
    public function render()
    {
        return view('livewire.comment-vote');
    }
}
