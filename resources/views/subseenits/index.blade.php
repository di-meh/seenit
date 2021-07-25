<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subseenits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Auth::check())
                        <a href="{{route('subseenits.create')}}">
                            <div class="rounded-lg bg-blue-500 shadow-md w-auto flex items-center justify-center p-6 mb-6 "><p class="text-white">Nouveau subseenit</p></div>
                        </a>
                    @endif
                    @foreach ($subseenits as $subseenit)
                        <div class="bg-gray-100 hover:bg-gray-200 transition-all overflow-hidden shadow-md sm:rounded-lg mb-6 flex justify-between">
                            <a href="s/{{ $subseenit->slug }}" class="w-full">
                                <div class="p-6 border-b border-gray-200">
                                    <h3 class="text-2xl font-bold">{{ $subseenit->name}}</h3>
                                    <p>{{ $subseenit->description }}</p>
                                </div>
                            </a>
                            @if(Auth::check())
                                <div class="flex items-center space-x-2">
                                    @if(Auth::id() == $subseenit->user_id)
                                        <a href="{{route('subseenits.edit', [$subseenit])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    @endif
                                    @if (Auth::id() == $subseenit->user_id || Auth::user()->is_admin)
                                        <a href="{{route('subseenits.destroy', $subseenit->id)}}" class="hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 m-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <br>
                    {{$subseenits->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
