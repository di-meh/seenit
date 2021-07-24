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
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="font-bold">{{$post->user->username}}</h1>
                        <h2 class="font-bold text-2xl">{{ $post->title }}</h2>
                        <p>{{ $post->post_text }}</p>
                    </div>
                </div>
            </div>
        </div>
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
                                        <div class="p-6 border-b border-gray-200 flex items-center space-x-8">
                                            <livewire:comment-vote :comment="$comment" />
                                            <div class="flex flex-col items-start justify-center">
                                                <p class="font-bold">{{$comment->user->username}}</p>
                                                <p class="text-lg">{{$comment->comment_text}}</p>
                                            </div>
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
