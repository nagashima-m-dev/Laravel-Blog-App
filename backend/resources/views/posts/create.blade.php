<x-layouts.blog :title="'新規投稿'">
    <h1 class="text-3xl font-bold mb-6">新規投稿</h1>

    <form method="POST" action="{{ route('posts.store') }}" class="rounded-2xl border bg-white p-6 shadow-sm space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-semibold mb-2">タイトル</label>
            <input name="title" value="{{ old('title') }}"
                class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">本文</label>
            <textarea name="body" rows="8"
                class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-200">{{ old('body') }}</textarea>
            @error('body')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('posts.index') }}" class="text-sm text-slate-600 hover:underline">一覧に戻る</a>
            <button class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                投稿する
            </button>
        </div>
    </form>
</x-layouts.blog>
