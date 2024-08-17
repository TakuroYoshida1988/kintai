<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録ページ</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <div class="container">
    <h1>会員登録</h1>

    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="post">
        @csrf
        <label for="name">名前:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="password_confirmation">確認用パスワード:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        
        <button type="submit">会員登録</button>
    </form>
    
    <p>アカウントをお持ちの方はこちらから <a href="{{ route('login') }}">ログイン</a></p>
  </div>

  <style>
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
  </style>
</body>
</html>