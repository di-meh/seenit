<div class="flex flex-col items-center justify-center">
    @if(Auth::check())
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition {{ $post->votes()->where('user_id', auth()->id())->where('vote', 1)->count() ? 'text-green-400' : '' }} hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:click="vote(1)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
        </svg>
    @endif
    <p>{{ $votes }}</p>
    @if(Auth::check())
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition {{ $post->votes()->where('user_id', auth()->id())->where('vote', -1)->count() ? 'text-red-400' : '' }} hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:click="vote(-1)">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
        </svg>
    @endif
</div>
