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
