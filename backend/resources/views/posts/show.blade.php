<x-layouts.blog :title="$post->title">
    <div class="space-y-6">
        <div class="rounded-2xl border bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold break-all">{{ $post->title }}</h1>
                    <div class="mt-2 text-sm text-slate-500 space-x-2">
                        <span>{{ $post->created_at->format('Y/m/d H:i') }}</span>
                        <span>・</span>
                        <span>投稿者：{{ $post->user->name ?? '不明' }}</span>
                    </div>
                </div>

                @auth
                    @if (auth()->id() === $post->user_id)
                        <div class="flex gap-2 shrink-0">
                            <a href="{{ route('posts.edit', $post) }}"
                                class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-slate-50 whitespace-nowrap">
                                編集
                            </a>

                            <button type="button" data-modal-open="delete-modal"
                                class="rounded-lg bg-rose-600 px-3 py-2 text-sm font-semibold text-white hover:bg-rose-700 whitespace-nowrap">
                                削除
                            </button>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="prose prose-slate mt-6 max-w-none break-words">
                {!! nl2br(e($post->body)) !!}
            </div>

            {{-- カードのフッター --}}
            <div class="mt-8 flex items-center justify-between border-t pt-4">
                <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">
                    ← 一覧に戻る
                </a>
            </div>
        </div>
    </div>

    {{-- 削除モーダル --}}
    <div id="delete-modal" class="hidden fixed inset-0 z-50">
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative mx-auto mt-40 w-full max-w-md rounded-2xl bg-white p-6 shadow-lg">
            <h2 class="text-lg font-bold">削除確認</h2>
            <p class="mt-2 text-sm text-slate-600">本当に削除しますか？この操作は戻せません。</p>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" data-modal-close="delete-modal"
                    class="rounded-lg border px-4 py-2 text-sm font-semibold hover:bg-slate-50">
                    キャンセル
                </button>

                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-700">
                        削除する
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.blog>
