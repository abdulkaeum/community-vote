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
                            <a href="{{ route('filter.channel', $link->channel->slug) }}">
                                {{ $link->channel->title }}
                            </a>
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
