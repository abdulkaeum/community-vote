<div class="w-full lg:w-1/2 mt-3.5">
    <div class="flex mb-0.5">
        <a class="p-3 border border-t-2 border-r-2 hover:bg-gray-300 mr-1
            {{ request()->exists('popular') ? '' : 'bg-gray-300'}}"
           href="{{ request()->url() }}"
        >Recent</a>

        <a class="p-3 border border-t-2 border-l-2 border-r-2 hover:bg-gray-300
            {{ request()->exists('popular') ? 'bg-gray-300' : ''}}"
           href="?popular=true"
        >Popular</a>
    </div>

    @forelse($links as $link)
        <div class="flex p-5 mb-3 bg-gray-100 border border-l-4 border-blue-500">
            <div class="mt-1 mr-3 p-1">
                <form action="{{ route('vote', $link->id) }}" method="POST">
                    @csrf
                    <button class="bg-{{ Auth::check() && Auth::user()->votedFor($link) ? 'green' : 'gray'}}-300 p-3 rounded flex">
                        <i class="far fa-thumbs-up mr-1 mt-0.5"></i>
                        <span>{{ $link->votes_count }}</span>
                    </button>
                </form>
            </div>
            <div class="w-full">
                <p>
                    <a href="{{ $link->link}}" target="_blank" class="font-bold">
                        {{ $link->title }}
                    </a>
                </p>
                <p class="text-sm">
                    Contributed
                    By <span class="text-blue-600 font-bold">{{ $link->creater->name }}</span> {{ $link->updated_at->diffForHumans() }}
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
