<h1>投稿編集</h1>

<form method="POST" action="{{ route('posts.update', $post) }}">
    @csrf
    @method('PUT')

    <div>
        <label>タイトル</label><br>
        <input type="text" name="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>本文</label><br>
        <textarea name="body">{{ old('body', $post->body) }}</textarea>
        @error('body')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">更新する</button>
</form>

<p><a href="{{ route('posts.show', $post) }}">詳細に戻る</a></p>
<p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>
