<h1>{{ $post->title }}</h1>

<p>{{ $post->body }}</p>

@auth
    <p><a href="{{ route('posts.edit', $post) }}">編集</a></p>

    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endauth

<p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>
