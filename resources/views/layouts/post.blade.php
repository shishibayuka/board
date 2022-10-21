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
    <section>
        <div>
            <div class="titlebar">
                <p class="name">投稿者：<td>{{$post->user->name}}</td>
                </p>
                <td>
                    <p class="time">{{$post->created}}</p>
                </td>
            </div>
            <form action="post.php" method="post">
                <div class="frame">
                    <!-- ②編集中の投稿IDだったら、編集画面を表示 -->
                    <div class="left">
                        {{-- <textarea name="message" rows="4" cols="65"></textarea> --}}
                        <td>{{$post->message}}</td>
                    </div>
                    <p></p>
                </div>
                <!-- もしログイン者と投稿者が一緒だったら 「編集」「削除」ボタンを表示-->
                @if($post->user_id == auth()->user()->id)
                <div class="select_button">
                    <input type="submit" value="編集" name="edit" class="button">
                    <input type="submit" value="削除" name="delete" class="button delete_button">
                </div>
                @endif
                <!-- ブラウザ上に表示されない非表示データを送信 -->
                <!-- // (21)編集ボタンが押されたら、更新ボタンを表示（全部表示するわけではない） -->
                {{-- <div class="select_button">
                    <input type="submit" value="更新" name="update" class="button">
                    <input class="white_button">
                </div> --}}
            </form>
        </div>
    </section>
    <br>
    @endforeach
</body>

</html>