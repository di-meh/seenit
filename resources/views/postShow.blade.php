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
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
                                                </svg>
                                                <p>{{$post->votes}}</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                                                </svg>
                                            </div>
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
