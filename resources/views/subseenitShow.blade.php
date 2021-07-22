<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subseenit : {{ $subseenit->name }}
        </h2>
        <h3 class="font-bold">/s/{{ $subseenit->slug }}</h3>
    </x-slot>

    <div class="space-y-6 mt-6">
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-bold text-3xl">{{ $subseenit->name }}</h2>
                        <h3>Créé par: {{ $subseenit->user->username }}</h3>
                        <br>
                        <p>Description : {{ $subseenit->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @isset($posts)
            <div class="">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                            @empty($posts)
                                <p>Il n'y a aucun post.</p>
                            @endempty
                            @foreach($posts as $post)
                                <div class="bg-gray-100 hover:bg-gray-200 transition-all overflow-hidden shadow-md sm:rounded-lg">
                                    <a href="/p/{{$post->id}}">
                                        <div class="p-6 border-b border-gray-200 flex items-stretch space-x-8">
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
                                                <h2 class="font-bold">{{$post->user->username}}</h2>
                                                <h4 class="text-2xl font-bold w-full  hover:underline">{{$post->title}}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>







</x-app-layout>
