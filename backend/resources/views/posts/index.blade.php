<h1>Posts</h1>

<ul>
    @forelse ($posts as $post)
        <li>{{ $post->title }}</li>
    @empty
        <li>投稿はまだありません</li>
    @endforelse
</ul>
