<div
    class="w-full lg:w-1/2 mt-3.5">
    @forelse($links as $link)
        <div class="flex p-5 mb-3 bg-gray-100 border border-l-4 border-blue-500">
            <div class="mt-1 mr-3 p-1">
                <form action="{{ route('vote', $link->id) }}" method="POST">
                    @csrf
                    <button class="bg-{{ Auth::check() && Auth::user()->votedFor($link) ? 'green' : 'gray'}}-500 text-white p-3 rounded">
                        {{ $link->votes->count() }}
                    </button>
                </form>
            </div>
            <div class="w-full">
                <p>
                    <a href="{{ $link->link}}" target="_blank">
                        {{ $link->title }}
                    </a>
                </p>
                <p>
                    Contributed
                    By {{ $link->creater->name }} {{ $link->created_at->diffForHumans() }}
                </p>
            </div>
            <div class="text-xs mt-2 justify-right">
                <a href="{{ route('filter.channel', $link->channel->slug) }}">
                    <span style="background-color: rgb({{$link->channel->color}});"
                          class="text-white rounded p-1">
                            {{ $link->channel->title }}
                    </span>
                </a>
            </div>
        </div>
    @empty
        <h3>No links posted yet</h3>
    @endforelse
    {{ $links->links() }}
</div>
