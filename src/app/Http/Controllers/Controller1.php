<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceRecord;
use App\Models\BreakRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomVerificationMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest; 

class Controller1 extends Controller
{
    // 既存のメソッドはそのまま

    public function index()
    {
        $user = Auth::user();

        // ユーザーの最新の勤怠記録を取得
        $latestRecord = AttendanceRecord::where('user_id', $user->id)
                            ->orderBy('work_date', 'desc')
                            ->orderBy('clock_in', 'desc')
                            ->first();

        // 勤務状態をチェック
        $isWorking = $latestRecord && !$latestRecord->clock_out;

        // 休憩状態をチェック
        $latestBreak = $latestRecord ? $latestRecord->breakRecords()->orderBy('break_start', 'desc')->first() : null;
        $isOnBreak = $latestBreak && !$latestBreak->break_end;

       return view('index', compact('user', 'isWorking', 'isOnBreak'));

    }

    public function register()
    {
        return view('register');
    }

   public function store(Request $request)
  {
    // バリデーション
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // ユーザー作成
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // 認証メールを送信
    $user->sendEmailVerificationNotification();

    // 同じページにリダイレクトしてメッセージを表示
    return redirect()->back()->with('message', '仮会員登録が完了しました。確認メールを送信しましたので、認証を完了してください。');
   }

    public function clockIn(Request $request)
    {
        $user = Auth::user();

        AttendanceRecord::create([
            'user_id' => $user->id,
            'work_date' => now()->toDateString(),
            'clock_in' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('message', '勤務を開始しました。');
    }

    public function clockOut(Request $request)
    {
        $user = Auth::user();

        $latestRecord = AttendanceRecord::where('user_id', $user->id)
                            ->whereNull('clock_out')
                            ->orderBy('work_date', 'desc')
                            ->orderBy('clock_in', 'desc')
                            ->first();
        if ($latestRecord) {
            $latestRecord->update([
                'clock_out' => now()->toTimeString(),
            ]);
        }

        return redirect()->back()->with('message', '勤務を終了しました。');
    }

    public function breakStart(Request $request)
    {
        $user = Auth::user();
        //dd('breakStartメソッドが呼び出されました', $user);

        $latestAttendance = AttendanceRecord::where('user_id', $user->id)
                                ->whereNull('clock_out')
                                ->orderBy('work_date', 'desc')
                                ->orderBy('clock_in', 'desc')
                                ->first();

        //dd('最新の勤怠記録', $latestAttendance);

        if ($latestAttendance) {
            $breakRecord = BreakRecord::create([
                'attendance_record_id' => $latestAttendance->id,
                'break_start' => now()->toTimeString(),
            ]);

            //dd('休憩開始時間が保存されました', $breakRecord);
            
        } else {
            dd('勤怠記録が見つかりませんでした');
        }

        return redirect()->back()->with('message', '休憩を開始しました。');
    }

    public function breakEnd(Request $request)
    {
        $user = Auth::user();

        $latestAttendance = AttendanceRecord::where('user_id', $user->id)
                                ->whereNull('clock_out')
                                ->orderBy('work_date', 'desc')
                                ->orderBy('clock_in', 'desc')
                                ->first();

        if ($latestAttendance) {
            $latestBreak = BreakRecord::where('attendance_record_id', $latestAttendance->id)
                                ->whereNull('break_end')
                                ->orderBy('break_start', 'desc')
                                ->first();

            if ($latestBreak) {
                $latestBreak->update([
                    'break_end' => now()->toTimeString(),
                ]);
            }
        }

        return redirect()->back()->with('message', '休憩を終了しました。');
    }

    public function attendanceIndex()
    {
        // 最新の日付の勤怠データを取得
        $latestDate = AttendanceRecord::latest('work_date')->first()->work_date ?? Carbon::today()->toDateString();
        return redirect()->route('attendance.show', ['date' => $latestDate]);
    }

    public function attendanceShow($date)
    {

    // 指定された日付の勤怠データを取得
      $attendanceRecords = AttendanceRecord::where('work_date', $date)->paginate(5);

    // 日付の前後を計算
      $previousDate = AttendanceRecord::where('work_date', '<', $date)
                            ->orderBy('work_date', 'desc')
                            ->value('work_date');

      $nextDate = AttendanceRecord::where('work_date', '>', $date)
                        ->orderBy('work_date', 'asc')
                        ->value('work_date');

      return view('attendance', compact('attendanceRecords', 'date', 'previousDate', 'nextDate'));

    }

    public function showUserAttendance($id)
   {
     // 指定されたユーザーの勤怠データを取得
     $attendanceRecords = AttendanceRecord::where('user_id', $id)->paginate(5);

     // ユーザー情報を取得
     $user = User::find($id);

     return view('user_attendance', compact('attendanceRecords', 'user'));
   }

    public function userList()
   {

    // ユーザー一覧を取得
    $users = User::all();
    // ユーザー一覧ページを表示
    return view('user_list', compact('users'));

   }

   public function sendVerification(Request $request)
   {
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // メールアドレスでユーザーを取得
    $user = User::where('email', $request->email)->first();

    if ($user && !$user->hasVerifiedEmail()) {
        // カスタムメールクラスを使用してメールを送信
        $user->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    } else {
        return back()->with('message', 'メールアドレスが見つからないか、すでに認証されています。');
     }
   
    }

    public function verifyEmail(Request $request, $id, $hash)
   {

     // デバッグ: リクエストの内容を確認
    //dd($request);

    $user = User::findOrFail($request->route('id'));

    // デバッグ: ユーザーのデータを確認
    //dd($user);

    if (sha1($user->email) !== $request->route('hash')) {

         \Log::error('Invalid email hash', ['expected' => sha1($user->email), 'actual' => $request->route('hash')]);
        return redirect('/login')->withErrors('認証リンクが無効です。');

    }

    //未認証であれば、認証する。
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
       
    }

    // ユーザーを自動的にログインさせる
    Auth::login($user);

    // 打刻ページにリダイレクト
    return redirect('/'); // ここで打刻ページへのルートを指定

   }
    
   public function emailVerificationNotice()
  {
    return view('auth.verify-email');
  }
}