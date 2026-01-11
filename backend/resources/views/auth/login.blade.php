{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">ログイン</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            アカウントをお持ちの方はこちらからログインしてください。
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="login" value="ユーザー名 / メールアドレス" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="パスワード" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">ログイン状態を保持</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                ログイン
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('posts.index') }}"
            class="inline-flex items-center justify-center w-full rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800">
            ゲストとして閲覧する
        </a>

        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            アカウントをお持ちでない場合：
            <a href="{{ route('register') }}" class="underline hover:text-gray-900 dark:hover:text-gray-100">
                新規登録
            </a>
        </p>
    </div>
</x-guest-layout>
