<h1>新規投稿</h1>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf

    <div>
        <label>タイトル</label><br>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>本文</label><br>
        <textarea name="body">{{ old('body') }}</textarea>
        @error('body')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">投稿する</button>
</form>

<p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>
