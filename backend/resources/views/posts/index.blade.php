<h1>Posts</h1>

@auth
    <p>ログイン中：{{ auth()->user()->email }}</p>

    <a href="{{ route('posts.create') }}">新規作成</a>

    <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
@else
    <p>ゲスト閲覧中</p>
    <a href="{{ route('login') }}">ログイン</a>
    <a href="{{ route('register') }}">新規登録</a>
@endauth

<ul>
    @forelse ($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </li>
    @empty
        <li>投稿はまだありません</li>
    @endforelse
</ul>

{{ $posts->links() }}
