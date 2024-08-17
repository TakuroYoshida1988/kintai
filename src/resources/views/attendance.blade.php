<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>日付別勤怠ページ</title>
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="date-navigation">
            @if ($previousDate)
                <a href="{{ route('attendance.show', ['date' => $previousDate]) }}">＜</a>
            @endif
            <h1>{{ $date }}</h1>
            @if ($nextDate)
                <a href="{{ route('attendance.show', ['date' => $nextDate]) }}">＞</a>
            @endif
        </div>
        <table>
            <thead>
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendanceRecords as $record)
                    <tr>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->clock_in }}</td>
                        <td>{{ $record->clock_out }}</td>
                        <td>{{ $record->total_break_time }}</td>
                        <td>{{ $record->working_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">
            {{ $attendanceRecords->links() }}
        </div>
    </main>
    <footer>
        <p>Atte, inc.</p>
    </footer>
</body>
</html>