<h1>{{ $post->title }}</h1>

<p>{{ $post->body }}</p>

<p><a href="{{ route('posts.edit', $post) }}">編集</a></p>
<p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>
