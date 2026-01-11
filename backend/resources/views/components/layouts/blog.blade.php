<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Laravel Blog App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col">
        {{-- Header --}}
        <header class="bg-white border-b">
            <div class="mx-auto max-w-4xl px-6 py-4 flex items-center justify-between">
                <a href="{{ route('posts.index') }}" class="font-bold text-lg tracking-tight">
                    Laravel Blog App
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <span class="text-sm text-slate-600">
                            ログイン中：{{ auth()->user()->email }}様
                        </span>

                        <a href="{{ route('posts.create') }}"
                            class="inline-flex items-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            新規投稿
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-slate-50">
                                ログアウト
                            </button>
                        </form>
                    @else
                        <span class="text-sm text-slate-600">
                            ゲスト様
                        </span>

                        <a href="{{ route('login') }}"
                            class="inline-flex items-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                            ログイン
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        {{-- Main --}}
        <main class="flex-1">
            <div class="mx-auto max-w-4xl px-6 py-8">
                {{ $slot }}
            </div>
        </main>

        {{-- Footer --}}
        <footer class="border-t bg-white">
            <div class="mx-auto max-w-4xl px-6 py-6 text-sm text-slate-500">
                © 2026 {{ config('app.name', 'Laravel Blog App') }}
            </div>
        </footer>
    </div>
</body>

</html>
