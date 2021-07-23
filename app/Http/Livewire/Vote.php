<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Vote extends Component
{
    public $vote = 0;
    public $upvoted = false;
    public $downvoted = false;
    public function upvote() {
        if ($this->upvoted) {
            $this->vote = 0;
            $this->upvoted = false;
            $this->downvoted = false;
        }
        elseif ($this->downvoted) {
            $this->vote = 1;
            $this->downvoted = false;
            $this->upvoted = true;
        }
        else {
            $this->vote = 1;
            $this->upvoted = true;
        }

    }
    public function downvote() {
        if ($this->downvoted) {
            $this->vote = 0;
            $this->upvoted = false;
            $this->downvoted = false;
        }
        elseif ($this->upvoted) {
            $this->vote = -1;
            $this->downvoted = true;
            $this->upvoted = false;
        }
        else {
            $this->vote = -1;
            $this->downvoted = true;
        }
    }
    public function render()
    {
        return view('livewire.vote');
    }
}
