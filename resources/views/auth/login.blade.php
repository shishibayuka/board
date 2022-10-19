
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

        <form method="POST" action="{{ route('login') }}">
            <!-- csrf攻撃から守る -->
            @csrf
                <p><label>メールアドレス</label>
                    <input type="text" name="email" size="35" maxlength="30">
                </P>
                <p><label>パスワード</label>
                    <input type="password" name="password" size="35" maxlength="10">
                </P>


                <input type="submit" value="ログイン" name="login" class="button">


                <BR><br>


                <a href="{{ route('register') }}">アカウント登録</a>
        </div>

        </form>
    </section>


</body>

</html>
