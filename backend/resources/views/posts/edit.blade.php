{{-- resources/views/posts/edit.blade.php --}}
<x-layouts.blog :title="'投稿編集'">
    <div class="flex items-end justify-between mb-6">
        <h1 class="text-3xl font-bold">投稿編集</h1>
        <p class="text-sm text-slate-500">ID: {{ $post->id }}</p>
    </div>

    <form method="POST" action="{{ route('posts.update', $post) }}"
        class="rounded-2xl border bg-white p-6 shadow-sm space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold mb-2">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">本文</label>
            <textarea name="body" rows="10"
                class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('posts.show', $post) }}" class="text-sm text-slate-600 hover:underline">詳細に戻る</a>
                <a href="{{ route('posts.index') }}" class="text-sm text-slate-600 hover:underline">一覧に戻る</a>
            </div>

            <button type="submit"
                class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                更新する
            </button>
        </div>
    </form>
</x-layouts.blog>
