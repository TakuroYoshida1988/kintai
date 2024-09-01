<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}さんの勤怠記録</title>
    <link rel="stylesheet" href="{{ asset('css/user_attendance.css') }}">
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
        <h1>{{ $user->name }}さんの勤怠記録</h1>

        <table>
            <thead>
                <tr>
                    <th>勤務日</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceRecords as $record)
                <tr>
                    <td>{{ $record->work_date }}</td>
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