<h1>Posts</h1>

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
