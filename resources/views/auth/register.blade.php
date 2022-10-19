
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css" >

</head>

<body>
    <section>
        <div class="center">
            <!-- 作成ボタンを押したら、registerページにデータ送信 -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
                <p><label for="email">メールアドレス</label><input type="email" name="email" size="35" maxlength="30"></P>
                <p><label>表示名</label><input type="text" name="name" size="35" maxlength="10"></P>
                <p><label>パスワード</label><input type="password" name="password" size="35" maxlength="10"></P>
                <p><label>パスワード確認</label><input type="password" name="password_confirmation" size="35" maxlength="10"></P>


                
              
                <input type="submit" value="作成" name="create" class="button">
                
        </div>

        <BR><br>



    </section>


</body>

</html>
