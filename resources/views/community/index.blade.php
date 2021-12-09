<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Community
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container w-full flex flex-wrap mx-auto">
                        <div
                            class="w-full lg:w-1/2">
                            <ul>
                                @forelse($links as $link)
                                    <li class="p-5 mb-3 bg-gray-100 border border-l-4 border-blue-500">
                                        <a href="{{ $link->link}}" target="_blank">
                                            {{ $link->title }}
                                        </a>
                                        <div class="flex justify-between">
                                            <div class="text-xs mt-2">
                                                <span>
                                                Contributed
                                                By {{ $link->creater->name }} {{ $link->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <div class="text-xs mt-2">
                                                <span class="bg-{{ $link->channel->color }}-500 text-white rounded p-1">
                                                    {{ $link->channel->title }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <h3>No links posted yet</h3>
                                @endforelse
                            </ul>
                            {{ $links->links() }}
                        </div>
                        @auth
                            <div class="w-full lg:w-1/2 lg:px-6">
                                <form action="{{ route('community.store') }}" method="POST">
                                    @csrf
                                    <div class="mt-4 mb-4">
                                        <label for="title">
                                            <input type="text" name="title" value="{{ old('title') }}"
                                                   placeholder="Your title" required
                                                   class="rounded px-4 w-full py-2 bg-gray-50  border border-gray-200 text-gray-700 focus:bg-white focus:outline-none"/>
                                        </label>

                                        @error('title')
                                        <div class="text-red-700 text-sm mb-3">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mt-4 mb-4">
                                        <label for="link">
                                            <input type="text" name="link" value="{{ old('link') }}"
                                                   placeholder="Your link" required
                                                   class="rounded px-4 w-full py-2 bg-gray-50  border border-gray-200 text-gray-700 focus:bg-white focus:outline-none">
                                        </label>

                                        @error('link')
                                        <div class="text-red-700 text-sm mb-3">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mt-4 mb-4">
                                        <label for="channel_id"></label>
                                        <select name="channel_id" id="channel_id" required
                                                class="h-10 pl-3 border rounded focus:shadow-outline">
                                            <option value="null">Pick a channel</option>
                                            @foreach($channels as $channel)
                                                <option value="{{ $channel->id }}"
                                                    {{ old('channel_id') == $channel->id ? 'selected' : '' }}
                                                >{{ $channel->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('channel_id')
                                        <div class="text-red-700 text-sm mb-3">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>

                                    <button class="bg-gray-800 text-gray-200 px-3 py-2 rounded mt-1">
                                        Contribute Link
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
