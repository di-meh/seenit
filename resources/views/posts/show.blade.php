<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post : {{ $post->title }}
        </h2>
    </x-slot>
    <div class="space-y-6 mt-6">
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 space-y-1">
                        <div class="flex items-center space-x-2">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->username }}" />
                            @endif
                            <h1 class="font-bold">{{$post->user->username}}</h1>
                        </div>

                        <h2 class="font-bold text-2xl">{{ $post->title }}</h2>
                        <p>{{ $post->post_text }}</p>
                        @if ($post->post_url != '')
                            <a href="{{ $post->post_url }}" class="text-blue-400 underline" target="_blank">{{ $post->post_url }}</a>
                        @endif
                        @if ($post->post_image)
                            <img src="{{ asset('storage/posts/' . $post->id . '/thumbnail_' . $post->post_image) }}" class="w-full rounded-lg shadow-lg border-2"/>
                        @endif
                        {{--                        <img src="https://images.unsplash.com/photo-1625527575307-616f0bb84ad2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=3155&q=80" class="w-full rounded-lg shadow-lg">--}}
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::check())
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a href="{{route('posts.comments.create', $post)}}">
                        <div class="rounded-lg bg-blue-500 shadow-md w-auto flex items-center justify-center p-6 mb-6 "><p class="text-white">Nouveau commentaire</p></div>
                    </a>
                </div>
            </div>
        @endif
        @isset($comments)
            <div class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                            @empty($comments)
                                <p>Il n'y a aucun commentaire.</p>
                            @endempty
                            @foreach($comments as $comment)
                                <div class="bg-gray-100 hover:bg-gray-200 transition-all overflow-hidden shadow-md sm:rounded-lg">
                                    <div class="p-6 border-b border-gray-200 flex items-center space-x-8 flex justify-between items-center">
                                        <div class="flex items-center space-x-8">
                                            <livewire:comment-vote :comment="$comment" />
                                            <div class="flex flex-col items-start justify-center">
                                                <a href="{{route('user.show', [$comment->user->username])}}">
                                                    <div class="flex items-center space-x-2">
                                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->username }}" />
                                                        @endif
                                                        <h2 class="font-bold">{{$comment->user->username}}</h2>
                                                    </div>
                                                </a>
                                                <p class="text-lg">{{$comment->comment_text}}</p>
                                            </div>
                                        </div>

                                        {{--                                            @if(Auth::check())--}}
                                        {{--                                                <a href="{{route('posts.comments.create', $comment)}}">--}}
                                        {{--                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
                                        {{--                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />--}}
                                        {{--                                                    </svg>--}}
                                        {{--                                                    <p>Répondre</p>--}}
                                        {{--                                                </a>--}}
                                        {{--                                            @endif--}}



                                        @if(Auth::check())
                                            <div class="flex items-center space-x-2">
                                                @if(Auth::id() == $comment->user_id)
                                                    <a href="{{route('posts.comments.edit', [$post, $comment])}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                @endif
                                                @if (Auth::id() == $comment->user_id || Auth::user()->is_admin || Auth::id() == $post->user_id)
                                                    <form method="POST" action="{{route('posts.comments.destroy', [$post, $comment])}}" class="hover:text-red-500">
                                                        @csrf
                                                        <button type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            {{$comments->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
</x-app-layout>
