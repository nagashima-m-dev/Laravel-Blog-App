<h1>Posts</h1>

<a href="{{ route('posts.create') }}">新規作成</a>

<ul>
    @forelse ($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
        </li>
    @empty
        <li>投稿はまだありません</li>
    @endforelse
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>

{{ $posts->links() }}
