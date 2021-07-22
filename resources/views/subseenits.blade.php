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
                    {{--{!! Form::open(['route'=> 'subseenits_create']) !!}
                    {!! Form::submit('Nouveau Subseenit') !!}
                    {!! Form::close() !!}
                    <br>--}}
                        @foreach ($subseenits as $subseenit)
                        <a href="s/{{ $subseenit->slug }}"><div class="bg-gray-100 hover:bg-gray-200 transition-all overflow-hidden shadow-md sm:rounded-lg">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-2xl font-bold">{{ $subseenit->name}}</h3>
                                <p>{{$subseenit->description}}</p>
                            </div>
                        </div></a>
                        <br/>
                        @endforeach
                    <br>
                    {{$subseenits->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
