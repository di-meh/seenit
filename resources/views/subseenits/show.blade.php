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
        @if(Auth::check())
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a href="{{route('subseenits.posts.create', $subseenit->id)}}">
                        <div class="rounded-lg bg-blue-500 shadow-md w-auto flex items-center justify-center p-6 mb-6 "><p class="text-white">Nouveau Post</p></div>
                    </a>
                </div>
            </div>
        @endif
        @isset($posts)
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                            @empty($posts)
                                <p>Il n'y a aucun post.</p>
                            @endempty
                            @foreach($posts as $post)
                                <div class="bg-gray-100 hover:bg-gray-200 transition-all overflow-hidden shadow-md sm:rounded-lg">
                                    <div class="p-6 border-b border-gray-200 flex flex-row items-center justify-between space-x-8">
                                        <div class="flex items-center space-x-8">
                                            <livewire:post-vote :post="$post" />
                                            <a href="/p/{{$post->id}}">
                                                <div class="flex flex-col items-start justify-center">
                                                    <div class="flex items-center space-x-2">
                                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->username }}" />
                                                        @endif
                                                        <h2 class="font-bold">{{$post->user->username}}</h2>

                                                    </div>

                                                    <h4 class="text-2xl font-bold w-full  hover:underline">{{$post->title}}</h4>
                                                    @if ($post->post_image)
                                                        <img src="{{ asset('storage/posts/' . $post->id . '/thumbnail_' . $post->post_image) }}" class="w-full rounded-lg shadow-lg border-2"/>
                                                    @endif
                                                    {{--                                                        <img src="https://images.unsplash.com/photo-1625527575307-616f0bb84ad2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=3155&q=80" class="max-w-44 overflow-hidden  bg-cover rounded-lg shadow-lg">--}}

                                                </div>
                                            </a>
                                        </div>
                                        @if(Auth::check())
                                            @if (Auth::id() == $subseenit->user_id || Auth::user()->is_admin || Auth::id() == $post->user_id)
                                                <form method="POST" action="{{route('subseenits.posts.destroy', [$subseenit, $post] )}}">
                                                    @csrf

                                                    <button type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        @endif
                                    </div>
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
