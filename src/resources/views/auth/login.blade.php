<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログインページ</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main>
        <h1>ログイン</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="post">
            @csrf
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">ログイン</button>
        </form>

        <p>アカウントをお持ちでない方はこちらから <a href="/register">会員登録</a></p>
    </main>
    <footer>
        <p>Atte, inc.</p>
    </footer>
</body>
</html>