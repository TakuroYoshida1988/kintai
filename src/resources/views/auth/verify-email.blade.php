<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証</title>
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
</head>
<body>
    <main>
        <h1>メール認証が必要です</h1>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                新しい認証リンクが登録されたメールアドレスに送信されました。
            </div>
        @endif

        <p>続行する前に、メールの認証リンクを確認してください。</p>
        <p>もしメールを受け取っていない場合は、以下のボタンをクリックして新しい認証リンクをリクエストしてください。</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required><br><br>
            <button type="submit">認証リンクを再送信</button>
        </form>

    </main>
</body>
</html>