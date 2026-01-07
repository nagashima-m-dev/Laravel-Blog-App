<h1>新規投稿</h1>

<form>
    <div>
        <label>タイトル</label><br>
        <input type="text" name="title">
    </div>

    <div>
        <label>本文</label><br>
        <textarea name="body"></textarea>
    </div>
</form>

<p><a href="{{ route('posts.index') }}">一覧に戻る</a></p>
