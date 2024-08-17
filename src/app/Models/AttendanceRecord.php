<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in',
        'clock_out',
    ];

    // ユーザーとのリレーションシップを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //AttendanceRecordモデルとBreakRecordモデルの間に1対多の関係を定義する
    public function breakRecords()
    {
        return $this->hasMany(BreakRecord::class);
    }

    public function getWorkingTimeAttribute()
    {
        if ($this->clock_in && $this->clock_out) {
            $clockIn = Carbon::parse($this->clock_in);
            $clockOut = Carbon::parse($this->clock_out);
            $workingTime = $clockOut->diff($clockIn);

            return $workingTime->format('%H:%I:%S');
        }
        return null;
    }

    public function getTotalBreakTimeAttribute()
    {
        $totalBreakTime = 0;

        $breakRecords = $this->breakRecords ?: collect(); // nullの場合に空のコレクションを返す

        foreach ($breakRecords as $break) {
            if ($break->break_start && $break->break_end) {
                $breakStart = Carbon::parse($break->break_start);
                $breakEnd = Carbon::parse($break->break_end);
                $totalBreakTime += $breakEnd->diffInSeconds($breakStart);
            }
        }

        return gmdate('H:i:s', $totalBreakTime);
    }
}