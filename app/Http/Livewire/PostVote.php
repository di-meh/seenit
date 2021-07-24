<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PostVote as Vote;

class PostVote extends Component
{
    public $post;
    public $votes;

    public function mount($post) {
        $this->post = $post;
        $this->votes = $post->votes;
    }

    public function vote($vote) {
        if (!$this->post->votes()->where('user_id', auth()->id())->count()
            && in_array($vote, [-1, 1]) && $this->post->user_id != auth()->id()) {
            Vote::create([
                'post_id' => $this->post->id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);

            $this->votes += $vote;
        }
    }


    public function render()
    {
        return view('livewire.post-vote');
    }
}
