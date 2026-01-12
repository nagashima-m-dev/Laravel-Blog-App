<x-layouts.blog :title="'投稿一覧'">
    <div class="flex items-end justify-between mb-6">
        <h1 class="text-3xl font-bold">投稿一覧</h1>
        <p class="text-sm text-slate-500">全 {{ $posts->total() }} 件</p>
    </div>

    <div class="space-y-3">
        @forelse ($posts as $post)
            <a href="{{ route('posts.show', $post) }}"
                class="block rounded-2xl border bg-white p-5 shadow-sm hover:shadow-md transition">
                <div class="text-lg font-semibold break-all">{{ $post->title }}</div>
                <div class="mt-1 text-sm text-slate-500 line-clamp-2 break-words">{{ $post->body }}</div>
                <div class="mt-3 text-xs text-slate-400">
                    {{ $post->created_at->format('Y/m/d H:i') }}
                    <span>・</span>
                    <span>投稿者：{{ $post->user->name ?? '不明' }}</span>
                </div>
            </a>
        @empty
            <div class="rounded-2xl border bg-white p-8 text-center text-slate-500">
                投稿がまだありません
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</x-layouts.blog>
