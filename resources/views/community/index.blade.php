<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Community
        </h2>
        @if($channel)
            <span>: {{ $links->count() }} {{ $channel->title }} found</span>
            &ndash; <a href="{{ route('index') }}">Back to all</a>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container w-full flex flex-wrap mx-auto">

                        @include('community.links')

                        @auth
                            @include('community.add-link')
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
