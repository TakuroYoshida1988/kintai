<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー一覧</title>
    <link rel="stylesheet" href="{{ asset('css/user_list.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="/attendance">日付一覧</a></li>
                <li><a href="/users">ユーザー一覧</a></li>
                                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>ユーザー一覧</h1>

        <ul class="user-list">
            @foreach($users as $user)
            <li>
                <a href="{{ route('user.attendance', $user->id) }}">{{ $user->name }}</a>
            </li>
            @endforeach
        </ul>
    </main>

    <footer>
        <p>Atte, inc.</p>
    </footer>
</body>
</html>
