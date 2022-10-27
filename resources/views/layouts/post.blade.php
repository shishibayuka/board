<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    {{-- editPostId:{{ $editPostId }} --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
    <section>
        <!-- メッセージを投稿したら保存する -->
        <form method="POST" action="{{ route('post.store') }}">
            @csrf
            <!-- 認証ユーザーの名前を表示 -->
            <p class="name">投稿者：{{auth()->user()->name}}</p>
            <textarea name="message"></textarea>
            <br>
            <div class="center">
                <input type="submit" value="投稿" name="posting" class="post_button" ;>
            </div>
            </a>
        </form>
    </section>
    <br>

    <!-- foreach繰り返し postsテーブルから1つずつpostに格納する($posts=postscontrollerから渡したデータ20行目)-->
    @foreach($posts as $post)
    {{-- 投稿ID:{{ $post->id}} --}}
    <section>
        <div>
            <div class="titlebar">
                <p class="name">投稿者：<td>{{$post->user->name}}</td>
                </p>
                <td>
                    {{-- 投稿日時表示 --}}
                    <p class="time">{{$post->created->format('Y/m/d G:i:s')}}</p>
                </td>
            </div>

            {{-- ログイン者と投稿者が一緒 かつ 編集したい記事IDと投稿IDが同じだったら --}}
            @if($post->user_id == auth()->user()->id && $editPostId == $post['id'])
            <form method="POST" action="{{ route('post.update',$post->id) }}">
                @csrf
                <div class="frame">
                    <textarea name="updateMessage" rows="4" cols="65"><?php echo $post['message']; ?></textarea>
                </div>
                <div class="select_button">
                    <input type="submit" value="更新" name="update" class="button">
                    <input class="white_button delete_button">
                </div>
                @else

                <div class="frame">
                    <td>{{$post->message}}</td>
                </div>
                @endif

                <!-- もしログイン者と投稿者が一緒だったら 「編集」「削除」ボタンを表示-->
                @if($post->user_id == auth()->user()->id)
                <div class="select_button">
                    @if ($editPostId != $post['id'])
                    <!-- 編集ボタンを押したら、テキストエリアを表示する ※editのため、form method="GET" -->
                    <form method="GET" action="{{ route('post.edit',$post->id) }}">
                        <input type="submit" value="編集" name="edit" class="button">
                    </form>

                    <!-- 削除ボタンを押したら、削除する -->
                    <form method="POST" action="{{ route('post.destroy',$post->id) }}">
                        @csrf
                        <!-- クラスを2つ指定する（buttonとdelete_button） -->
                        <input type="submit" value="削除" name="delete" class="button delete_button">
                    </form>
                    @endif
                </div>
                @endif
                <!-- ブラウザ上に表示されない非表示データを送信 -->
        </div>
    </section>
    <br>
    @endforeach
</body>

</html>