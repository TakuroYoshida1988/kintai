<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>打刻ページ</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">ホーム</a></li>
                <li><a href="/attendance">日付一覧</a></li>
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
        <h1>{{ Auth::user()->name }}さんお疲れ様です！</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="buttons">
            <form action="{{ route('clockIn') }}" method="post">
                @csrf
                <button type="submit" name="action" value="clock_in" {{ $isWorking ? 'disabled' : '' }}>勤務開始</button>
            </form>

            <form action="{{ route('clockOut') }}" method="post">
                @csrf
                <button type="submit" name="action" value="clock_out" {{ !$isWorking || $isOnBreak ? 'disabled' : '' }}>勤務終了</button>
            </form>

           <form action="{{ route('break.start') }}" method="post">
               @csrf
               <button type="submit" name="action" value="break_start" {{ !$isWorking || $isOnBreak ? 'disabled' : '' }}>休憩開始</button>
            </form>
            
            <form action="{{ route('break.end') }}" method="post">
               @csrf
               <button type="submit" name="action" value="break_end" {{ !$isWorking || !$isOnBreak ? 'disabled' : '' }}>休憩終了</button>
            </form>
        </div>
    </main>
    <footer>
        <p>Atte, inc.</p>
    </footer>
</body>  
</html>